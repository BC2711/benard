@extends('layouts.admin.main')

@section('title', 'Create User')
@section('title', 'User Management')
@section('breadcrumbs')
    <nav class="flex items-center space-x-2">
        <a href="{{ route('management.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">User Management</a>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">User</span>
        <span class="text-gray-400">/</span>
        <span class="text-sm text-gray-500">Create</span>
    </nav>
@endsection
@section('page-icon')
    <i class="fas fa-users fa-lg text-gray-700"></i>
@endsection
@section('page-title')
    <h1 class="text-2xl font-bold text-gray-900">Create New User</h1>
    <p class="text-gray-600 mt-1">Add a new user to the system</p>
@endsection

@section('title', 'User Management')
@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 mt-1">Add a new user to the system</p>
                    </div>
                    <a href="{{ route('management.users.index') }}"
                        class="text-gray-600 hover:text-gray-900 transition-colors duration-200 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Users
                    </a>
                </div>
            </div>

            <div class="max-w-8xl">
                <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200">
                    <form action="{{ route('management.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="p-6 space-y-6">
                            <!-- Personal Information -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-user-circle mr-2 text-londa-orange"></i>
                                    Personal Information
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First
                                            Name
                                            *</label>
                                        <input type="text" name="first_name" id="first_name"
                                            value="{{ old('first_name') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            required>
                                        @error('first_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last
                                            Name
                                            *</label>
                                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            required>
                                        @error('last_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-envelope mr-2 text-londa-orange"></i>
                                    Contact Information
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                                            Address
                                            *</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            required>
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone
                                            Number
                                            *</label>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            required>
                                        @error('phone')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Account Information -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-key mr-2 text-londa-orange"></i>
                                    Account Information
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username
                                            *</label>
                                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            required>
                                        @error('username')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role
                                            *</label>
                                        <select name="role" id="role"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            required>
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ old('role') == $value ? 'selected' : '' }}>{{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                            *</label>
                                        <input type="password" name="password" id="password"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            required>
                                        @error('password')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="password_confirmation"
                                            class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-info-circle mr-2 text-londa-orange"></i>
                                    Additional Information
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date
                                            of
                                            Birth *</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                            value="{{ old('date_of_birth') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            required>
                                        @error('date_of_birth')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender
                                            *</label>
                                        <select name="gender" id="gender"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            required>
                                            <option value="">Select Gender</option>
                                            @foreach ($genders as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ old('gender') == $value ? 'selected' : '' }}>{{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address
                                        *</label>
                                    <textarea name="address" id="address" rows="3"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                        required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Profile Picture -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-camera mr-2 text-londa-orange"></i>
                                    Profile Picture
                                </h3>
                                <div class="flex items-center space-x-6">
                                    <div class="flex-shrink-0">
                                        <div class="relative">
                                            <img id="profilePreview"
                                                src="https://ui-avatars.com/api/?name=New+User&color=7F9CF5&background=EBF4FF&size=128"
                                                alt="Profile preview"
                                                class="w-32 h-32 rounded-full object-cover border-4 border-gray-200">
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 rounded-full transition-all duration-200 flex items-center justify-center opacity-0 hover:opacity-100">
                                                <span class="text-white text-sm font-medium">Change</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label for="profile_picture"
                                            class="block text-sm font-medium text-gray-700 mb-2">Upload Profile
                                            Picture</label>
                                        <input type="file" name="profile_picture" id="profile_picture"
                                            accept="image/*"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                            onchange="previewImage(this)">
                                        <p class="mt-1 text-sm text-gray-500">JPEG, PNG, JPG, GIF up to 2MB</p>
                                        @error('profile_picture')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Account Status
                                    *</label>
                                <select name="status" id="status"
                                    class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                    required>
                                    @foreach ($statuses as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('status') == $value ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg flex justify-end space-x-3">
                            <a href="{{ route('management.users.index') }}"
                                class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-londa-orange text-white rounded-lg hover:bg-orange-700 transition-colors duration-200 font-medium flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('profilePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
