@extends('layouts.admin.main')

@section('title', 'Change Password')

@section('content')
    <div class="min-h-screen bg-white rounded-lg py-8">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-4 sm:mb-0">
                        <nav class="flex mb-4" aria-label="Breadcrumb">
                            <ol class="flex items-center space-x-2 text-sm">
                                <li>
                                    <a href="{{ route('management.dashboard') }}"
                                        class="text-gray-500 hover:text-gray-700 transition-colors">Dashboard</a>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                                </li>
                                <li>
                                    <a href="{{ route('management.profile') }}"
                                        class="text-gray-500 hover:text-gray-700 transition-colors">Profile</a>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                                </li>
                                <li>
                                    <span class="text-londa-orange font-medium">Change Password</span>
                                </li>
                            </ol>
                        </nav>
                        <h1 class="text-3xl font-bold text-gray-900">Change Password</h1>
                        <p class="text-gray-600 mt-2">Secure your account with a new password</p>
                    </div>
                    <a href="{{ route('management.profile') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Profile
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 bg-gray-50 p-4 rounded-lg">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center space-x-4 mb-6">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-londa-orange to-orange-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-key text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Password Security</h3>
                                <p class="text-sm text-gray-500">Keep your account safe</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Minimum 8 characters</p>
                                    <p class="text-xs text-gray-500">Longer passwords are stronger</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Mix characters</p>
                                    <p class="text-xs text-gray-500">Use upper, lower, numbers & symbols</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Avoid personal info</p>
                                    <p class="text-xs text-gray-500">No names, birthdays, or common words</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Unique password</p>
                                    <p class="text-xs text-gray-500">Don't reuse from other sites</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <form action="{{ route('management.change-password') }}" method="POST">
                            @csrf

                            <!-- Form Header -->
                            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                                <h2 class="text-lg font-semibold text-gray-900">Update Your Password</h2>
                                <p class="text-sm text-gray-600 mt-1">Enter your current and new password below</p>
                            </div>

                            <!-- Form Fields -->
                            <div class="p-6 space-y-6">
                                <!-- Current Password -->
                                <div class="space-y-2">
                                    <label for="current_password" class="block text-sm font-medium text-gray-700">
                                        Current Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="password" name="current_password" id="current_password"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-all duration-200 placeholder-gray-400"
                                            placeholder="Enter your current password" required
                                            autocomplete="current-password">
                                        <button type="button"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                                            onclick="togglePassword('current_password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <p class="text-sm text-red-600 mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div class="space-y-2">
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        New Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-all duration-200 placeholder-gray-400"
                                            placeholder="Create a new password" required autocomplete="new-password">
                                        <button type="button"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                                            onclick="togglePassword('password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="text-sm text-red-600 mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Confirm New Password -->
                                <div class="space-y-2">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                        Confirm New Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange transition-all duration-200 placeholder-gray-400"
                                            placeholder="Confirm your new password" required autocomplete="new-password">
                                        <button type="button"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                                            onclick="togglePassword('password_confirmation')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Password Strength Meter -->
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <label class="block text-sm font-medium text-gray-700">Password Strength</label>
                                        <span id="passwordStrengthText" class="text-sm font-medium text-gray-500">Not
                                            set</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div id="passwordStrength"
                                            class="h-2 rounded-full transition-all duration-500 ease-out"></div>
                                    </div>
                                    <div id="passwordRequirements" class="grid grid-cols-2 gap-2 text-xs text-gray-500">
                                        <div class="flex items-center" id="reqLength">
                                            <i class="fas fa-times text-red-400 mr-2"></i>
                                            <span>8+ characters</span>
                                        </div>
                                        <div class="flex items-center" id="reqCase">
                                            <i class="fas fa-times text-red-400 mr-2"></i>
                                            <span>Upper & lowercase</span>
                                        </div>
                                        <div class="flex items-center" id="reqNumber">
                                            <i class="fas fa-times text-red-400 mr-2"></i>
                                            <span>Includes number</span>
                                        </div>
                                        <div class="flex items-center" id="reqSpecial">
                                            <i class="fas fa-times text-red-400 mr-2"></i>
                                            <span>Special character</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div
                                class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-between space-y-3 sm:space-y-0 sm:items-center">
                                <p class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Make sure to save your new password securely
                                </p>
                                <div class="flex space-x-3">
                                    <a href="{{ route('management.profile') }}"
                                        class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200 font-medium shadow-sm hover:shadow">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                        class="px-6 py-2.5 bg-gradient-to-r from-londa-orange to-orange-600 text-white rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-200 font-medium shadow-sm hover:shadow flex items-center group">
                                        <i class="fas fa-key mr-2 group-hover:scale-110 transition-transform"></i>
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');

            if (field.type === 'password') {
                field.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                field.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');
            const requirements = {
                length: document.getElementById('reqLength'),
                case: document.getElementById('reqCase'),
                number: document.getElementById('reqNumber'),
                special: document.getElementById('reqSpecial')
            };

            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                let fulfilled = 0;
                let total = 4;

                // Check requirements
                const hasLength = password.length >= 8;
                const hasCase = /[a-z]/.test(password) && /[A-Z]/.test(password);
                const hasNumber = /\d/.test(password);
                const hasSpecial = /[^a-zA-Z\d]/.test(password);

                // Update requirement indicators
                updateRequirement(requirements.length, hasLength);
                updateRequirement(requirements.case, hasCase);
                updateRequirement(requirements.number, hasNumber);
                updateRequirement(requirements.special, hasSpecial);

                // Calculate strength
                if (hasLength) strength++;
                if (hasCase) strength++;
                if (hasNumber) strength++;
                if (hasSpecial) strength++;

                // Update strength bar and text
                const percentage = (strength / total) * 100;
                let color = '';
                let text = '';

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

                strengthBar.className = `h-2 rounded-full transition-all duration-500 ease-out ${color}`;
                strengthBar.style.width = `${percentage}%`;
                strengthText.textContent = text;
                strengthText.className = `text-sm font-medium ${color.replace('bg-', 'text-')}`;
            });

            function updateRequirement(element, fulfilled) {
                const icon = element.querySelector('i');
                if (fulfilled) {
                    icon.className = 'fas fa-check text-green-500 mr-2';
                    element.classList.add('text-green-600');
                    element.classList.remove('text-gray-500');
                } else {
                    icon.className = 'fas fa-times text-red-400 mr-2';
                    element.classList.remove('text-green-600');
                    element.classList.add('text-gray-500');
                }
            }
        });
    </script>

    <style>
        .password-strength-transition {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
@endsection
