@props([
    'message' => 'Loading Dashboard...',
    'showLogo' => true,
    'spinnerSize' => 'md',
    'background' => 'gradient', // options: gradient, solid, blur
])

@php
    $spinnerSizes = [
        'sm' => 'w-12 h-12',
        'md' => 'w-16 h-16',
        'lg' => 'w-20 h-20',
        'xl' => 'w-24 h-24',
    ];

    $backgroundClasses = [
        'gradient' => 'bg-gradient-to-br from-white to-londa-50 dark:from-gray-900 dark:to-gray-800',
        'solid' => 'bg-white dark:bg-gray-900',
        'blur' => 'bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm',
    ];

    $spinnerClass = $spinnerSizes[$spinnerSize] ?? $spinnerSizes['md'];
    $backgroundClass = $backgroundClasses[$background] ?? $backgroundClasses['gradient'];
@endphp

<div id="loadingScreen"
    {{ $attributes->merge([
        'class' => "fixed inset-0 z-50 flex items-center justify-center transition-opacity duration-500 {$backgroundClass}",
    ]) }}
    role="status" aria-label="Loading" aria-live="polite">
    <div class="text-center max-w-sm mx-4">
        <!-- Animated Logo/Spinner -->
        <div class="flex justify-center mb-6">
            @if ($showLogo)
                <!-- Logo with Pulse Animation -->
                <div class="relative {{ $spinnerClass }}">
                    <!-- Outer Pulse Ring -->
                    <div class="absolute inset-0 bg-londa-orange rounded-full animate-ping opacity-20"></div>

                    <!-- Main Logo Container -->
                    <div
                        class="absolute inset-2 bg-gradient-to-br from-londa-orange to-orange-600 rounded-full flex items-center justify-center shadow-lg">
                        <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans"
                            class="w-3/4 h-3/4 rounded object-cover animate-pulse" loading="eager">
                    </div>

                    <!-- Rotating Border -->
                    <div
                        class="absolute inset-0 border-2 border-londa-orange border-t-transparent rounded-full animate-spin">
                    </div>
                </div>
            @else
                <!-- Simple Spinner -->
                <div class="{{ $spinnerClass }} relative">
                    <div
                        class="absolute inset-0 border-4 border-londa-orange border-t-transparent rounded-full animate-spin">
                    </div>
                    <div class="absolute inset-2 border-2 border-londa-orange/30 rounded-full"></div>
                </div>
            @endif
        </div>

        <!-- Loading Text -->
        <div class="space-y-3">
            <p class="text-gray-600 dark:text-gray-400 font-medium text-lg transition-colors duration-300">
                {{ $message }}
            </p>

            <!-- Progress Bar -->
            <div class="w-48 mx-auto bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-londa-orange to-orange-500 rounded-full animate-progress"
                    style="animation-duration: 2s; animation-iteration-count: infinite;"></div>
            </div>

            <!-- Loading Dots -->
            <div class="flex justify-center space-x-1">
                <div class="w-2 h-2 bg-londa-orange rounded-full animate-bounce" style="animation-delay: 0s;"></div>
                <div class="w-2 h-2 bg-londa-orange rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                <div class="w-2 h-2 bg-londa-orange rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
            </div>
        </div>

        <!-- Additional Info (optional) -->
        @if ($slot->isNotEmpty())
            <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                {{ $slot }}
            </div>
        @endif
    </div>

    <!-- Loading Stats (optional) -->
    <div
        class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-xs text-gray-400 dark:text-gray-500 space-y-1">
        <div class="flex items-center justify-center space-x-2">
            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
            <span>Initializing application</span>
        </div>
    </div>
</div>

<style>
    @keyframes progress {
        0% {
            transform: translateX(-100%);
        }

        50% {
            transform: translateX(0%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .animate-progress {
        animation: progress 2s ease-in-out infinite;
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {

        .animate-progress,
        .animate-ping,
        .animate-spin,
        .animate-pulse,
        .animate-bounce {
            animation: none;
        }

        #loadingScreen {
            transition: none;
        }
    }

    /* Dark mode transitions */
    @media (prefers-color-scheme: dark) {
        #loadingScreen {
            transition: background-color 0.3s ease, opacity 0.5s ease;
        }
    }
</style>

<script>
    // Loading screen management
    window.LoadingScreen = {
        // Show loading screen
        show(message = null) {
            const loadingScreen = document.getElementById('loadingScreen');
            if (loadingScreen) {
                if (message) {
                    const messageElement = loadingScreen.querySelector('p');
                    if (messageElement) {
                        messageElement.textContent = message;
                    }
                }
                loadingScreen.style.display = 'flex';
                loadingScreen.style.opacity = '1';
            }
        },

        // Hide loading screen
        hide() {
            const loadingScreen = document.getElementById('loadingScreen');
            if (loadingScreen) {
                loadingScreen.style.opacity = '0';
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                }, 500);
            }
        },

        // Update loading message
        updateMessage(message) {
            const loadingScreen = document.getElementById('loadingScreen');
            if (loadingScreen) {
                const messageElement = loadingScreen.querySelector('p');
                if (messageElement) {
                    messageElement.textContent = message;
                }
            }
        },

        // Show progress (0-100)
        setProgress(percent) {
            const progressBar = document.querySelector('.animate-progress');
            if (progressBar) {
                progressBar.style.animation = 'none';
                progressBar.style.transform = `translateX(${percent - 100}%)`;
            }
        },

        // Initialize with page load
        init() {
            // Auto-hide after page load (fallback)
            window.addEventListener('load', () => {
                setTimeout(() => {
                    this.hide();
                }, 1000);
            });

            // Handle page transitions
            document.addEventListener('DOMContentLoaded', () => {
                // Hide loading screen when Alpine is ready
                setTimeout(() => {
                    this.hide();
                }, 500);
            });
        }
    };

    // Initialize loading screen
    document.addEventListener('DOMContentLoaded', () => {
        window.LoadingScreen.init();
    });
</script>

{{-- Usage Examples --}}
{{--
<!-- Basic Usage -->
<x-ui.loading-screen />

<!-- Custom Message -->
<x-ui.loading-screen message="Loading your content..." />

<!-- Different Background -->
<x-ui.loading-screen background="blur" message="Please wait..." />

<!-- Without Logo -->
<x-ui.loading-screen :show-logo="false" spinner-size="lg" />

<!-- With Additional Content -->
<x-ui.loading-screen message="Loading dashboard data...">
    <p class="text-xs text-gray-400 mt-2">This may take a few seconds</p>
</x-ui.loading-screen>

<!-- In JavaScript -->
<script>
    // Show loading screen
    LoadingScreen.show('Processing your request...');
    
    // Update message
    LoadingScreen.updateMessage('Almost done...');
    
    // Hide when done
    LoadingScreen.hide();
</script>
--}}
