<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Londa Loans - Login</title>

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

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: fadeIn 0.8s ease-out;
        }

        .login-left {
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

        .login-left::before {
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

        .features {
            list-style: none;
            margin-top: 2rem;
        }

        .features li {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .feature-icon i {
            font-size: 0.8rem;
        }

        .login-right {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            color: var(--secondary-color);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: var(--text-light);
        }

        .login-form {
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

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 0.5rem;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-button {
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
        }

        .login-button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .login-button:disabled {
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

        .social-login {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .social-button {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .social-button:hover {
            background-color: var(--light-bg);
        }

        .social-button.google {
            color: #db4437;
        }

        .social-button.linkedin {
            color: #0077b5;
        }

        .register-link {
            text-align: center;
            color: var(--text-light);
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .register-link a:hover {
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

        .attempts-warning {
            background-color: rgba(243, 156, 18, 0.1);
            border: 1px solid var(--warning-color);
            color: var(--warning-color);
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            text-align: center;
        }

        .account-locked {
            background-color: rgba(231, 76, 60, 0.1);
            border: 1px solid var(--error-color);
            color: var(--error-color);
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            text-align: center;
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
            .login-container {
                flex-direction: column;
                max-width: 450px;
            }

            .login-left {
                padding: 2rem;
            }

            .login-right {
                padding: 2rem;
            }

            .social-login {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {

            .login-left,
            .login-right {
                padding: 1.5rem;
            }

            .welcome-text h1 {
                font-size: 1.8rem;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
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

        .alert-info {
            color: #3498db;
            background-color: rgba(52, 152, 219, 0.1);
            border-color: #3498db;
        }

        .alert-warning {
            color: #f39c12;
            background-color: rgba(243, 156, 18, 0.1);
            border-color: #f39c12;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Side: Branding and Information -->
        <div class="login-left">
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
                <h1>Welcome Back</h1>
                <p>Access your Londa Loans account to manage your finances and grow your business.</p>
            </div>
            <ul class="features">
                <li>
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <span>Secure & Encrypted Login</span>
                </li>
                <li>
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <span>Fast Application Processing</span>
                </li>
                <li>
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <span>24/7 Customer Support</span>
                </li>
            </ul>
        </div>

        <!-- Right Side: Login Form -->
        <div class="login-right">
            <div class="login-header">
                <h2>Login to Your Account</h2>
                <p>Enter your credentials to access your dashboard</p>
            </div>

            <!-- Security Warnings -->
            @if (session('attempts_warning'))
                <div class="attempts-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ session('attempts_warning') }}
                </div>
            @endif

            @if (session('account_locked'))
                <div class="account-locked">
                    <i class="fas fa-lock"></i>
                    {{ session('account_locked') }}
                </div>
            @endif

            <!-- Laravel Session Messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    {{ session('info') }}
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

            <form class="login-form" id="loginForm" action="{{ route('management.login') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email"
                            class="form-input @error('email') shake @enderror" placeholder="Enter your email"
                            value="{{ old('email') }}" required @if (session('account_locked')) disabled @endif />
                    </div>
                    <div class="error-message" id="emailError">Please enter a valid email address</div>
                    @error('email')
                        <div class="error-message" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password"
                            class="form-input @error('password') shake @enderror" placeholder="Enter your password"
                            required @if (session('account_locked')) disabled @endif />
                        <button type="button" class="password-toggle" id="passwordToggle"
                            @if (session('account_locked')) disabled @endif>
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="passwordError">Password must be at least 6 characters</div>
                    @error('password')
                        <div class="error-message" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}
                            @if (session('account_locked')) disabled @endif />
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="{{ route('management.password.request') }}" class="forgot-password"
                        @if (session('account_locked')) style="pointer-events: none; opacity: 0.5;" @endif>
                        Forgot Password?
                    </a>
                </div>

                <button type="submit" class="login-button" id="loginButton"
                    @if (session('account_locked')) disabled @endif>
                    <i class="fas fa-sign-in-alt"></i>
                    <span id="loginButtonText">
                        @if (session('account_locked'))
                            Account Locked
                        @else
                            Login to Account
                        @endif
                    </span>
                </button>

                <div class="divider">
                    <span>Or continue with</span>
                </div>

                <div class="social-login">
                    <button type="button" class="social-button google"
                        @if (session('account_locked')) disabled @endif>
                        <i class="fab fa-google"></i>
                        <span>Google</span>
                    </button>
                    <button type="button" class="social-button linkedin"
                        @if (session('account_locked')) disabled @endif>
                        <i class="fab fa-linkedin"></i>
                        <span>LinkedIn</span>
                    </button>
                </div>

                <div class="register-link">
                    Don't have an account?
                    <a href="{{ route('management.register') }}"
                        @if (session('account_locked')) style="pointer-events: none; opacity: 0.5;" @endif>
                        Register here
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm')
            const emailInput = document.getElementById('email')
            const passwordInput = document.getElementById('password')
            const passwordToggle = document.getElementById('passwordToggle')
            const loginButton = document.getElementById('loginButton')
            const loginButtonText = document.getElementById('loginButtonText')
            const emailError = document.getElementById('emailError')
            const passwordError = document.getElementById('passwordError')

            // Check if account is locked
            const isAccountLocked = {{ session('account_locked') ? 'true' : 'false' }};

            // Toggle password visibility
            passwordToggle.addEventListener('click', function() {
                if (isAccountLocked) return;

                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password'
                passwordInput.setAttribute('type', type)
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' :
                    '<i class="fas fa-eye-slash"></i>'
            })

            // Form validation
            loginForm.addEventListener('submit', function(event) {
                if (isAccountLocked) {
                    event.preventDefault();
                    return;
                }

                let isValid = true

                // Reset error messages
                emailError.style.display = 'none'
                passwordError.style.display = 'none'
                emailInput.classList.remove('shake')
                passwordInput.classList.remove('shake')

                // Validate email
                if (!validateEmail(emailInput.value.trim())) {
                    emailError.style.display = 'block'
                    emailInput.classList.add('shake')
                    isValid = false
                }

                // Validate password
                if (passwordInput.value.length < 6) {
                    passwordError.style.display = 'block'
                    passwordInput.classList.add('shake')
                    isValid = false
                }

                if (!isValid) {
                    event.preventDefault()
                } else {
                    // Show loading state
                    loginButton.disabled = true
                    loginButtonText.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...'
                }
            })

            // Real-time validation
            emailInput.addEventListener('input', function() {
                if (isAccountLocked) return;

                if (validateEmail(this.value.trim())) {
                    emailError.style.display = 'none'
                    this.classList.remove('shake')
                }
            })

            passwordInput.addEventListener('input', function() {
                if (isAccountLocked) return;

                if (this.value.length >= 6) {
                    passwordError.style.display = 'none'
                    this.classList.remove('shake')
                }
            })

            // Email validation function
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
                return re.test(String(email).toLowerCase())
            }

            // Social login buttons (demo functionality)
            document.querySelectorAll('.social-button').forEach((button) => {
                button.addEventListener('click', function() {
                    if (isAccountLocked) return;

                    const platform = this.classList.contains('google') ? 'Google' : 'LinkedIn'
                    alert(
                        `In a real application, this would redirect to ${platform} authentication`
                    )
                })
            })

            // Auto-focus email field if not locked
            if (!isAccountLocked && emailInput.value === '') {
                emailInput.focus();
            }
        })
    </script>
</body>

</html>
