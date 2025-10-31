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

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

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
            if (Auth::guard('admin')->attempt($credentials)) {
                if (Auth::guard('admin')->user()->role !== 'ADMIN') {
                    Auth::guard('admin')->logout();
                    return back()->withErrors(['email' => __('auth.unauthorized')]);
                }

                $user->update(['attempts' => 0, 'locked_at' => null]);
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
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
            return back()->withErrors(['email' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('pages.website.auth.register');
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
            $status = Password::broker('admin')->sendResetLink(
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
            $status = Password::broker('admin')->reset(
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
                ? redirect()->route('admin.login')->with('status', __($status))
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
