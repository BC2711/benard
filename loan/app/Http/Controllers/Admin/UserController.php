<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
            'gender' => 'required|in:male,female,other',
            'role' => 'required|in:admin,user,manager',
            'status' => 'required|in:active,inactive,suspended',
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

            User::create($validated);

            return redirect()->route('profile.users.index')
                ->with('success', 'User created successfully.');
        } catch (\Exception $e) {
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
            'gender' => 'required|in:male,female,other',
            'role' => 'required|in:admin,user,manager',
            'status' => 'required|in:active,inactive,suspended',
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

            $user->update($validated);

            return redirect()->route('profile.users.index')
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
            if ($user->id === Auth::id()) {
                return redirect()->back()
                    ->with('error', 'You cannot delete your own account.');
            }

            // Delete profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->delete();

            return redirect()->route('profile.users.index')
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
        $user = Auth::user();
        $genders = ['MALE' => 'Male', 'FEMALE' => 'Female', 'OTHER' => 'Other'];
        return view('profile.profile', compact('user', 'genders'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

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
            'gender' => 'required|in:male,female,other',
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

            $user->update($validated);

            return redirect()->route('profile.users.profile')
                ->with('success', 'Profile updated successfully.');
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
        $user = Auth::user();

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

            $user->update([
                'password' => Hash::make($validated['password'])
            ]);

            return redirect()->route('profile.users.profile')
                ->with('success', 'Password changed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error changing password: ' . $e->getMessage());
        }
    }
}
