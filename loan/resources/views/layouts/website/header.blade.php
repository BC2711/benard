<style>
    /* Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    #header {
        background-color: white;
        position: sticky;
        top: 0;
        z-index: 50;
        transition: background-color 0.3s, box-shadow 0.3s;
        width: 100%;
    }

    .header-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Logo Styles */
    .logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        gap: 0.5rem;
    }

    .logo-image {
        height: 60px;
        width: 40px;
        object-fit: contain;
    }

    .logo-text {
        display: flex;
        flex-direction: column;
    }

    .logo-main {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .logo-londa {
        font-size: 1.5rem;
        font-weight: bold;
        color: #7a4603;
    }

    .logo-loans {
        font-size: 1.5rem;
        font-weight: bold;
        color: #db9123;
    }

    .logo-tagline {
        font-size: 0.85rem;
        color: #7a4603;
        opacity: 0.8;
        line-height: 1.2;
    }

    .logo-tagline:first-child {
        font-weight: 600;
        color: #db9123;
    }

    /* Hamburger Button */
    .hamburger {
        background: none;
        border: none;
        cursor: pointer;
        display: none;
        flex-direction: column;
        justify-content: space-between;
        width: 24px;
        height: 18px;
        padding: 0;
        z-index: 60;
    }

    .hamburger-line {
        display: block;
        width: 100%;
        height: 2px;
        background-color: #7a4603;
        transition: all 0.3s ease;
        transform-origin: center;
    }

    /* Navigation */
    .nav-menu {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .nav-list {
        display: flex;
        gap: 2rem;
        list-style: none;
    }

    .nav-link {
        font-size: 1rem;
        color: #7a4603;
        text-decoration: none;
        transition: color 0.3s;
        font-weight: 500;
        position: relative;
        padding: 0.5rem 0;
    }

    .nav-link:hover {
        color: #db9123;
    }

    .nav-link.active {
        color: #db9123;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #db9123;
    }

    /* Dropdown */
    .dropdown-container {
        position: relative;
    }

    .dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        cursor: pointer;
    }

    .dropdown-icon {
        width: 16px;
        height: 16px;
        fill: #7a4603;
        transition: transform 0.3s;
    }

    .dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        background-color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 6px;
        list-style: none;
        padding: 0.5rem 0;
        min-width: 200px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 40;
    }

    .dropdown.open {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-link {
        font-size: 0.9rem;
        color: #7a4603;
        text-decoration: none;
        display: block;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }

    .dropdown-link:hover {
        background-color: #f8f5f0;
        color: #db9123;
        padding-left: 2rem;
    }

    /* Actions */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .theme-toggle {
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .theme-toggle:hover {
        background-color: #f5f5f5;
    }

    .theme-icon {
        width: 20px;
        height: 20px;
        fill: #7a4603;
    }

    .sign-in {
        font-size: 1rem;
        color: #7a4603;
        text-decoration: none;
        transition: color 0.3s;
        font-weight: 500;
    }

    .sign-in:hover {
        color: #db9123;
    }

    .sign-up {
        font-size: 1rem;
        color: white;
        background-color: #db9123;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        border: none;
        cursor: pointer;
        display: inline-block;
        text-align: center;
    }

    .sign-up:hover {
        background-color: #b3741c;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(219, 145, 35, 0.3);
    }

    /* Sticky Header */
    #header.sticky {
        background-color: rgba(255, 255, 255, 0.98);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
    }

    /* Mobile Styles */
    @media (max-width: 1024px) {
        .header-container {
            padding: 0.875rem;
        }

        .logo-image {
            height: 50px;
            width: 33px;
        }

        .logo-londa,
        .logo-loans {
            font-size: 1.25rem;
        }

        .logo-tagline {
            font-size: 0.75rem;
        }

        .nav-list {
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .hamburger {
            display: flex;
        }

        .nav-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: white;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            flex-direction: column;
            align-items: stretch;
            gap: 2rem;
            animation: slideIn 0.3s ease-out;
            z-index: 45;
        }

        .nav-menu.open {
            display: flex;
        }

        .nav-list {
            flex-direction: column;
            gap: 1.5rem;
        }

        .dropdown-container {
            position: static;
        }

        .dropdown {
            position: static;
            box-shadow: none;
            background-color: #f8f5f0;
            margin-top: 0.5rem;
            border-radius: 4px;
            opacity: 1;
            visibility: visible;
            transform: none;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .dropdown.open {
            max-height: 300px;
        }

        .dropdown-link {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e5e5;
        }

        .dropdown-link:last-child {
            border-bottom: none;
        }

        .header-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e5e5;
        }

        .theme-toggle {
            justify-content: center;
            padding: 1rem;
        }

        .sign-in,
        .sign-up {
            text-align: center;
            padding: 1rem;
        }

        .sign-up {
            order: -1;
        }
    }

    @media (max-width: 480px) {
        .header-container {
            padding: 0.75rem;
        }

        .logo-image {
            height: 40px;
            width: 27px;
        }

        .logo-londa,
        .logo-loans {
            font-size: 1.1rem;
        }

        .logo-tagline {
            font-size: 0.7rem;
        }

        .nav-menu {
            padding: 1.5rem;
        }

        .nav-link {
            font-size: 0.95rem;
        }

        .dropdown-link {
            font-size: 0.85rem;
            padding: 0.875rem 1.25rem;
        }
    }

    /* Animations */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Hamburger Animation */
    .hamburger.open .hamburger-line:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
    }

    .hamburger.open .hamburger-line:nth-child(2) {
        opacity: 0;
    }

    .hamburger.open .hamburger-line:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
    }

    /* Dropdown Icon Animation */
    .dropdown-toggle.open .dropdown-icon {
        transform: rotate(180deg);
    }
</style>

<header id="header" role="banner">
    <div class="header-container">
        <!-- Logo Section -->
        <a href="index.html" class="logo" aria-label="Londa Loans Homepage">
            <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans Logo" class="logo-image" loading="lazy" />
            <div class="logo-text">
                <div class="logo-main">
                    <span class="logo-londa">Londa</span>
                    <span class="logo-loans">Loans</span>
                </div>
                <span class="logo-tagline">Ma Loans Yama Londa!</span>
                <span class="logo-tagline">empowering marketeers</span>
            </div>
        </a>

        <!-- Hamburger Toggle Button -->
        <button class="hamburger" id="hamburger" aria-label="Toggle navigation" aria-expanded="false"
            aria-controls="nav-menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        <!-- Navigation and Actions -->
        <div class="nav-menu" id="nav-menu" role="navigation" aria-label="Main navigation">
            <nav>
                <ul class="nav-list">
                    <li>
                        <a href="/" class="nav-link active" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="/#about" class="nav-link">About</a>
                    </li>
                    <li>
                        <a href="/#features" class="nav-link">Features</a>
                    </li>
                    <li>
                        <a href="/#services" class="nav-link">Services</a>
                    </li>
                    {{-- <li class="dropdown-container">
                        <button class="nav-link dropdown-toggle" id="dropdownToggle" aria-haspopup="true"
                            aria-expanded="false">
                            Loans
                            <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                aria-hidden="true">
                                <path
                                    d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                            </svg>
                        </button>
                        <ul class="dropdown" id="dropdownMenu" aria-labelledby="dropdownToggle" role="menu">
                            <li role="none">
                                <a href="blog-grid.html" class="dropdown-link" role="menuitem">Marketeer Loans</a>
                            </li>
                            <li role="none">
                                <a href="blog-single.html" class="dropdown-link" role="menuitem">Business Loans</a>
                            </li>
                            <li role="none">
                                <a href="signin.html" class="dropdown-link" role="menuitem">Personal Loans</a>
                            </li>
                        </ul>
                    </li> --}}
                    <li>
                        <a href="/#support" class="nav-link">Contact</a>
                    </li>
                </ul>
            </nav>

            <!-- Actions -->
            <div class="header-actions">
                <a href="{{ route('management.login') }}" class="sign-up" aria-label="Sign in to your account">Sign
                    In</a>
            </div>
        </div>
    </div>
</header>

<script>
    // Sticky Header
    window.addEventListener('scroll', () => {
        const header = document.getElementById('header')
        header.classList.toggle('sticky', window.scrollY > 20)
    })

    // Hamburger Menu Toggle
    const hamburger = document.getElementById('hamburger')
    const navMenu = document.getElementById('nav-menu')

    hamburger.addEventListener('click', () => {
        const isOpen = navMenu.classList.toggle('open')
        hamburger.classList.toggle('open', isOpen)
        hamburger.setAttribute('aria-expanded', isOpen)

        // Close dropdown when hamburger is toggled
        if (!isOpen) {
            closeDropdown()
        }
    })

    // Dropdown Toggle
    const dropdownToggle = document.getElementById('dropdownToggle')
    const dropdownMenu = document.getElementById('dropdownMenu')

    dropdownToggle.addEventListener('click', (e) => {
        e.stopPropagation()
        const isOpen = dropdownMenu.classList.toggle('open')
        dropdownToggle.classList.toggle('open', isOpen)
        dropdownToggle.setAttribute('aria-expanded', isOpen)
    })

    // Close dropdown function
    function closeDropdown() {
        dropdownMenu.classList.remove('open')
        dropdownToggle.classList.remove('open')
        dropdownToggle.setAttribute('aria-expanded', 'false')
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
            closeDropdown()
        }
    })

    // Close mobile menu when clicking on a link (except dropdown toggle)
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768 && navMenu.classList.contains('open')) {
            if ((e.target.classList.contains('nav-link') && !e.target.classList.contains('dropdown-toggle')) ||
                e.target.getAttribute('role') === 'menuitem') {
                navMenu.classList.remove('open')
                hamburger.classList.remove('open')
                hamburger.setAttribute('aria-expanded', 'false')
                closeDropdown()
            }
        }
    })

    // Set active navigation link based on current page
    document.addEventListener('DOMContentLoaded', () => {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link:not(.dropdown-toggle)');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath ||
                (currentPath === '/' && link.getAttribute('href') === '/') ||
                (currentPath !== '/' && link.getAttribute('href').includes(currentPath))) {
                link.classList.add('active');
                link.setAttribute('aria-current', 'page');
            } else {
                link.classList.remove('active');
                link.removeAttribute('aria-current');
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            // Reset mobile menu state on desktop
            navMenu.classList.remove('open')
            hamburger.classList.remove('open')
            hamburger.setAttribute('aria-expanded', 'false')
            closeDropdown()
        }
    })

    // Handle escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (navMenu.classList.contains('open')) {
                navMenu.classList.remove('open')
                hamburger.classList.remove('open')
                hamburger.setAttribute('aria-expanded', 'false')
            }
            closeDropdown()
        }
    })

    // Improve touch experience for mobile
    document.addEventListener('touchstart', (e) => {
        if (window.innerWidth <= 768 &&
            !navMenu.contains(e.target) &&
            !hamburger.contains(e.target) &&
            navMenu.classList.contains('open')) {
            navMenu.classList.remove('open')
            hamburger.classList.remove('open')
            hamburger.setAttribute('aria-expanded', 'false')
            closeDropdown()
        }
    })
</script>
