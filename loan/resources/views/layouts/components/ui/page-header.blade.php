@props([
    'showBreadcrumbs' => true,
    'showActions' => true,
])

<div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <!-- Left Section -->
            <div class="flex-1 min-w-0">
                <!-- Breadcrumbs -->
                @if ($showBreadcrumbs && View::hasSection('breadcrumbs'))
                    <nav class="flex mb-2" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2 text-sm">
                            @yield('breadcrumbs')
                        </ol>
                    </nav>
                @endif

                <!-- Page Title & Description -->
                <div class="flex items-center">
                    @hasSection('page-icon')
                        <div class="flex-shrink-0 mr-3">
                            @yield('page-icon')
                        </div>
                    @endif

                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            @yield('page-title', 'Dashboard')

                            @hasSection('page-badge')
                                @yield('page-badge')
                            @endif
                        </h1>

                        @hasSection('page-description')
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 max-w-2xl">
                                @yield('page-description')
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Page Actions -->
            @if ($showActions && View::hasSection('page-actions'))
                <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                    @yield('page-actions')
                </div>
            @endif
        </div>
    </div>
</div>
