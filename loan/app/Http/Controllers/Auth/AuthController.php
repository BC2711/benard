<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('pages.website.auth.login');
    }
    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        // dd($request->all());
        $maxAttempts = 5;
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        try {
            $user = User::where('email', $validatedData['email'])->first();

            // Check if user is locked or exceeded max attempts
            if ($user) {
                if ($user->locked_at) {
                    return back()->withErrors(['email' => __('auth.locked')])
                        ->with('account_locked', 'Your account has been locked due to too many failed attempts. Please reset your password.');
                }

                if ($user->attempts >= $maxAttempts) {
                    $user->locked_at = now();
                    $user->save();
                    return back()->withErrors(['email' => __('auth.locked')])
                        ->with('account_locked', 'Your account has been locked due to too many failed attempts. Please reset your password.');
                }

                // Show warning for high attempts
                if ($user->attempts >= ($maxAttempts - 2)) {
                    $remainingAttempts = $maxAttempts - $user->attempts;
                    session()->flash('attempts_warning', "Warning: You have {$remainingAttempts} attempt(s) remaining before your account gets locked.");
                }
            }

            $credentials = $request->only('email', 'password');

            // Attempt to authenticate the user
            if (Auth::guard('management')->attempt($credentials)) {
                if (Auth::guard('management')->user()->role !== 'ADMIN') {
                    Auth::guard('management')->logout();
                    return back()->withErrors(['email' => __('auth.unauthorized')]);
                }

                $user->update(['attempts' => 0, 'locked_at' => null]);
                $request->session()->regenerate();
                return redirect()->intended(route('management.dashboard.index'));
            }

            // Handle failed login attempt
            if ($user) {
                $user->increment('attempts');
                Log::warning('Failed login attempt', [
                    'email' => $request->email,
                    'ip' => $request->ip(),
                    'attempts' => $user->fresh()->attempts,
                    'user_agent' => $request->userAgent(),
                ]);

                $remainingAttempts = $maxAttempts - $user->attempts;
                if ($remainingAttempts > 0) {
                    session()->flash('attempts_warning', "Invalid credentials. You have {$remainingAttempts} attempt(s) remaining.");
                }

                return back()->withErrors(['email' => __('auth.password')]);
            }

            return back()->withErrors(['email' => __('auth.failed')]);
        } catch (\Exception $th) {
            Log::error('Login error', [
                'email' => $request->email,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);
            return back()->withErrors(['email' => 'An unexpected error occurred. Please try again later.' . $th->getMessage()]);
        }
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('management')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('pages.website.auth.register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $validated = $request->validate([
            'first_name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20|unique:users,phone',
            'date_of_birth' => 'required|date|before:-18 years',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
            'terms' => 'accepted',
        ], [
            'first_name.required' => 'Please enter your first name',
            'first_name.min' => 'First name must be at least 2 characters',
            'last_name.required' => 'Please enter your last name',
            'last_name.min' => 'Last name must be at least 2 characters',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already registered',
            'phone_number.required' => 'Please enter your phone number',
            'phone_number.unique' => 'This phone number is already registered',
            'date_of_birth.required' => 'Please enter your date of birth',
            'date_of_birth.before' => 'You must be at least 18 years old',
            'password.required' => 'Please enter a password',
            'password.min' => 'Password must be at least 8 characters',
            // 'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character',
            'confirm_password.same' => 'Passwords do not match',
            'terms.accepted' => 'You must agree to the terms and conditions',
            'profile_picture.image' => 'Please upload a valid image file',
            'profile_picture.mimes' => 'Profile picture must be a JPEG, PNG, GIF, or WebP file',
            'profile_picture.max' => 'Profile picture must be less than 5MB',
        ]);

        try {
            // Handle profile picture upload
            $profilePicturePath = null;
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $profilePicturePath = $file->storeAs('profile_pictures', $fileName, 'public');
            }

            // Create the user
            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone_number'],
                'date_of_birth' => $validated['date_of_birth'],
                'profile_picture' => $profilePicturePath,
                'password' => Hash::make($validated['password']),
                'username'=>$validated['email'], // Using email as username for simplicity
                // 'username' => $this->generateUsername($validated['first_name'], $validated['last_name']),
                'role' => 'ADMIN', // Default role for new registrations
                'status' => 'ACTIVE', // Or 'ACTIVE' if email verification is not required
                'attempts' => 0,
            ]);

            // Optionally send welcome email
            // Mail::to($user->email)->send(new WelcomeEmail($user));

            // Log the registration
            Log::info('New user registered', ['user_id' => $user->id, 'email' => $user->email]);

            // Return success response
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Registration successful! Please login to continue.',
                    'redirect' => route('login')
                ]);
            }

            // For web requests, redirect with success message
            return redirect()->route('login')->with('success', 'Registration successful! Please login to continue.');
        } catch (\Exception $e) {
            Log::error('Registration error', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'data' => $request->except(['password', 'confirm_password'])
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to register. Please try again later.'
                ], 500);
            }

            return back()->withInput($request->except(['password', 'confirm_password', 'profile_picture']))
                ->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    /**
     * Generate a unique username from first and last name
     */
    private function generateUsername($firstName, $lastName)
    {
        $baseUsername = strtolower($firstName . '.' . $lastName);
        $baseUsername = preg_replace('/[^a-z0-9.]/', '', $baseUsername);

        $username = $baseUsername;
        $counter = 1;

        // Check if username exists and make it unique
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }
    // Show forgot password form
    public function showForgotPasswordForm(Request $request)
    {
        return view('pages.website.auth.forget_password');
    }

    // Show reset password form
    public function showResetPasswordForm(Request $request, $token)
    {
        return view('pages.website.auth.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user || $user->role !== 'ADMIN') {
            Log::info('Password reset failed: No management user found', ['email' => $request->email]);
            return back()->withErrors(['email' => __('auth.failed')]);
        }

        try {
            $status = Password::broker('management')->sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        } catch (\Exception $e) {
            Log::error('Reset link error', ['error' => $e->getMessage(), 'line' => $e->getLine()]);
            return back()->withErrors(['email' => 'Failed to send reset link. Please try again.']);
        }
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/|confirmed',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => __('auth.failed')]);
        }
        try {
            $status = Password::broker('management')->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => bcrypt($password),
                        'remember_token' => Str::random(60),
                        'attempts' => 0,
                        'locked_at' => null,
                        'status' => 'ACTIVE'
                    ])->save();

                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error resetting password', [
                'email' => $request->email,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);
            return back()->withErrors(['email' => __('auth.failed') . $th->getMessage()]);
        }
    }
}
