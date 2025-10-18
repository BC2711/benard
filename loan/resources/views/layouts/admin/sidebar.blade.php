 <div id="sidebar" class="sidebar-transition bg-white w-64 shadow-lg flex flex-col">
     <!-- Logo Section -->
     <div class="px-6 py-4 border-b border-gray-200">
         <div class="flex items-center space-x-3">
             <div class="w-10 h-10 bg-londa-orange rounded-lg flex items-center justify-center">
                 <span class="text-white font-bold text-lg"> <img src="{{ asset('assets/logos/londa.jpg') }}"
                         alt=""> </span>
             </div>
             <div>
                 <h1 class="text-xl font-bold text-londa-brown">Londa<span class="text-green-800">Loans</span></h1>
                 <p class="text-xs text-gray-500">Ma Loans Yama Londa!</p>
             </div>
         </div>
     </div>

     <!-- Navigation Menu -->
     <div class="flex-1 overflow-y-auto py-4">
         <nav class="px-4 space-y-2">
             <!-- Dashboard -->
             {{-- <a href="#"
                 class="nav-item active flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                 <i class="fas fa-tachometer-alt w-6 text-center"></i>
                 <span class="ml-3 font-medium">Dashboard</span>
             </a> --}}

             <!-- Loan Management -->
             {{-- <div class="mt-6">
                 <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Loan Management
                 </h3>
                 <div class="mt-2 space-y-1">
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice-dollar w-6 text-center"></i>
                         <span class="ml-3 font-medium">All Loans</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-plus-circle w-6 text-center"></i>
                         <span class="ml-3 font-medium">New Applications</span>
                         <span
                             class="ml-auto bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full">12</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-check-circle w-6 text-center"></i>
                         <span class="ml-3 font-medium">Approved Loans</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-clock w-6 text-center"></i>
                         <span class="ml-3 font-medium">Pending Review</span>
                         <span
                             class="ml-auto bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">8</span>
                     </a>
                 </div>
             </div> --}}

             <!-- Customer Management -->
             {!! $menu_html !!}

             <!-- Financial Management -->
             {{-- <div class="mt-6">
                 <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Financial
                     Management</h3>
                 <div class="mt-2 space-y-1">
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-chart-line w-6 text-center"></i>
                         <span class="ml-3 font-medium">Analytics</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-money-bill-wave w-6 text-center"></i>
                         <span class="ml-3 font-medium">Payments</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Reports</span>
                     </a>
                 </div>
             </div> --}}

             <!-- Website Management -->
             {{-- <div class="mt-6">
                 <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Website
                     Management</h3>
                 <div class="mt-2 space-y-1">
                     <a href="{% url 'hero' % }"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-chart-line w-6 text-center"></i>
                         <span class="ml-3 font-medium">Hero</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-money-bill-wave w-6 text-center"></i>
                         <span class="ml-3 font-medium">Features</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-money-bill-wave w-6 text-center"></i>
                         <span class="ml-3 font-medium">Features 2</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">About</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Services</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Price</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Team</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Project</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Testimonial</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Counter</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Client</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Blog</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Contact</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">CTA</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-file-invoice w-6 text-center"></i>
                         <span class="ml-3 font-medium">Footer</span>
                     </a>
                 </div>
             </div> --}}

             <!-- Settings -->
             <div class="mt-6">
                 <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Settings</h3>
                 <div class="mt-2 space-y-1">
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-cog w-6 text-center"></i>
                         <span class="ml-3 font-medium">System Settings</span>
                     </a>
                     <a href="#"
                         class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-londa-light hover:text-londa-orange">
                         <i class="fas fa-user-shield w-6 text-center"></i>
                         <span class="ml-3 font-medium">Admin Users</span>
                     </a>
                 </div>
             </div>
         </nav>
     </div>

     <!-- User Profile Section -->
     <div class="p-4 border-t border-gray-200">
         <div class="flex items-center space-x-3">
             <img class="w-10 h-10 rounded-full"
                 src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                 alt="Admin User">
             <div class="flex-1 min-w-0">
                 <p class="text-sm font-medium text-gray-900 truncate">John Anderson</p>
                 <p class="text-xs text-gray-500 truncate">Admin</p>
             </div>
             <button class="text-gray-400 hover:text-gray-500">
                 <i class="fas fa-chevron-down"></i>
             </button>
         </div>
     </div>
 </div>
