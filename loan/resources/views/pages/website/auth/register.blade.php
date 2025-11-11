<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Londa Loans - Register</title>
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

        .register-container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            background-color: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: fadeIn 0.8s ease-out;
        }

        .register-left {
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

        .register-left::before {
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

        .benefits {
            list-style: none;
            margin-top: 2rem;
        }

        .benefits li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .benefit-icon {
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

        .benefit-content h3 {
            margin-bottom: 0.3rem;
            font-size: 1.1rem;
        }

        .benefit-content p {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .register-right {
            flex: 1.2;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;           
            max-height: 90vh;
            overflow-y: auto;
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

        .register-header {
            margin-bottom: 2rem;
        }

        .register-header h2 {
            color: var(--secondary-color);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .register-header p {
            color: var(--text-light);
        }

        .register-form {
            width: 100%;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
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

        .form-label .required {
            color: var(--error-color);
        }

        .input-with-icon {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-input.with-icon {
            padding-left: 3rem;
        }

        .form-input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(219, 145, 35, 0.2);
        }

        .form-input.success {
            border-color: var(--success-color);
        }

        .form-input.error {
            border-color: var(--error-color);
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

        .file-input-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1rem;
            background-color: var(--light-bg);
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .file-input-label:hover {
            border-color: var(--primary-color);
            background-color: rgba(219, 145, 35, 0.05);
        }

        .file-input-label i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .file-name {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-light);
            display: none;
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

        .terms-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .terms-group input {
            margin-right: 0.5rem;
            margin-top: 0.25rem;
        }

        .terms-text {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .terms-text a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        .register-button {
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

        .register-button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .register-button:disabled {
            background-color: var(--border-color);
            cursor: not-allowed;
            transform: none;
        }

        .login-link {
            text-align: center;
            color: var(--text-light);
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .login-link a:hover {
            text-decoration: underline;
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
            .register-container {
                flex-direction: column;
                max-width: 500px;
            }

            .register-left {
                padding: 2rem;
            }

            .register-right {
                padding: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {

            .register-left,
            .register-right {
                padding: 1.5rem;
            }

            .welcome-text h1 {
                font-size: 1.8rem;
            }

            .register-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <!-- Left Side: Branding and Information -->
        <div class="register-left">
            <div class="logo">
                <div class="logo-icon">
                    <span style="color: #db9123; font-weight: bold; font-size: 1.2rem;">
                       <img height="40"  width="40" src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans Logo" />
                    </span>
                </div>
                <div class="logo-text">
                    <span class="logo-londa">Londa</span>
                    <span class="logo-loans">Loans</span>
                </div>
            </div>
            <div class="welcome-text">
                <h1>Join Londa Loans</h1>
                <p>Create your account to access exclusive financial solutions and grow your business.</p>
            </div>
            <ul class="benefits">
                <li>
                    <div class="benefit-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Fast Approval</h3>
                        <p>Get quick decisions on your loan applications with our streamlined process.</p>
                    </div>
                </li>
                <li>
                    <div class="benefit-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Secure & Protected</h3>
                        <p>Your data is encrypted and protected with enterprise-grade security.</p>
                    </div>
                </li>
                <li>
                    <div class="benefit-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Growth Opportunities</h3>
                        <p>Access funding solutions designed specifically for marketing professionals.</p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Right Side: Registration Form -->
        <div class="register-right">
            <div class="back-to-login">
                <a href="{{route('login')}}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>
            </div>

            <div class="register-header">
                <h2>Create Your Account</h2>
                <p>Fill in your details to get started with Londa Loans</p>
            </div>

            <form class="register-form" id="registerForm" method="POST" action="{{route('login')}}"
                enctype="multipart/form-data">
                @csrf

                <!-- Personal Information -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name <span class="required">*</span></label>
                        <div class="input-with-icon">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="first_name" name="first_name" class="form-input with-icon"
                                placeholder="Enter your first name" required />
                        </div>
                        <div class="error-message" id="firstNameError">Please enter your first name</div>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name <span class="required">*</span></label>
                        <div class="input-with-icon">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="last_name" name="last_name" class="form-input with-icon"
                                placeholder="Enter your last name" required />
                        </div>
                        <div class="error-message" id="lastNameError">Please enter your last name</div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address <span class="required">*</span></label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input with-icon"
                            placeholder="Enter your email address" required />
                    </div>
                    <div class="error-message" id="emailError">Please enter a valid email address</div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Phone Number <span
                                class="required">*</span></label>
                        <div class="input-with-icon">
                            <i class="fas fa-phone input-icon"></i>
                            <input type="tel" id="phone_number" name="phone_number" class="form-input with-icon"
                                placeholder="Enter your phone number" required />
                        </div>
                        <div class="error-message" id="phoneError">Please enter a valid phone number</div>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth" class="form-label">Date of Birth <span
                                class="required">*</span></label>
                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-input" required />
                        <div class="error-message" id="dobError">Please enter your date of birth</div>
                    </div>
                </div>

                <!-- Profile Picture -->
                <div class="form-group">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <div class="file-input-container">
                        <input type="file" id="profile_picture" name="profile_picture" class="file-input"
                            accept="image/*" />
                        <label for="profile_picture" class="file-input-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            Choose Profile Picture
                        </label>
                    </div>
                    <div class="file-name" id="fileName">No file chosen</div>
                    <div class="error-message" id="fileError">Please select a valid image file</div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password <span class="required">*</span></label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-input with-icon"
                            placeholder="Create a password" required />
                        <button type="button" class="password-toggle" id="passwordToggle"><i
                                class="fas fa-eye"></i></button>
                    </div>
                    <div class="password-strength" id="passwordStrength">
                        <div class="strength-meter">
                            <div class="strength-fill"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Password strength</div>
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
                    <div class="error-message" id="passwordError">Please enter a valid password</div>
                </div>

                <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm Password <span
                            class="required">*</span></label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="confirm_password" name="confirm_password"
                            class="form-input with-icon" placeholder="Confirm your password" required />
                        <button type="button" class="password-toggle" id="confirmPasswordToggle"><i
                                class="fas fa-eye"></i></button>
                    </div>
                    <div class="error-message" id="confirmPasswordError">Passwords do not match</div>
                </div>

                <!-- Terms and Conditions -->
                <div class="terms-group">
                    <input type="checkbox" id="terms" name="terms" required />
                    <label for="terms" class="terms-text">I agree to the <a href="/terms" target="_blank">Terms
                            of Service</a> and <a href="/privacy" target="_blank">Privacy Policy</a></label>
                </div>
                <div class="error-message" id="termsError">You must agree to the terms and conditions</div>

                <button type="submit" class="register-button" id="registerButton">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </button>

                <div class="login-link">
                    Already have an account? <a href="{{route('login')}}">Sign in here</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.getElementById('registerForm')
            const firstNameInput = document.getElementById('first_name')
            const lastNameInput = document.getElementById('last_name')
            const emailInput = document.getElementById('email')
            const phoneInput = document.getElementById('phone_number')
            const dobInput = document.getElementById('date_of_birth')
            const profilePictureInput = document.getElementById('profile_picture')
            const passwordInput = document.getElementById('password')
            const confirmPasswordInput = document.getElementById('confirm_password')
            const termsInput = document.getElementById('terms')
            const passwordToggle = document.getElementById('passwordToggle')
            const confirmPasswordToggle = document.getElementById('confirmPasswordToggle')
            const registerButton = document.getElementById('registerButton')
            const fileName = document.getElementById('fileName')

            // Requirement icons
            const lengthIcon = document.getElementById('lengthIcon')
            const uppercaseIcon = document.getElementById('uppercaseIcon')
            const lowercaseIcon = document.getElementById('lowercaseIcon')
            const numberIcon = document.getElementById('numberIcon')
            const specialIcon = document.getElementById('specialIcon')

            // Set maximum date for date of birth (18 years ago)
            const today = new Date()
            const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate())
            dobInput.max = maxDate.toISOString().split('T')[0]

            // Load saved form data if available
            loadFormData()

            // Toggle password visibility
            passwordToggle.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password'
                passwordInput.setAttribute('type', type)
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' :
                    '<i class="fas fa-eye-slash"></i>'
            })

            confirmPasswordToggle.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password'
                confirmPasswordInput.setAttribute('type', type)
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' :
                    '<i class="fas fa-eye-slash"></i>'
            })

            // File input handler
            profilePictureInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    fileName.textContent = this.files[0].name
                    fileName.style.display = 'block'

                    // Validate file type
                    const file = this.files[0]
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp']
                    if (!validTypes.includes(file.type)) {
                        showError('fileError', 'Please select a valid image file (JPEG, PNG, GIF, WebP)')
                        this.value = ''
                        fileName.style.display = 'none'
                    } else {
                        hideError('fileError')
                        // Check file size (max 5MB)
                        if (file.size > 5 * 1024 * 1024) {
                            showError('fileError', 'File size must be less than 5MB')
                            this.value = ''
                            fileName.style.display = 'none'
                        } else {
                            hideError('fileError')
                        }
                    }
                } else {
                    fileName.style.display = 'none'
                }
            })

            // Password strength checker
            passwordInput.addEventListener('input', function() {
                checkPasswordStrength(this.value)
                validateForm()
            })

            // Real-time validation
            const formInputs = [firstNameInput, lastNameInput, emailInput, phoneInput, dobInput,
                confirmPasswordInput, termsInput
            ]
            formInputs.forEach((input) => {
                input.addEventListener('input', function() {
                    validateField(this)
                    validateForm()
                    saveFormData()
                })
            })

            // Form submission
            registerForm.addEventListener('submit', function(event) {
                event.preventDefault()

                if (validateForm()) {
                    // Show loading state
                    registerButton.disabled = true
                    registerButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...'

                    // Simulate API call
                    setTimeout(() => {
                        // Clear saved form data on successful submission
                        clearFormData()
                        // Success - redirect to login page
                        window.location.href = "{{route('login')}}"
                    }, 2000)
                }
            })

            function validateField(field) {
                const fieldId = field.id
                const value = field.value.trim()

                // Reset field styling
                field.classList.remove('success', 'error')

                switch (fieldId) {
                    case 'first_name':
                    case 'last_name':
                        if (value.length < 2) {
                            field.classList.add('error')
                            return false
                        } else {
                            field.classList.add('success')
                            return true
                        }
                        break

                    case 'email':
                        if (!validateEmail(value)) {
                            field.classList.add('error')
                            return false
                        } else {
                            field.classList.add('success')
                            return true
                        }
                        break

                    case 'phone_number':
                        if (!validatePhone(value)) {
                            field.classList.add('error')
                            return false
                        } else {
                            field.classList.add('success')
                            return true
                        }
                        break

                    case 'date_of_birth':
                        if (!value) {
                            field.classList.add('error')
                            return false
                        } else {
                            const dob = new Date(value)
                            if (dob > maxDate) {
                                field.classList.add('error')
                                return false
                            } else {
                                field.classList.add('success')
                                return true
                            }
                        }
                        break

                    case 'confirm_password':
                        if (value !== passwordInput.value) {
                            field.classList.add('error')
                            return false
                        } else if (value && passwordInput.value) {
                            field.classList.add('success')
                            return true
                        }
                        break

                    case 'terms':
                        if (!field.checked) {
                            return false
                        } else {
                            return true
                        }
                        break
                }

                return true
            }

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
                const passwordStrength = document.getElementById('passwordStrength')
                passwordStrength.className = 'password-strength'
                const strengthFill = passwordStrength.querySelector('.strength-fill')
                const strengthText = document.getElementById('strengthText')

                if (password.length === 0) {
                    strengthText.textContent = 'Password strength'
                    strengthText.style.color = 'var(--text-light)'
                    passwordInput.classList.remove('success', 'error')
                } else if (strength <= 1) {
                    passwordStrength.classList.add('strength-weak')
                    strengthText.textContent = 'Weak password'
                    strengthText.style.color = 'var(--error-color)'
                    passwordInput.classList.add('error')
                    passwordInput.classList.remove('success')
                } else if (strength <= 3) {
                    passwordStrength.classList.add('strength-medium')
                    strengthText.textContent = 'Medium strength'
                    strengthText.style.color = 'var(--warning-color)'
                    passwordInput.classList.add('error')
                    passwordInput.classList.remove('success')
                } else {
                    passwordStrength.classList.add('strength-strong')
                    strengthText.textContent = 'Strong password'
                    strengthText.style.color = 'var(--success-color)'
                    passwordInput.classList.add('success')
                    passwordInput.classList.remove('error')
                }

                return strength
            }

            function updateRequirementIcon(iconElement, met) {
                const icon = iconElement.querySelector('i')
                icon.className = met ? 'fas fa-check-circle requirement-met' : 'fas fa-circle requirement-unmet'
            }

            function validateForm() {
                let isValid = true

                // Reset all error messages
                hideAllErrors()

                // Validate first name
                if (!firstNameInput.value.trim()) {
                    showError('firstNameError', 'Please enter your first name')
                    isValid = false
                } else if (firstNameInput.value.trim().length < 2) {
                    showError('firstNameError', 'First name must be at least 2 characters')
                    isValid = false
                }

                // Validate last name
                if (!lastNameInput.value.trim()) {
                    showError('lastNameError', 'Please enter your last name')
                    isValid = false
                } else if (lastNameInput.value.trim().length < 2) {
                    showError('lastNameError', 'Last name must be at least 2 characters')
                    isValid = false
                }

                // Validate email
                if (!validateEmail(emailInput.value.trim())) {
                    showError('emailError', 'Please enter a valid email address')
                    isValid = false
                }

                // Validate phone number
                if (!validatePhone(phoneInput.value.trim())) {
                    showError('phoneError', 'Please enter a valid phone number')
                    isValid = false
                }

                // Validate date of birth
                if (!dobInput.value) {
                    showError('dobError', 'Please enter your date of birth')
                    isValid = false
                } else {
                    const dob = new Date(dobInput.value)
                    if (dob > maxDate) {
                        showError('dobError', 'You must be at least 18 years old')
                        isValid = false
                    }
                }

                // Validate password strength
                const strength = checkPasswordStrength(passwordInput.value)
                if (strength < 3 && passwordInput.value) {
                    showError('passwordError', 'Please choose a stronger password')
                    isValid = false
                } else if (!passwordInput.value) {
                    showError('passwordError', 'Please enter a password')
                    isValid = false
                }

                // Validate password confirmation
                if (passwordInput.value !== confirmPasswordInput.value) {
                    showError('confirmPasswordError', 'Passwords do not match')
                    isValid = false
                }

                // Validate terms
                if (!termsInput.checked) {
                    showError('termsError', 'You must agree to the terms and conditions')
                    isValid = false
                }

                // Enable/disable submit button
                registerButton.disabled = !isValid

                return isValid
            }

            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
                return re.test(String(email).toLowerCase())
            }

            function validatePhone(phone) {
                const re = /^[\+]?[1-9][\d]{0,15}$/
                return re.test(String(phone).replace(/\D/g, ''))
            }

            function showError(elementId, message) {
                const element = document.getElementById(elementId)
                element.textContent = message
                element.style.display = 'block'
            }

            function hideError(elementId) {
                const element = document.getElementById(elementId)
                element.style.display = 'none'
            }

            function hideAllErrors() {
                const errorElements = document.querySelectorAll('.error-message')
                errorElements.forEach((element) => {
                    element.style.display = 'none'
                })
            }

            // Form data persistence functions
            function saveFormData() {
                const formData = {
                    firstName: firstNameInput.value,
                    lastName: lastNameInput.value,
                    email: emailInput.value,
                    phone: phoneInput.value,
                    dob: dobInput.value
                }
                localStorage.setItem('londaLoansRegistration', JSON.stringify(formData))
            }

            function loadFormData() {
                const savedData = localStorage.getItem('londaLoansRegistration')
                if (savedData) {
                    const formData = JSON.parse(savedData)
                    firstNameInput.value = formData.firstName || ''
                    lastNameInput.value = formData.lastName || ''
                    emailInput.value = formData.email || ''
                    phoneInput.value = formData.phone || ''
                    dobInput.value = formData.dob || ''

                    // Validate loaded data
                    validateForm()
                }
            }

            function clearFormData() {
                localStorage.removeItem('londaLoansRegistration')
            }

            // Demo functionality
            console.log('Registration Page Loaded')
            console.log('This page allows users to create a new account with comprehensive validation.')
        })
    </script>
</body>

</html>
