  <header class="bg-white shadow-sm z-10">
      <div class="flex items-center justify-between px-6 py-4">
          <!-- Left Section: Menu Toggle & Search -->
          <div class="flex items-center space-x-4">
              <button id="sidebarToggle" class="text-gray-500 hover:text-londa-orange focus:outline-none">
                  <i class="fas fa-bars text-xl"></i>
              </button>

              <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <i class="fas fa-search text-gray-400"></i>
                  </div>
                  <input type="text"
                      class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-londa-orange focus:border-londa-orange w-64"
                      placeholder="Search...">
              </div>
          </div>

          <!-- Right Section: Notifications & User Menu -->
          <div class="flex items-center space-x-4">
              <!-- Notifications -->
              <div class="relative">
                  <button class="text-gray-500 hover:text-londa-orange focus:outline-none relative">
                      <i class="fas fa-bell text-xl"></i>
                      <span
                          class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                  </button>
              </div>

              <!-- Messages -->
              <div class="relative">
                  <button class="text-gray-500 hover:text-londa-orange focus:outline-none relative">
                      <i class="fas fa-envelope text-xl"></i>
                      <span
                          class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">5</span>
                  </button>
              </div>

              <!-- User Menu -->
              <div class="relative" x-data="{ open: false }">
                  <button @click="open = !open"
                      class="flex items-center space-x-2 text-gray-700 hover:text-londa-orange focus:outline-none">
                      <img class="w-8 h-8 rounded-full"
                          src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                          alt="User">
                      <span class="font-medium">John</span>
                      <i class="fas fa-chevron-down text-xs"></i>
                  </button>

                  <!-- Dropdown Menu -->
                  <div x-show="open" @click.away="open = false"
                      class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-20">
                      <a href="#"
                          class="block px-4 py-2 text-sm text-gray-700 hover:bg-londa-light hover:text-londa-orange">
                          <i class="fas fa-user mr-2"></i>Profile
                      </a>
                      <a href="#"
                          class="block px-4 py-2 text-sm text-gray-700 hover:bg-londa-light hover:text-londa-orange">
                          <i class="fas fa-cog mr-2"></i>Settings
                      </a>
                      <a href="#"
                          class="block px-4 py-2 text-sm text-gray-700 hover:bg-londa-light hover:text-londa-orange">
                          <i class="fas fa-question-circle mr-2"></i>Help
                      </a>
                      <div class="border-t border-gray-100"></div>
                      <form action="{{ route('management.logout') }}" method="post">
                          @csrf
                          <button type="submit" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                              <i class="fas fa-sign-out-alt mr-2"></i>Sign out
                          </button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </header>
