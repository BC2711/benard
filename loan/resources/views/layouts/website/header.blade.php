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
  }
  
  .logo-image {
    height: 60px;
    width: 40px;
    margin-right: 0.5rem;
    object-fit: contain;
  }
  
  .logo-text {
    display: flex;
    flex-direction: column;
  }
  
  .logo-main {
    display: flex;
    align-items: center;
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
  }
  
  .hamburger-line {
    display: block;
    width: 100%;
    height: 2px;
    background-color: #7a4603;
    transition: all 0.3s ease;
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
  }
  
  .nav-link:hover {
    color: #db9123;
  }
  
  /* Dropdown */
  .dropdown-container {
    position: relative;
  }
  
  .dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 0.25rem;
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
    min-width: 180px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
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

<header id="header">
  <div class="header-container">
    <!-- Logo Section -->
    <a href="index.html" class="logo" aria-label="Londa Loans Homepage">
      <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans Logo" class="logo-image" />
      <div class="logo-text">
         <span class="logo-tagline"> Ma Loans Yama Londa!</span>
        <div class="logo-main">
          <span class="logo-londa">Londa</span>
          <span class="logo-loans">Loans</span>
        </div>
        <span class="logo-tagline">empowering marketeers</span>
      </div>
    </a>

    <!-- Hamburger Toggle Button -->
    <button class="hamburger" id="hamburger" aria-label="Toggle navigation" aria-expanded="false">
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
    </button>

    <!-- Navigation and Actions -->
    <div class="nav-menu" id="nav-menu">
      <nav aria-label="Main navigation">
        <ul class="nav-list">
          <li>
            <a href="index.html" class="nav-link">Home</a>
          </li>
          <li>
            <a href="index.html#features" class="nav-link">About</a>
          </li>
          <li>
            <a href="index.html#features" class="nav-link">Services</a>
          </li>
          <li class="dropdown-container">
            <a href="#!" class="nav-link dropdown-toggle" id="dropdownToggle" aria-haspopup="true" aria-expanded="false">
              Loans<svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
              </svg>
            </a>
            <ul class="dropdown" id="dropdownMenu" aria-labelledby="dropdownToggle">
              <li>
                <a href="blog-grid.html" class="dropdown-link">Marketeer Loans</a>
              </li>
              <li>
                <a href="blog-single.html" class="dropdown-link">Business Loans</a>
              </li>
              <li>
                <a href="signin.html" class="dropdown-link">Personal Loans</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="index.html#support" class="nav-link">Contact</a>
          </li>
        </ul>
      </nav>

      <!-- Actions -->
      <div class="header-actions">
        <label class="theme-toggle" aria-label="Toggle dark mode">
          <input type="checkbox" id="darkModeToggle" style="display: none;" />
          <svg class="theme-icon" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.0908 18.6363C10.3549 18.6363 8.69 17.9467 7.46249 16.7192C6.23497 15.4916 5.54537 13.8268 5.54537 12.0908C5.54537 10.3549 6.23497 8.69 7.46249 7.46249C8.69 6.23497 10.3549 5.54537 12.0908 5.54537C13.8268 5.54537 15.4916 6.23497 16.7192 7.46249C17.9467 8.69 18.6363 10.3549 18.6363 12.0908C18.6363 13.8268 17.9467 15.4916 16.7192 16.7192C15.4916 17.9467 13.8268 18.6363 12.0908 18.6363ZM12.0908 16.4545C13.2481 16.4545 14.358 15.9947 15.1764 15.1764C15.9947 14.358 16.4545 13.2481 16.4545 12.0908C16.4545 10.9335 15.9947 9.8236 15.1764 9.00526C14.358 8.18692 13.2481 7.72718 12.0908 7.72718C10.9335 7.72718 9.8236 8.18692 9.00526 9.00526C8.18692 9.8236 7.72718 10.9335 7.72718 12.0908C7.72718 13.2481 8.18692 14.358 9.00526 15.1764C9.8236 15.9947 10.9335 16.4545 12.0908 16.4545ZM10.9999 0.0908203H13.1817V3.36355H10.9999V0.0908203ZM10.9999 20.8181H13.1817V24.0908H10.9999V20.8181ZM2.83446 4.377L4.377 2.83446L6.69082 5.14828L5.14828 6.69082L2.83446 4.37809V4.377ZM17.4908 19.0334L19.0334 17.4908L21.3472 19.8046L19.8046 21.3472L17.4908 19.0334ZM19.8046 2.83337L21.3472 4.377L19.0334 6.69082L17.4908 5.14828L19.8046 2.83446V2.83337ZM5.14828 17.4908L6.69082 19.0334L4.377 21.3472L2.83446 19.8046L5.14828 17.4908ZM24.0908 10.9999V13.1817H20.8181V10.9999H24.0908ZM3.36355 10.9999V13.1817H0.0908203V10.9999H3.36355Z" />
          </svg>
        </label>
        <a href="signin.html" class="sign-in">Sign In</a>
        <a href="signup.html" class="sign-up">Sign Up</a>
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
    e.preventDefault()
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
      if (e.target.classList.contains('nav-link') && !e.target.classList.contains('dropdown-toggle')) {
        navMenu.classList.remove('open')
        hamburger.classList.remove('open')
        hamburger.setAttribute('aria-expanded', 'false')
        closeDropdown()
      }
    }
  })
  
  // Dark Mode Toggle (placeholder)
  const darkModeToggle = document.getElementById('darkModeToggle')
  darkModeToggle.addEventListener('change', () => {
    document.body.classList.toggle('dark-mode')
    // Implement dark mode logic here
  })
  
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
</script>
