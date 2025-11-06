<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Londa Loans - Reset Password</title>

    <!-- Laravel Asset Helper -->
    <script defer src="{{ asset('assets/js/tailwind.js') }}"></script>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logos/londa.jpg') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary-color: #db9123;
            --secondary-color: #7a4603;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --text-dark: #333333;
            --text-light: #666666;
            --border-color: #e0e0e0;
            --error-color: #e74c3c;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .reset-password-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: fadeIn 0.8s ease-out;
        }

        .reset-password-left {
            flex: 1;
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            color: var(--white);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .reset-password-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background-color: var(--white);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .logo-text {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .logo-londa {
            color: var(--white);
        }

        .logo-loans {
            color: var(--primary-color);
        }

        .welcome-text {
            margin-bottom: 1.5rem;
        }

        .welcome-text h1 {
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .welcome-text p {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .security-tips {
            list-style: none;
            margin-top: 2rem;
        }

        .security-tips li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .tip-icon {
            width: 30px;
            height: 30px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
            font-size: 0.9rem;
        }

        .tip-content h3 {
            margin-bottom: 0.3rem;
            font-size: 1.1rem;
        }

        .tip-content p {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .reset-password-right {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .back-to-login {
            margin-bottom: 1.5rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .back-link i {
            margin-right: 0.5rem;
        }

        .reset-password-header {
            margin-bottom: 2rem;
        }

        .reset-password-header h2 {
            color: var(--secondary-color);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .reset-password-header p {
            color: var(--text-light);
        }

        .reset-password-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .input-with-icon {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(219, 145, 35, 0.2);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
        }

        .password-strength {
            margin-top: 0.5rem;
        }

        .strength-meter {
            height: 4px;
            background-color: var(--border-color);
            border-radius: 2px;
            margin-bottom: 0.5rem;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: var(--transition);
            border-radius: 2px;
        }

        .strength-weak .strength-fill {
            width: 33%;
            background-color: var(--error-color);
        }

        .strength-medium .strength-fill {
            width: 66%;
            background-color: var(--warning-color);
        }

        .strength-strong .strength-fill {
            width: 100%;
            background-color: var(--success-color);
        }

        .strength-text {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .password-requirements {
            margin-top: 1rem;
            padding: 1rem;
            background-color: var(--light-bg);
            border-radius: 8px;
            font-size: 0.85rem;
        }

        .password-requirements h4 {
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .requirements-list {
            list-style: none;
        }

        .requirements-list li {
            display: flex;
            align-items: center;
            margin-bottom: 0.3rem;
        }

        .requirement-icon {
            margin-right: 0.5rem;
            width: 16px;
            text-align: center;
        }

        .requirement-met {
            color: var(--success-color);
        }

        .requirement-unmet {
            color: var(--text-light);
        }

        .reset-button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .reset-button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .reset-button:disabled {
            background-color: var(--border-color);
            cursor: not-allowed;
            transform: none;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
        }

        .success-message {
            color: var(--success-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid transparent;
        }

        .alert-success {
            color: #2ecc71;
            background-color: rgba(46, 204, 113, 0.1);
            border-color: #2ecc71;
        }

        .alert-error {
            color: #e74c3c;
            background-color: rgba(231, 76, 60, 0.1);
            border-color: #e74c3c;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .reset-password-container {
                flex-direction: column;
                max-width: 450px;
            }

            .reset-password-left {
                padding: 2rem;
            }

            .reset-password-right {
                padding: 2rem;
            }
        }

        @media (max-width: 480px) {

            .reset-password-left,
            .reset-password-right {
                padding: 1.5rem;
            }

            .welcome-text h1 {
                font-size: 1.8rem;
            }

            .reset-password-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="reset-password-container">
        <!-- Left Side: Branding and Information -->
        <div class="reset-password-left">
            <div class="logo">
                <div class="logo-icon">
                    <span style="color: #db9123; font-weight: bold; font-size: 1.2rem;">
                        <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans Logo" width="40" />
                    </span>
                </div>
                <div class="logo-text">
                    <span class="logo-londa">Londa</span>
                    <span class="logo-loans">Loans</span>
                </div>
            </div>
            <div class="welcome-text">
                <h1>Create New Password</h1>
                <p>Choose a strong, secure password to protect your account.</p>
            </div>
            <ul class="security-tips">
                <li>
                    <div class="tip-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="tip-content">
                        <h3>Use a Strong Password</h3>
                        <p>Combine uppercase, lowercase, numbers, and special characters.</p>
                    </div>
                </li>
                <li>
                    <div class="tip-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="tip-content">
                        <h3>Make it Unique</h3>
                        <p>Avoid reusing passwords from other accounts.</p>
                    </div>
                </li>
                <li>
                    <div class="tip-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="tip-content">
                        <h3>Regular Updates</h3>
                        <p>Change your password periodically for better security.</p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Right Side: Reset Password Form -->
        <div class="reset-password-right">
            <div class="back-to-login">
                <a href="{{ route('management.login') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>
            </div>

            <div class="reset-password-header">
                <h2>Reset Your Password</h2>
                <p>Create a new password for your Londa Loans account.</p>
            </div>

            <!-- Laravel Session Messages -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Laravel Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="reset-password-form" id="resetPasswordForm" action="{{ route('management.password.update') }}"
                method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password"
                            class="form-input @error('password') shake @enderror" placeholder="Enter new password"
                            required />
                        <button type="button" class="password-toggle" id="togglePassword"><i
                                class="fas fa-eye"></i></button>
                    </div>
                    <div class="password-strength" id="passwordStrength">
                        <div class="strength-meter">
                            <div class="strength-fill"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Password strength</div>
                    </div>
                    <div class="error-message" id="passwordError">Please enter a valid password</div>
                    @error('password')
                        <div class="error-message" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-input" placeholder="Confirm new password" required />
                        <button type="button" class="password-toggle" id="toggleConfirmPassword"><i
                                class="fas fa-eye"></i></button>
                    </div>
                    <div class="error-message" id="confirmPasswordError">Passwords do not match</div>
                </div>

                <div class="password-requirements">
                    <h4>Password Requirements:</h4>
                    <ul class="requirements-list">
                        <li>
                            <span class="requirement-icon" id="lengthIcon"><i
                                    class="fas fa-circle requirement-unmet"></i></span>
                            <span>At least 8 characters long</span>
                        </li>
                        <li>
                            <span class="requirement-icon" id="uppercaseIcon"><i
                                    class="fas fa-circle requirement-unmet"></i></span>
                            <span>Contains uppercase letter</span>
                        </li>
                        <li>
                            <span class="requirement-icon" id="lowercaseIcon"><i
                                    class="fas fa-circle requirement-unmet"></i></span>
                            <span>Contains lowercase letter</span>
                        </li>
                        <li>
                            <span class="requirement-icon" id="numberIcon"><i
                                    class="fas fa-circle requirement-unmet"></i></span>
                            <span>Contains number</span>
                        </li>
                        <li>
                            <span class="requirement-icon" id="specialIcon"><i
                                    class="fas fa-circle requirement-unmet"></i></span>
                            <span>Contains special character</span>
                        </li>
                    </ul>
                </div>

                <button type="submit" class="reset-button" id="resetButton">
                    <i class="fas fa-key"></i>
                    Reset Password
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resetPasswordForm = document.getElementById('resetPasswordForm')
            const passwordInput = document.getElementById('password')
            const confirmPasswordInput = document.getElementById('password_confirmation')
            const togglePassword = document.getElementById('togglePassword')
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword')
            const resetButton = document.getElementById('resetButton')
            const passwordError = document.getElementById('passwordError')
            const confirmPasswordError = document.getElementById('confirmPasswordError')
            const passwordStrength = document.getElementById('passwordStrength')
            const strengthText = document.getElementById('strengthText')

            // Requirement icons
            const lengthIcon = document.getElementById('lengthIcon')
            const uppercaseIcon = document.getElementById('uppercaseIcon')
            const lowercaseIcon = document.getElementById('lowercaseIcon')
            const numberIcon = document.getElementById('numberIcon')
            const specialIcon = document.getElementById('specialIcon')

            // Toggle password visibility
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password'
                passwordInput.setAttribute('type', type)
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' :
                    '<i class="fas fa-eye-slash"></i>'
            })

            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password'
                confirmPasswordInput.setAttribute('type', type)
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' :
                    '<i class="fas fa-eye-slash"></i>'
            })

            // Password strength checker
            passwordInput.addEventListener('input', function() {
                checkPasswordStrength(this.value)
                validateForm()
            })

            confirmPasswordInput.addEventListener('input', function() {
                validateForm()
            })

            // Form submission - remove preventDefault to allow Laravel form submission
            resetPasswordForm.addEventListener('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault()
                } else {
                    // Show loading state
                    resetButton.disabled = true
                    resetButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Resetting Password...'
                }
            })

            function checkPasswordStrength(password) {
                let strength = 0
                const requirements = {
                    length: password.length >= 8,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[^A-Za-z0-9]/.test(password)
                }

                // Update requirement icons
                updateRequirementIcon(lengthIcon, requirements.length)
                updateRequirementIcon(uppercaseIcon, requirements.uppercase)
                updateRequirementIcon(lowercaseIcon, requirements.lowercase)
                updateRequirementIcon(numberIcon, requirements.number)
                updateRequirementIcon(specialIcon, requirements.special)

                // Calculate strength
                if (requirements.length) strength++
                if (requirements.uppercase) strength++
                if (requirements.lowercase) strength++
                if (requirements.number) strength++
                if (requirements.special) strength++

                // Update strength meter
                passwordStrength.className = 'password-strength'
                const strengthFill = passwordStrength.querySelector('.strength-fill')

                if (strength <= 1) {
                    passwordStrength.classList.add('strength-weak')
                    strengthText.textContent = 'Weak password'
                    strengthText.style.color = 'var(--error-color)'
                } else if (strength <= 3) {
                    passwordStrength.classList.add('strength-medium')
                    strengthText.textContent = 'Medium strength'
                    strengthText.style.color = 'var(--warning-color)'
                } else {
                    passwordStrength.classList.add('strength-strong')
                    strengthText.textContent = 'Strong password'
                    strengthText.style.color = 'var(--success-color)'
                }

                return strength
            }

            function updateRequirementIcon(iconElement, met) {
                const icon = iconElement.querySelector('i')
                icon.className = met ? 'fas fa-check-circle requirement-met' : 'fas fa-circle requirement-unmet'
            }

            function validateForm() {
                let isValid = true

                // Reset error messages
                passwordError.style.display = 'none'
                confirmPasswordError.style.display = 'none'
                passwordInput.classList.remove('shake')
                confirmPasswordInput.classList.remove('shake')

                const password = passwordInput.value
                const confirmPassword = confirmPasswordInput.value

                // Check password strength
                const strength = checkPasswordStrength(password)
                if (strength < 3 && password.length > 0) {
                    passwordError.textContent = 'Please choose a stronger password'
                    passwordError.style.display = 'block'
                    passwordInput.classList.add('shake')
                    isValid = false
                }

                // Check if passwords match
                if (password && confirmPassword && password !== confirmPassword) {
                    confirmPasswordError.style.display = 'block'
                    confirmPasswordInput.classList.add('shake')
                    isValid = false
                }

                // Enable/disable submit button
                resetButton.disabled = !isValid || !password || !confirmPassword

                return isValid
            }

            // Initial validation
            validateForm()
        })
    </script>
</body>

</html>
