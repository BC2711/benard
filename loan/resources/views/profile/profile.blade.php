@extends('layouts.admin.main')

@section('title', 'My Profile')

@section('content')
    <div class="px-6 py-4 rounded-lg bg-white">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">My Profile</h1>
            <p class="text-gray-600 mt-1">Manage your personal information and account settings</p>
        </div>

        <div class="max-w-8xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Profile Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <form action="{{ route('management.update-profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="p-6 space-y-6">
                                <!-- Profile Picture -->
                                <div class="bg-gray-50 p-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Picture</h3>
                                    <div class="flex items-center space-x-6">
                                        <div class="flex-shrink-0">
                                            <div class="relative">
                                                <img id="profilePreview"
                                                    src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->first_name . ' ' . $user->last_name) . '&color=7F9CF5&background=EBF4FF&size=128' }}"
                                                    alt="Profile preview"
                                                    class="w-32 h-32 rounded-full object-cover border-4 border-londa-orange">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 rounded-full transition-all duration-200 flex items-center justify-center opacity-0 hover:opacity-100 cursor-pointer"
                                                    onclick="document.getElementById('profile_picture').click()">
                                                    <span class="text-white text-sm font-medium">Change</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <input type="file" name="profile_picture" id="profile_picture"
                                                accept="image/*" class="hidden" onchange="previewImage(this)">
                                            <p class="text-sm text-gray-600">Click on the image to upload a new profile
                                                picture</p>
                                            <p class="text-xs text-gray-500 mt-1">JPEG, PNG, JPG, GIF up to 2MB</p>
                                            @if ($user->profile_picture)
                                                <div class="mt-2">
                                                    <label class="flex items-center">
                                                        <input type="checkbox" name="remove_profile_picture" value="1"
                                                            class="rounded border-gray-300 text-londa-orange focus:ring-londa-orange">
                                                        <span class="ml-2 text-sm text-gray-600">Remove current profile
                                                            picture</span>
                                                    </label>
                                                </div>
                                            @endif
                                            @error('profile_picture')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Personal Information -->
                                <div class="bg-gray-50 p-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="first_name"
                                                class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                                            <input type="text" name="first_name" id="first_name"
                                                value="{{ old('first_name', $user->first_name) }}"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                                required>
                                            @error('first_name')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last
                                                Name *</label>
                                            <input type="text" name="last_name" id="last_name"
                                                value="{{ old('last_name', $user->last_name) }}"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                                required>
                                            @error('last_name')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="bg-gray-50 p-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                                                Address *</label>
                                            <input type="email" name="email" id="email"
                                                value="{{ old('email', $user->email) }}"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                                required>
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone
                                                Number *</label>
                                            <input type="tel" name="phone" id="phone"
                                                value="{{ old('phone', $user->phone) }}"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                                required>
                                            @error('phone')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <div class="bg-gray-50 p-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="bg-gray-50 p-6">
                                            <label for="username"
                                                class="block text-sm font-medium text-gray-700 mb-2">Username *</label>
                                            <input type="text" name="username" id="username"
                                                value="{{ old('username', $user->username) }}"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                                required>
                                            @error('username')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="bg-gray-50 p-6">
                                            <label for="date_of_birth"
                                                class="block text-sm font-medium text-gray-700 mb-2">Date of Birth *</label>
                                            <input type="date" name="date_of_birth" id="date_of_birth"
                                                value="{{ old('date_of_birth', $user->date_of_birth->format('Y-m-d')) }}"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                                required>
                                            @error('date_of_birth')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                        <div class="bg-gray-50 p-6">
                                            <label for="gender"
                                                class="block text-sm font-medium text-gray-700 mb-2">Gender *</label>
                                            <select name="gender" id="gender"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                                required>
                                                <option value="">Select Gender</option>
                                                @foreach ($genders as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ old('gender', $user->gender) == $value ? 'selected' : '' }}>
                                                        {{ $label }}</option>
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
                                            required>{{ old('address', $user->address) }}</textarea>
                                        @error('address')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2 bg-londa-orange text-white rounded-lg hover:bg-orange-700 transition-colors duration-200 font-medium flex items-center">
                                    <i class="fas fa-save mr-2"></i>
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column - Account Info & Actions -->
                <div class="space-y-6">
                    <!-- Account Information -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="p-6 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Information</h3>
                            <div class="space-y-4">
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
                                    <label class="block text-sm font-medium text-gray-500">Member Since</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('F j, Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Last Updated</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('F j, Y g:i A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="p-6 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ route('management.change-password') }}"
                                    class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <span class="font-medium text-gray-700">Change Password</span>
                                    <i class="fas fa-key text-gray-400"></i>
                                </a>

                                <a href="#"
                                    class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <span class="font-medium text-gray-700">Privacy Settings</span>
                                    <i class="fas fa-shield-alt text-gray-400"></i>
                                </a>

                                <a href="#"
                                    class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <span class="font-medium text-gray-700">Notification Preferences</span>
                                    <i class="fas fa-bell text-gray-400"></i>
                                </a>
                            </div>
                        </div>
                    </div>
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
