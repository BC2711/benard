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
use App\Services\EmailDeliveryService;
use App\Services\EmailSettingsService;
use Illuminate\Support\Facades\URL;

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
    public function login(Request $request, EmailDeliveryService $email, EmailSettingsService $settings)
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
                    $this->queueAccountLockedEmail($email, $user, $request);
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
                $user = Auth::guard('management')->user();
                if ($user->role !== 'ADMIN') {
                    Auth::guard('management')->logout();
                    return back()->withErrors(['email' => __('auth.unauthorized')]);
                }

                if ($user->status !== 'ACTIVE' || !$user->email_verified_at) {
                    Auth::guard('management')->logout();
                    return back()->withErrors(['email' => 'Your account is not active. Verify your email address or contact an administrator.']);
                }

                $user->update(['attempts' => 0, 'locked_at' => null]);
                $request->session()->regenerate();

                if ($settings->twoFactorEnabled()) {
                    $code = (string) random_int(100000, 999999);
                    $user->forceFill([
                        'two_factor_code' => Hash::make($code),
                        'two_factor_expires_at' => now()->addMinutes(10),
                    ])->save();
                    $request->session()->put('two_factor_user_id', $user->id);
                    Auth::guard('management')->logout();
                    $email->queue('auth.two_factor_code', $user->email, [
                        'first_name' => $user->first_name,
                        'code' => $code,
                        'expires_in' => 10,
                    ]);

                    return redirect()->route('management.two-factor.form');
                }

                $this->queueLoginActivityEmail($email, $user, $request);
                return redirect()->intended(route('management.dashboard.index'));
            }

            // Handle failed login attempt
            if ($user) {
                $user->increment('attempts');
                $user->refresh();
                Log::warning('Failed login attempt', [
                    'email' => $request->email,
                    'ip' => $request->ip(),
                    'attempts' => $user->attempts,
                    'user_agent' => $request->userAgent(),
                ]);

                $remainingAttempts = $maxAttempts - $user->attempts;
                if ($remainingAttempts <= 0) {
                    $user->update(['locked_at' => now()]);
                    $this->queueAccountLockedEmail($email, $user, $request);

                    return back()->withErrors(['email' => __('auth.locked')])
                        ->with('account_locked', 'Your account has been locked due to too many failed attempts. Please reset your password.');
                }

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

    public function register(Request $request, EmailDeliveryService $email)
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
                'status' => 'PENDING',
                'attempts' => 0,
            ]);

            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addHours(24),
                ['user' => $user->id, 'hash' => sha1($user->email)],
            );
            $email->queue('auth.registration_verification', $user->email, [
                'first_name' => $user->first_name,
                'action_url' => $verificationUrl,
                'action_text' => 'Verify email address',
            ]);

            // Log the registration
            Log::info('New user registered', ['user_id' => $user->id, 'email' => $user->email]);

            // Return success response
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Registration successful. Please check your email to verify your account.',
                    'redirect' => route('login')
                ]);
            }

            // For web requests, redirect with success message
            return redirect()->route('login')->with('success', 'Registration successful. Please check your email to verify your account.');
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
    public function resetPassword(Request $request, EmailDeliveryService $email)
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
                function ($user, $password) use ($email) {
                    $user->forceFill([
                        'password' => bcrypt($password),
                        'remember_token' => Str::random(60),
                        'attempts' => 0,
                        'locked_at' => null,
                        'status' => 'ACTIVE'
                    ])->save();

                    event(new PasswordReset($user));
                    $email->queue('auth.password_changed', $user->email, [
                        'first_name' => $user->first_name,
                        'changed_at' => now()->toDayDateTimeString(),
                    ]);
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

    public function verifyEmail(Request $request, User $user, string $hash, EmailDeliveryService $email)
    {
        abort_unless(hash_equals($hash, sha1($user->email)), 403);

        if (!$user->email_verified_at) {
            $user->forceFill([
                'email_verified_at' => now(),
                'status' => 'ACTIVE',
            ])->save();
            $email->queue('auth.welcome', $user->email, ['first_name' => $user->first_name]);
        }

        return redirect()->route('login')->with('success', 'Your email address has been verified. You can now sign in.');
    }

    public function showTwoFactorForm()
    {
        abort_unless(session('two_factor_user_id'), 403);

        return view('pages.website.auth.two-factor');
    }

    public function verifyTwoFactor(Request $request, EmailDeliveryService $email)
    {
        $validated = $request->validate(['code' => 'required|digits:6']);
        $user = User::findOrFail($request->session()->get('two_factor_user_id'));

        if (!$user->two_factor_expires_at || $user->two_factor_expires_at->isPast() || !Hash::check($validated['code'], $user->two_factor_code)) {
            return back()->withErrors(['code' => 'The verification code is invalid or has expired.']);
        }

        $user->forceFill(['two_factor_code' => null, 'two_factor_expires_at' => null])->save();
        $request->session()->forget('two_factor_user_id');
        Auth::guard('management')->login($user);
        $request->session()->regenerate();
        $this->queueLoginActivityEmail($email, $user, $request);

        return redirect()->intended(route('management.dashboard.index'));
    }

    public function confirmEmailChange(Request $request, User $user, string $token, EmailDeliveryService $email)
    {
        abort_unless(hash_equals((string) $user->pending_email_token, $token), 403);

        $user->forceFill([
            'email' => $user->pending_email,
            'pending_email' => null,
            'pending_email_token' => null,
            'email_verified_at' => now(),
        ])->save();
        $email->queue('auth.profile_updated', $user->email, [
            'first_name' => $user->first_name,
            'changed_at' => now()->toDayDateTimeString(),
        ]);

        return redirect()->route('login')->with('success', 'Your new email address has been confirmed.');
    }

    private function queueLoginActivityEmail(EmailDeliveryService $email, User $user, Request $request): void
    {
        $email->queue('auth.login_activity', $user->email, [
            'first_name' => $user->first_name,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent() ?: 'Unknown device',
            'logged_in_at' => now()->toDayDateTimeString(),
        ]);
    }

    private function queueAccountLockedEmail(EmailDeliveryService $email, User $user, Request $request): void
    {
        $email->queue('auth.account_locked', $user->email, [
            'first_name' => $user->first_name,
            'ip_address' => $request->ip(),
            'action_url' => route('management.password.request'),
            'action_text' => 'Recover account',
        ]);
    }
}
