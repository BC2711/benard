@extends('layouts.admin.main')

@section('title', 'User Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard.index') }}" class="text-sm text-gray-500 hover:text-gray-700">User Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">User</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
    {{-- <p class="text-gray-600 text-sm mt-1">Manage system users and their permissions</p> --}}
@endsection

@section('title', 'User Management')
@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-300">
        <div class="px-6 py-4">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <i class="fas fa-users text-blue-600 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Users</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $users->total() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <i class="fas fa-user-check text-green-600 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Active Users</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $users->where('status', 'ACTIVE')->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <i class="fas fa-user-clock text-yellow-600 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Inactive Users</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $users->where('status', 'INACTIVE')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-red-100 rounded-lg">
                            <i class="fas fa-user-lock text-red-600 text-lg"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Locked Accounts</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $users->whereNotNull('locked_at')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-300">
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <h2 class="text-lg font-semibold text-gray-900">All Users</h2>
                        <div class="mt-2 sm:mt-0 flex space-x-2">
                            <a href="{{ route('management.users.create') }}"
                                class="mt-4 sm:mt-0 bg-londa-orange text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition-colors duration-200 font-medium flex items-center">
                                <i class="fas fa-plus mr-2"></i>
                                Add New User
                            </a>
                            <input type="text" placeholder="Search users..."
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange w-64">
                            <select
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange">
                                <option value="">All Roles</option>
                                <option value="admin">Administrator</option>
                                <option value="manager">Manager</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Last
                                    Login</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->first_name . ' ' . $user->last_name) . '&color=7F9CF5&background=EBF4FF' }}"
                                                    alt="{{ $user->first_name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $user->role === 'ADMIN' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $user->role === 'MANAGER' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $user->role === 'USER' ? 'bg-gray-100 text-gray-800' : '' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $user->status === 'ACTIVE' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $user->status === 'INACTIVE' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $user->status === 'SUSPENDED' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                            @if ($user->locked_at)
                                                <span
                                                    class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-lock mr-1"></i> Locked
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->email_verified_at ? $user->email_verified_at->format('M j, Y') : 'Never' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('management.users.show', $user) }}"
                                                class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                                title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('management.users.edit', $user) }}"
                                                class="text-green-600 hover:text-green-900 transition-colors duration-200"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('management.toggle-status', $user) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200"
                                                    title="{{ $user->status === 'ACTIVE' ? 'Deactivate' : 'Activate' }}">
                                                    <i
                                                        class="fas {{ $user->status === 'ACTIVE' ? 'fa-pause' : 'fa-play' }}"></i>
                                                </button>
                                            </form>
                                            @if ($user->locked_at)
                                                <form action="{{ route('management.users.unlock', $user) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="text-green-600 hover:text-green-900 transition-colors duration-200"
                                                        title="Unlock Account">
                                                        <i class="fas fa-unlock"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('management.users.destroy', $user) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-lg">No users found</p>
                                        <p class="text-sm mt-1">Get started by creating your first user</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($users->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
