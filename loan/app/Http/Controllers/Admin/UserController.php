<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Services\EmailDeliveryService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('profile.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = ['MALE' => 'Male', 'FEMALE' => 'Female', 'OTHER' => 'Other'];
        $roles = ['ADMIN' => 'Administrator', 'USER' => 'User', 'MANAGER' => 'Manager'];
        $statuses = ['ACTIVE' => 'Active', 'INACTIVE' => 'Inactive', 'SUSPENDED' => 'Suspended'];

        return view('profile.create', compact('genders', 'roles', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'role' => 'required|in:ADMIN,USER,MANAGER',
            'status' => 'required|in:ACTIVE,INACTIVE,SUSPENDED',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                $validated['profile_picture'] = $request->file('profile_picture')->store('profile-pictures', 'public');
            }

            // Hash password
            $validated['password'] = Hash::make($validated['password']);

            $user = User::create($validated);
            app(EmailDeliveryService::class)->queue('auth.account_status', $user->email, [
                'first_name' => $user->first_name,
                'status' => $user->status,
            ]);

            return redirect()->route('management.users.index')
                ->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating user: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $genders = ['MALE' => 'Male', 'FEMALE' => 'Female', 'OTHER' => 'Other'];
        $roles = ['ADMIN' => 'Administrator', 'USER' => 'User', 'MANAGER' => 'Manager'];
        $statuses = ['ACTIVE' => 'Active', 'INACTIVE' => 'Inactive', 'SUSPENDED' => 'Suspended'];

        return view('profile.edit', compact('user', 'genders', 'roles', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'role' => 'required|in:ADMIN,USER,MANAGER',
            'status' => 'required|in:ACTIVE,INACTIVE,SUSPENDED',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture if exists
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                $validated['profile_picture'] = $request->file('profile_picture')->store('profile-pictures', 'public');
            }

            // Update password only if provided
            if ($request->filled('password')) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $passwordChanged = $request->filled('password');
            $statusChanged = $user->status !== $validated['status'];
            $user->update($validated);
            $email = app(EmailDeliveryService::class);
            $email->queue('auth.profile_updated', $user->email, [
                'first_name' => $user->first_name,
                'changed_at' => now()->toDayDateTimeString(),
            ]);
            if ($passwordChanged) {
                $email->queue('auth.password_changed', $user->email, [
                    'first_name' => $user->first_name,
                    'changed_at' => now()->toDayDateTimeString(),
                ]);
            }
            if ($statusChanged) {
                $email->queue('auth.account_status', $user->email, [
                    'first_name' => $user->first_name,
                    'status' => $user->status,
                ]);
            }

            return redirect()->route('management.users.index')
                ->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating user: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Prevent users from deleting themselves
            if ($user->id === Auth::guard('management')->id()) {
                return redirect()->back()
                    ->with('error', 'You cannot delete your own account.');
            }

            // Delete profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->delete();

            return redirect()->route('management.users.index')
                ->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    /**
     * Toggle user status
     */
    public function toggleStatus(User $user)
    {
        try {
            $user->update([
                'status' => $user->status === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE'
            ]);
            app(EmailDeliveryService::class)->queue('auth.account_status', $user->email, [
                'first_name' => $user->first_name,
                'status' => $user->status,
            ]);

            return redirect()->back()
                ->with('success', 'User status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating user status: ' . $e->getMessage());
        }
    }

    /**
     * Unlock user account
     */
    public function unlock(User $user)
    {
        try {
            $user->update([
                'locked_at' => null,
                'attempts' => 0
            ]);
            app(EmailDeliveryService::class)->queue('auth.account_recovered', $user->email, [
                'first_name' => $user->first_name,
            ]);

            return redirect()->back()
                ->with('success', 'User account unlocked successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error unlocking user account: ' . $e->getMessage());
        }
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = Auth::guard('management')->user();
        $genders = ['MALE' => 'Male', 'FEMALE' => 'Female', 'OTHER' => 'Other'];
        return view('profile.profile', compact('user', 'genders'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::guard('management')->id());
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Handle profile picture upload
            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture if exists
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                $validated['profile_picture'] = $request->file('profile_picture')->store('profile-pictures', 'public');
            }

            $newEmail = $validated['email'];
            unset($validated['email']);

            if ($newEmail !== $user->email) {
                $token = Str::random(64);
                $validated['pending_email'] = $newEmail;
                $validated['pending_email_token'] = $token;
                $this->queueEmailChangeVerification($user, $newEmail, $token);
            }

            $user->update($validated);
            app(EmailDeliveryService::class)->queue('auth.profile_updated', $user->email, [
                'first_name' => $user->first_name,
                'changed_at' => now()->toDayDateTimeString(),
            ]);

            return redirect()->route('management.profile')
                ->with('success', $newEmail !== $user->email
                    ? 'Profile updated. Check your new email address to confirm the change.'
                    : 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating profile: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show change password form
     */
    public function showChangePasswordForm()
    {
        return view('profile.change-password');
    }

    /**
     * Change user password
     */
    public function changePassword(Request $request)
    {
        $user = User::findOrFail(Auth::guard('management')->id());

        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed|different:current_password',
        ]);

        try {
            // Verify current password
            if (!Hash::check($validated['current_password'], $user->password)) {
                return redirect()->back()
                    ->with('error', 'Current password is incorrect.')
                    ->withInput();
            }
            $user->password = Hash::make($validated['password']);
            $user->save();
            app(EmailDeliveryService::class)->queue('auth.password_changed', $user->email, [
                'first_name' => $user->first_name,
                'changed_at' => now()->toDayDateTimeString(),
            ]);

            return redirect()->route('management.profile')
                ->with('success', 'Password changed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error changing password: ' . $e->getMessage());
        }
    }

    private function queueEmailChangeVerification(User $user, string $newEmail, string $token): void
    {
        $url = URL::temporarySignedRoute(
            'email-change.verify',
            now()->addHours(24),
            ['user' => $user->id, 'token' => $token],
        );

        app(EmailDeliveryService::class)->queue('auth.email_change_verification', $newEmail, [
            'first_name' => $user->first_name,
            'action_url' => $url,
            'action_text' => 'Confirm email address',
        ]);
    }
}
