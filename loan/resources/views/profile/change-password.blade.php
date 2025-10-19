@extends('layouts.admin.main')

@section('title', 'Change Password')

@section('content')
    <div class="px-6 py-4">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Change Password</h1>
                    <p class="text-gray-600 mt-1">Update your account password</p>
                </div>
                <a href="{{ route('management.profile') }}"
                    class="text-gray-600 hover:text-gray-900 transition-colors duration-200 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Profile
                </a>
            </div>
        </div>

        <div class="max-w-2xl">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('management.change-password') }}" method="POST">
                    @csrf

                    <div class="p-6 space-y-6">
                        <!-- Security Note -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-shield-alt text-blue-400 text-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Security Recommendations</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p>• Use a strong password with at least 8 characters</p>
                                        <p>• Include uppercase, lowercase, numbers, and symbols</p>
                                        <p>• Avoid using personal information</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current
                                Password *</label>
                            <input type="password" name="current_password" id="current_password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                required autocomplete="current-password">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password
                                *</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                required autocomplete="new-password">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm
                                New Password *</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-colors duration-200"
                                required autocomplete="new-password">
                        </div>

                        <!-- Password Strength Meter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password Strength</label>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div id="passwordStrength" class="h-2 rounded-full transition-all duration-300"></div>
                            </div>
                            <p id="passwordStrengthText" class="mt-1 text-sm text-gray-500"></p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg flex justify-end space-x-3">
                        <a href="{{ route('management.profile') }}"
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-londa-orange text-white rounded-lg hover:bg-orange-700 transition-colors duration-200 font-medium flex items-center">
                            <i class="fas fa-key mr-2"></i>
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');

            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                let text = '';
                let color = '';

                // Check password strength
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                if (password.match(/\d/)) strength++;
                if (password.match(/[^a-zA-Z\d]/)) strength++;

                // Update strength bar and text
                switch (strength) {
                    case 0:
                        color = 'bg-red-500';
                        text = 'Very Weak';
                        break;
                    case 1:
                        color = 'bg-red-400';
                        text = 'Weak';
                        break;
                    case 2:
                        color = 'bg-yellow-500';
                        text = 'Fair';
                        break;
                    case 3:
                        color = 'bg-green-400';
                        text = 'Good';
                        break;
                    case 4:
                        color = 'bg-green-600';
                        text = 'Strong';
                        break;
                }

                strengthBar.className = `h-2 rounded-full transition-all duration-300 ${color}`;
                strengthBar.style.width = `${(strength / 4) * 100}%`;
                strengthText.textContent = text;
                strengthText.className = `mt-1 text-sm ${color.replace('bg-', 'text-')}`;
            });
        });
    </script>
@endsection
