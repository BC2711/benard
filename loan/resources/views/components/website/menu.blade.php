  <!-- Header -->
  <header id="header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" role="banner">
      <div class="glass-menu-effect shadow-sm">
          <div class="container mx-auto px-4 lg:px-8">
              <div class="flex items-center justify-between h-20">
                  <!-- Logo Section -->
                  <a href="index.html" class="flex items-center space-x-3 group" aria-label="Londa Loans Homepage">
                      <div class="relative">
                          <div
                              class="w-12 h-12 bg-gradient-to-br from-primary-primary to-secondary-secondary rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                              <span class="text-white font-bold text-lg">LL</span>
                          </div>
                          <div
                              class="absolute -inset-1 bg-gradient-to-r from-primary-primary to-secondary-secondary rounded-2xl blur opacity-30 group-hover:opacity-50 transition-opacity duration-300">
                          </div>
                      </div>
                      <div class="flex flex-col">
                          <div class="flex items-baseline space-x-1">
                              <span class="text-2xl font-black text-primary-primary">Londa</span>
                              <span class="text-2xl font-black text-secondary-secondary">Loans</span>
                          </div>
                          <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-2 text-xs">
                              <span class="text-secondary-secondary font-semibold">Ma Loans Yama Londa!</span>
                              <span class="text-primary-primary/70 hidden lg:block">•</span>
                              <span class="text-primary-primary/70">empowering marketeers</span>
                          </div>
                      </div>
                  </a>

                  <!-- Desktop Navigation -->
                  <nav class="hidden lg:flex items-center space-x-8" role="navigation" aria-label="Main navigation">
                      <a href="/"
                          class="nav-link-hover text-primary-primary font-semibold text-lg relative group">
                          Home
                          <span
                              class="absolute -bottom-1 left-0 w-full h-0.5 bg-gradient-to-r from-secondary-secondary to-accent-accent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                      </a>
                      <a href="/#about"
                          class="nav-link-hover text-gray-600 hover:text-primary-primary font-medium text-lg transition-colors duration-300">
                          About
                      </a>
                      <a href="/#features"
                          class="nav-link-hover text-gray-600 hover:text-primary-primary font-medium text-lg transition-colors duration-300">
                          Features
                      </a>
                      <a href="/#services"
                          class="nav-link-hover text-gray-600 hover:text-primary-primary font-medium text-lg transition-colors duration-300">
                          Services
                      </a>
                      <a href="/#support"
                          class="nav-link-hover text-gray-600 hover:text-primary-primary font-medium text-lg transition-colors duration-300">
                          Contact
                      </a>
                  </nav>

                  <!-- Desktop Actions -->
                  <div class="hidden lg:flex items-center space-x-4">
                      <a href="{{ route('management.login') }}"
                          class="bg-primary-primary from-secondary-secondary to-accent-accent text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-0.5 flex items-center space-x-2">
                          <i class="fas fa-sign-in-alt"></i>
                          <span>Sign In</span>
                      </a>
                  </div>

                  <!-- Mobile Menu Button -->
                  <button id="mobile-menu-button"
                      class="lg:hidden w-10 h-10 flex flex-col items-center justify-center space-y-1.5 relative group"
                      aria-label="Toggle navigation" aria-expanded="false">
                      <span
                          class="w-6 h-0.5 bg-primary-primary transform transition-all duration-300 group-aria-expanded:translate-y-2 group-aria-expanded:rotate-45"></span>
                      <span
                          class="w-6 h-0.5 bg-primary-primary transition-all duration-300 group-aria-expanded:opacity-0"></span>
                      <span
                          class="w-6 h-0.5 bg-primary-primary transform transition-all duration-300 group-aria-expanded:-translate-y-2 group-aria-expanded:-rotate-45"></span>
                  </button>
              </div>
          </div>

          <!-- Mobile Navigation Menu -->
          <div id="mobile-menu"
              class="lg:hidden bg-white/95 backdrop-blur-lg border-t border-gray-200 shadow-xl transform origin-top transition-all duration-300 scale-y-0 opacity-0 absolute top-full left-0 right-0"
              role="navigation" aria-label="Mobile navigation">
              <div class="container mx-auto px-4 py-6">
                  <nav class="flex flex-col space-y-4">
                      <a href="/"
                          class="flex items-center space-x-3 p-3 rounded-xl bg-gradient-to-r from-primary-primary/5 to-secondary-secondary/5 text-primary-primary font-semibold text-lg border-l-4 border-secondary-secondary">
                          <i class="fas fa-home text-secondary-secondary w-5"></i>
                          <span>Home</span>
                      </a>
                      <a href="/#about"
                          class="flex items-center space-x-3 p-3 rounded-xl text-gray-600 hover:text-primary-primary font-medium text-lg transition-colors duration-300 hover:bg-gray-50">
                          <i class="fas fa-info-circle text-gray-400 w-5"></i>
                          <span>About</span>
                      </a>
                      <a href="/#features"
                          class="flex items-center space-x-3 p-3 rounded-xl text-gray-600 hover:text-primary-primary font-medium text-lg transition-colors duration-300 hover:bg-gray-50">
                          <i class="fas fa-star text-gray-400 w-5"></i>
                          <span>Features</span>
                      </a>
                      <a href="/#services"
                          class="flex items-center space-x-3 p-3 rounded-xl text-gray-600 hover:text-primary-primary font-medium text-lg transition-colors duration-300 hover:bg-gray-50">
                          <i class="fas fa-hand-holding-usd text-gray-400 w-5"></i>
                          <span>Services</span>
                      </a>
                      <a href="/#support"
                          class="flex items-center space-x-3 p-3 rounded-xl text-gray-600 hover:text-primary-primary font-medium text-lg transition-colors duration-300 hover:bg-gray-50">
                          <i class="fas fa-envelope text-gray-400 w-5"></i>
                          <span>Contact</span>
                      </a>
                  </nav>

                  <!-- Mobile Actions -->
                  <div class="mt-6 pt-6 border-t border-gray-200">
                      <a href="{{ route('management.login') }}"
                          class="w-full bg-gradient-to-r from-secondary-secondary to-accent-accent text-white py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                          <i class="fas fa-sign-in-alt"></i>
                          <span>Sign In</span>
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </header>
