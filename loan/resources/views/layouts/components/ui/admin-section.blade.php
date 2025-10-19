@props([
    'collapsed' => false,
])

<div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
    <h3 class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center transition-all duration-300"
        :class="{ 'opacity-0 hidden': {{ $collapsed ? 'true' : 'false' }} }">
        <i class="fas fa-cog w-4 text-center mr-2" aria-hidden="true"></i>
        Administration
    </h3>

    <div class="space-y-1">
        <a href="{{ route('management.users.index') }}"
            class="nav-item group flex items-center px-3 py-2.5 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-all duration-200 ease-in-out border-l-4"
            :class="{
                           'bg-londa-50 dark:bg-gray-700 text-londa-orange dark:text-londa-300 border-l-4 border-londa-orange': request()->routeIs('management.users.*'),
                           'border-transparent': !request()->routeIs('management.users.*')
                       }">

            <i class="fas fa-user-shield w-5 text-center transition-colors duration-200"
                :class="{
                                   'text-londa-orange': request()->routeIs('management.users.*'),
                                   'text-gray-400 group-hover:text-londa-orange': !request()->routeIs('management.users.*')
                               }"
                aria-hidden="true"></i>

            <span class="ml-3 font-medium text-sm transition-all duration-300"
                :class="{ 'opacity-0 w-0 hidden': {{ $collapsed ? 'true' : 'false' }} }">
                Admin Users
            </span>

            <span class="ml-auto transition-all duration-200"
                :class="{
                                      'opacity-100': !{{ $collapsed ? 'true' : 'false' }} && (request()->routeIs('management.users.*') || group.hover),
                                      'opacity-0': {{ $collapsed ? 'true' : 'false' }} || (!request()->routeIs('management.users.*') && !group.hover)
                                  }">
                <i class="fas fa-chevron-right text-xs text-gray-400" aria-hidden="true"></i>
            </span>
        </a>
    </div>
</div>
