<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

    public function user_management(Request $request)
    {
        // Get or create user management section data
        $section = Section::where('section_type', 'USER_MANAGEMENT')->first();

        if (!$section) {
            $defaultContent = [
                'headline' => 'User Management',
                'subheadline' => 'Manage system users, roles, and permissions efficiently',
                'settings' => [
                    'allow_registration' => true,
                    'require_email_verification' => true,
                    'default_role' => 'user',
                    'max_login_attempts' => 5,
                    'lockout_duration' => 30, // minutes
                    'password_expiry_days' => 90
                ]
            ];

            $section = Section::create([
                'name' => 'User Management',
                'description' => 'User management and administration section',
                'section_type' => 'USER_MANAGEMENT',
                'status' => 'ACTIVE',
                'content' => $defaultContent,
                'published_at' => now(),
                'author' => 'system',
                'last_modified_by' => 'system'
            ]);
        }

        // Handle user actions
        if ($request->has('action')) {
            return $this->handleUserAction($request);
        }

        // Handle settings update
        if ($request->isMethod('post') && $request->has('settings')) {
            $data = $request->validate([
                'settings.allow_registration' => 'sometimes|boolean',
                'settings.require_email_verification' => 'sometimes|boolean',
                'settings.default_role' => 'required|in:super_admin,admin,user,moderator',
                'settings.max_login_attempts' => 'required|integer|min:1|max:10',
                'settings.lockout_duration' => 'required|integer|min:1|max:1440',
                'settings.password_expiry_days' => 'required|integer|min:1|max:365'
            ]);

            $currentContent = $this->getContentAsArray($section->content);
            $userData = array_merge($currentContent, [
                'settings' => $data['settings']
            ]);

            $section->update([
                'content' => $userData,
                'last_modified_by' => Auth::user()->name ?? 'admin'
            ]);

            return redirect()->back()->with('success', 'User management settings updated successfully.');
        }

        // Get users with pagination and search
        $users = User::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $users->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->has('role') && $request->get('role') !== 'all') {
            $users->where('role', $request->get('role'));
        }

        // Filter by status
        if ($request->has('status') && $request->get('status') !== 'all') {
            $users->where('status', $request->get('status'));
        }

        $users = $users->orderBy('created_at', 'desc')->paginate(10);

        // Ensure content is always returned as array
        $userData = $this->getContentAsArray($section->content);

        return view('pages.management.user-management', [
            'section' => $section,
            'userData' => $userData,
            'users' => $users,
            'filters' => [
                'search' => $request->get('search'),
                'role' => $request->get('role', 'all'),
                'status' => $request->get('status', 'all')
            ]
        ]);
    }

    private function handleUserAction(Request $request)
    {
        $action = $request->get('action');
        $userId = $request->get('user_id');

        try {
            $user = User::findOrFail($userId);

            switch ($action) {
                case 'activate':
                    $user->update(['status' => 'active']);
                    return response()->json(['success' => true, 'message' => 'User activated successfully.']);

                case 'deactivate':
                    $user->update(['status' => 'inactive']);
                    return response()->json(['success' => true, 'message' => 'User deactivated successfully.']);

                case 'unlock':
                    $user->update([
                        'locked_at' => null,
                        'attempts' => 0
                    ]);
                    return response()->json(['success' => true, 'message' => 'User unlocked successfully.']);

                case 'delete':
                    // Prevent self-deletion
                    if ($user->id === Auth::id()) {
                        return response()->json(['success' => false, 'message' => 'You cannot delete your own account.'], 400);
                    }
                    $user->delete();
                    return response()->json(['success' => true, 'message' => 'User deleted successfully.']);

                case 'change_role':
                    $newRole = $request->get('role');
                    $user->update(['role' => $newRole]);
                    return response()->json(['success' => true, 'message' => "User role updated to {$newRole}."]);

                default:
                    return response()->json(['success' => false, 'message' => 'Invalid action.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error performing action.'], 500);
        }
    }
    private function getContentAsArray($content)
    {
        if (is_array($content)) {
            return $content;
        }

        if (is_string($content)) {
            return json_decode($content, true) ?? [];
        }

        return [];
    }
}
