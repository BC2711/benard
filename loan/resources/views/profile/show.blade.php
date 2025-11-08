@extends('layouts.admin.main')

@section('title', 'User Details - ' . $user->first_name . ' ' . $user->last_name)
@section('title', 'User Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard.index') }}" class="text-sm text-gray-500 hover:text-gray-700">User Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">User</span>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">User Details - {{ $user->first_name }} {{ $user->last_name }}</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">User Details - {{ $user->first_name }} {{ $user->last_name }}</h1>

@endsection

@section('title', 'User Management')
@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-300">
        <div class="px-6 py-4">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 mt-1">View user information and activity</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('management.users.index') }}"
                            class="text-gray-600 hover:text-gray-900 transition-colors duration-200 flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Users
                        </a>
                        <a href="{{ route('management.users.edit', $user) }}"
                            class="bg-londa-orange text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors duration-200 font-medium flex items-center">
                            <i class="fas fa-edit mr-2"></i>
                            Edit User
                        </a>
                    </div>
                </div>
            </div>

            <div class="max-w-8xl">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 bg-gray-50 rounded-lg p-4">
                    <!-- Left Column - User Info -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Profile Card -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="p-6">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-20 w-20 rounded-full object-cover border-4 border-londa-orange"
                                            src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->first_name . ' ' . $user->last_name) . '&color=7F9CF5&background=EBF4FF&size=128' }}"
                                            alt="{{ $user->first_name }}">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h2 class="text-2xl font-bold text-gray-900">{{ $user->first_name }}
                                            {{ $user->last_name }}</h2>
                                        <p class="text-gray-600">{{ $user->email }}</p>
                                        <div class="flex items-center space-x-4 mt-2">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $user->role === 'ADMIN' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $user->role === 'MANAGER' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $user->role === 'USER' ? 'bg-gray-100 text-gray-800' : '' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        {{ $user->status === 'ACTIVE' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $user->status === 'INACTIVE' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $user->status === 'SUSPENDED' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                            @if ($user->locked_at)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-lock mr-1"></i> Locked
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-user-circle mr-2 text-londa-orange"></i>
                                    Personal Information
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Full Name</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $user->first_name }}
                                            {{ $user->last_name }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Username</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $user->username }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Date of Birth</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $user->date_of_birth->format('F j, Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Gender</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ ucfirst($user->gender) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-envelope mr-2 text-londa-orange"></i>
                                    Contact Information
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Email Address</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Phone Number</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $user->phone }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-500">Address</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $user->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Account Info & Actions -->
                    <div class="space-y-6">
                        <!-- Account Status -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Status</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Status</label>
                                        <p class="mt-1">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $user->status === 'ACTIVE' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $user->status === 'INACTIVE' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $user->status === 'SUSPENDED' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Role</label>
                                        <p class="mt-1">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $user->role === 'ADMIN' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $user->role === 'MANAGER' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $user->role === 'USER' ? 'bg-gray-100 text-gray-800' : '' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Email Verified</label>
                                        <p class="mt-1">
                                            @if ($user->email_verified_at)
                                                <span class="inline-flex items-center text-green-600">
                                                    <i class="fas fa-check-circle mr-2"></i>
                                                    Verified on {{ $user->email_verified_at->format('M j, Y') }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center text-yellow-600">
                                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                                    Not Verified
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                    @if ($user->locked_at)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">Account Locked</label>
                                            <p class="mt-1 text-red-600">
                                                <i class="fas fa-lock mr-2"></i>
                                                Since {{ $user->locked_at->format('M j, Y g:i A') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                                <div class="space-y-3">
                                    <form action="{{ route('management.toggle-status', $user) }}" method="POST"
                                        class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-left">
                                            <span class="font-medium text-gray-700">
                                                {{ $user->status === 'ACTIVE' ? 'Deactivate' : 'Activate' }} User
                                            </span>
                                            <i
                                                class="fas {{ $user->status === 'ACTIVE' ? 'fa-pause' : 'fa-play' }} text-gray-400"></i>
                                        </button>
                                    </form>

                                    @if ($user->locked_at)
                                        <form action="{{ route('management.unlock', $user) }}" method="POST"
                                            class="w-full">
                                            @csrf
                                            <button type="submit"
                                                class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-left">
                                                <span class="font-medium text-gray-700">Unlock Account</span>
                                                <i class="fas fa-unlock text-gray-400"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('management.users.edit', $user) }}"
                                        class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                        <span class="font-medium text-gray-700">Edit User</span>
                                        <i class="fas fa-edit text-gray-400"></i>
                                    </a>

                                    <form action="{{ route('management.users.destroy', $user) }}" method="POST"
                                        class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full flex items-center justify-between px-4 py-3 border border-red-300 rounded-lg hover:bg-red-50 transition-colors duration-200 text-left text-red-700"
                                            onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                            <span class="font-medium">Delete User</span>
                                            <i class="fas fa-trash text-red-400"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Account Activity -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Activity</h3>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Created</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $user->created_at->format('F j, Y g:i A') }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Last Updated</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $user->updated_at->format('F j, Y g:i A') }}
                                        </p>
                                    </div>
                                    @if ($user->email_verified_at)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">Email Verified</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $user->email_verified_at->format('F j, Y g:i A') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
