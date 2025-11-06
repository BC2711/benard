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

    <!-- Include Alpine.js for x-data functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.2.4/cdn.min.js" defer></script>
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

        .forgot-password-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: fadeIn 0.8s ease-out;
        }

        .forgot-password-left {
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

        .forgot-password-left::before {
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

        .steps {
            list-style: none;
            margin-top: 2rem;
        }

        .steps li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .step-number {
            width: 30px;
            height: 30px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
            font-weight: 600;
        }

        .step-content h3 {
            margin-bottom: 0.3rem;
            font-size: 1.1rem;
        }

        .step-content p {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .forgot-password-right {
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

        .forgot-password-header {
            margin-bottom: 2rem;
        }

        .forgot-password-header h2 {
            color: var(--secondary-color);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .forgot-password-header p {
            color: var(--text-light);
        }

        .forgot-password-form {
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

        .divider {
            text-align: center;
            position: relative;
            margin: 1.5rem 0;
            color: var(--text-light);
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: var(--border-color);
            z-index: 1;
        }

        .divider span {
            background-color: var(--white);
            padding: 0 1rem;
            position: relative;
            z-index: 2;
        }

        .contact-support {
            text-align: center;
            color: var(--text-light);
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .contact-support a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .contact-support a:hover {
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

        .success-state {
            text-align: center;
            display: none;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background-color: rgba(46, 204, 113, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--success-color);
            font-size: 2rem;
        }

        .success-state h3 {
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .success-state p {
            color: var(--text-light);
            margin-bottom: 1.5rem;
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
            .forgot-password-container {
                flex-direction: column;
                max-width: 450px;
            }

            .forgot-password-left {
                padding: 2rem;
            }

            .forgot-password-right {
                padding: 2rem;
            }
        }

        @media (max-width: 480px) {

            .forgot-password-left,
            .forgot-password-right {
                padding: 1.5rem;
            }

            .welcome-text h1 {
                font-size: 1.8rem;
            }

            .forgot-password-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="forgot-password-container">
        <!-- Left Side: Branding and Information -->
        <div class="forgot-password-left">
            <div class="logo">
                <div class="logo-icon">
                    <span style="color: #db9123; font-weight: bold; font-size: 1.2rem;">
                        <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans Logo" />
                    </span>
                </div>
                <div class="logo-text">
                    <span class="logo-londa">Londa</span>
                    <span class="logo-loans">Loans</span>
                </div>
            </div>
            <div class="welcome-text">
                <h1>Reset Your Password</h1>
                <p>Follow these simple steps to regain access to your account.</p>
            </div>
            <ul class="steps">
                <li>
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Enter Your Email</h3>
                        <p>Provide the email address associated with your Londa Loans account.</p>
                    </div>
                </li>
                <li>
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Check Your Inbox</h3>
                        <p>We'll send a password reset link to your email address.</p>
                    </div>
                </li>
                <li>
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Create New Password</h3>
                        <p>Follow the link in the email to set up your new password.</p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Right Side: Forgot Password Form -->
        <div class="forgot-password-right">
            <div class="back-to-login">
                <a href="{{ route('management.login') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>
            </div>

            <div class="forgot-password-header">
                <h2>Forgot Your Password?</h2>
                <p>Enter your email address and we'll send you a link to reset your password.</p>
            </div>

            <!-- Laravel Session Messages -->
            @if (session('status'))
                <div class="success-state" id="successState" style="display: block;">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h3>Check Your Email</h3>
                    <p>
                        We've sent a password reset link to <strong>{{ session('email') ?? 'your email' }}</strong>. The
                        link will expire in 30 minutes.
                    </p>
                    <button class="reset-button" onclick="window.location.href='{{ route('management.login') }}'">
                        <i class="fas fa-sign-in-alt"></i>
                        Return to Login
                    </button>
                    <div class="contact-support">
                        <p>
                            Didn't receive the email? <a href="#" id="resendLink">Resend</a> or <a
                                href="/contact">Contact Support</a>
                        </p>
                    </div>
                </div>
            @else
                <!-- Initial Form State -->
                <form class="forgot-password-form" id="forgotPasswordForm"
                    action="{{ route('management.password.email') }}" method="POST">
                    @csrf

                    <!-- Laravel Validation Errors -->
                    @if ($errors->any())
                        <div class="error-message" style="display: block; margin-bottom: 1rem;">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email"
                                class="form-input @error('email') shake @enderror"
                                placeholder="Enter your email address" value="{{ old('email') }}" required />
                        </div>
                        <div class="error-message" id="emailError">Please enter a valid email address</div>
                        @error('email')
                            <div class="error-message" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="reset-button" id="resetButton">
                        <i class="fas fa-paper-plane"></i>
                        Send Reset Link
                    </button>

                    <div class="divider">
                        <span>Need help?</span>
                    </div>

                    <div class="contact-support">
                        <p>
                            Can't access your email? <a href="/contact">Contact Support</a>
                        </p>
                    </div>
                </form>

                <!-- Success State (Hidden by default) -->
                <div class="success-state" id="successState">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h3>Check Your Email</h3>
                    <p>
                        We've sent a password reset link to <strong id="userEmail"></strong>. The link will expire in 30
                        minutes.
                    </p>
                    <button class="reset-button" onclick="window.location.href='{{ route('management.login') }}'">
                        <i class="fas fa-sign-in-alt"></i>
                        Return to Login
                    </button>
                    <div class="contact-support">
                        <p>
                            Didn't receive the email? <a href="#" id="resendLink">Resend</a> or <a
                                href="/contact">Contact Support</a>
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forgotPasswordForm = document.getElementById('forgotPasswordForm')
            const successState = document.getElementById('successState')
            const emailInput = document.getElementById('email')
            const resetButton = document.getElementById('resetButton')
            const emailError = document.getElementById('emailError')
            const userEmail = document.getElementById('userEmail')
            const resendLink = document.getElementById('resendLink')

            // Only run if form exists (not in success state)
            if (forgotPasswordForm) {
                // Form validation and submission
                forgotPasswordForm.addEventListener('submit', function(event) {
                    let isValid = true

                    // Reset error message
                    emailError.style.display = 'none'
                    emailInput.classList.remove('shake')

                    // Validate email
                    if (!validateEmail(emailInput.value.trim())) {
                        emailError.style.display = 'block'
                        emailInput.classList.add('shake')
                        isValid = false
                    }

                    if (isValid) {
                        // Show loading state
                        resetButton.disabled = true
                        resetButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...'
                    } else {
                        event.preventDefault()
                    }
                })

                // Real-time validation
                emailInput.addEventListener('input', function() {
                    if (validateEmail(this.value.trim())) {
                        emailError.style.display = 'none'
                        this.classList.remove('shake')
                    }
                })
            }

            // Resend link functionality
            if (resendLink) {
                resendLink.addEventListener('click', function(event) {
                    event.preventDefault()

                    // Show loading state
                    const originalText = this.textContent
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Resending...'
                    this.style.pointerEvents = 'none'

                    // Simulate API call
                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-check"></i> Sent!'

                        // Reset after 2 seconds
                        setTimeout(() => {
                            this.textContent = originalText
                            this.style.pointerEvents = 'auto'
                        }, 2000)
                    }, 1500)
                })
            }

            // Email validation function
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
                return re.test(String(email).toLowerCase())
            }

            // Demo functionality to show how it works
            console.log('Forgot Password Page Loaded')
            console.log('This page allows users to request a password reset link via email.')
        })
    </script>
</body>

</html>
