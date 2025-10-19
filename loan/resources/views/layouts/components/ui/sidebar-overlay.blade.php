@props([
    'zIndex' => '40',
    'transition' => 'ease-linear',
    'duration' => '300',
    'blur' => true,
    'closeOnClick' => true,
    'closeOnEscape' => true,
])

@php
    $transitionClasses = "transition-opacity {$transition} duration-{$duration}";
    $blurClass = $blur ? 'backdrop-blur-sm' : '';
@endphp

<div x-show="sidebarOpen" x-transition:enter="transition-opacity {{ $transition }} duration-{{ $duration }}"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity {{ $transition }} duration-{{ $duration }}"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 flex z-{{ $zIndex }} lg:hidden"
    @if ($closeOnClick) @click="sidebarOpen = false" @endif
    @if ($closeOnEscape) @keydown.escape="sidebarOpen = false" @endif role="dialog" aria-modal="true"
    aria-label="Sidebar navigation overlay" x-cloak>
    <!-- Background Overlay -->
    <div class="fixed inset-0 bg-gray-600 dark:bg-gray-900 opacity-75 {{ $blurClass }}" aria-hidden="true"></div>

    <!-- Close Button (for accessibility) -->
    <button class="sr-only" @click="sidebarOpen = false" aria-label="Close sidebar navigation">
        Close sidebar
    </button>

    <!-- Sidebar Panel (will slide in from left) -->
    <div class="relative flex-1 flex flex-col max-w-xs w-full" x-show="sidebarOpen"
        x-transition:enter="transition-transform {{ $transition }} duration-{{ $duration }}"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform {{ $transition }} duration-{{ $duration }}"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" @click.stop role="dialog"
        aria-modal="true" aria-label="Mobile navigation menu">
        <!-- This is where the mobile sidebar content would be inserted -->
        <!-- The actual sidebar content is handled by the main sidebar component -->
    </div>

    <!-- Touch Close Area (right side) -->
    @if ($closeOnClick)
        <div class="flex-1" @click="sidebarOpen = false" aria-hidden="true">
            <!-- This empty div captures clicks on the right side of the screen -->
        </div>
    @endif
</div>

<!-- Mobile Sidebar Trigger (usually placed in header) -->
@props([
    'icon' => 'bars',
    'size' => 'md',
    'position' => 'fixed', // fixed, absolute, relative
])

@php
    $sizes = [
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
        'lg' => 'w-12 h-12 text-lg',
    ];

    $positions = [
        'fixed' => 'fixed',
        'absolute' => 'absolute',
        'relative' => 'relative',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $positionClass = $positions[$position] ?? 'fixed';
@endphp

<button @click="sidebarOpen = !sidebarOpen"
    class="{{ $positionClass }} top-4 left-4 z-50 lg:hidden {{ $sizeClass }} bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-londa-orange dark:hover:text-londa-300 hover:border-londa-orange transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2"
    aria-label="Toggle sidebar navigation" :aria-expanded="sidebarOpen" aria-controls="sidebar">
    <i class="fas fa-{{ $icon }}" x-show="!sidebarOpen"></i>
    <i class="fas fa-times" x-show="sidebarOpen" x-cloak></i>
</button>

<style>
    /* Custom animations for sidebar overlay */
    .sidebar-overlay-enter {
        animation: sidebarOverlayEnter 0.3s ease-out;
    }

    .sidebar-overlay-leave {
        animation: sidebarOverlayLeave 0.2s ease-in;
    }

    @keyframes sidebarOverlayEnter {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes sidebarOverlayLeave {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    /* Improved backdrop blur for performance */
    @supports (backdrop-filter: blur(10px)) {
        .backdrop-blur-sm {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {

        .transition-opacity,
        .transition-transform {
            transition: none;
        }

        .sidebar-overlay-enter,
        .sidebar-overlay-leave {
            animation: none;
        }
    }

    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .bg-gray-600 {
            background-color: #000;
        }

        .opacity-75 {
            opacity: 0.9;
        }
    }

    /* Mobile optimizations */
    @media (max-width: 1024px) {
        .sidebar-overlay-container {
            touch-action: pan-y;
        }
    }
</style>

<script>
    // Sidebar overlay management
    window.SidebarOverlay = {
        // Open sidebar
        open() {
            const event = new CustomEvent('sidebar-toggle', {
                detail: {
                    open: true
                }
            });
            document.dispatchEvent(event);
        },

        // Close sidebar
        close() {
            const event = new CustomEvent('sidebar-toggle', {
                detail: {
                    open: false
                }
            });
            document.dispatchEvent(event);
        },

        // Toggle sidebar
        toggle() {
            const event = new CustomEvent('sidebar-toggle');
            document.dispatchEvent(event);
        },

        // Check if sidebar is open
        isOpen() {
            const sidebar = document.getElementById('sidebar');
            return sidebar ? Alpine.$data(sidebar)?.sidebarOpen : false;
        },

        // Initialize sidebar overlay behavior
        init() {
            // Close sidebar when navigating (for SPA-like behavior)
            document.addEventListener('click', (e) => {
                const link = e.target.closest('a[href]');
                if (link && window.innerWidth < 1024) {
                    setTimeout(() => {
                        this.close();
                    }, 100);
                }
            });

            // Handle browser back button
            window.addEventListener('popstate', () => {
                if (window.innerWidth < 1024) {
                    this.close();
                }
            });

            // Close sidebar on window resize (if it becomes desktop)
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    if (window.innerWidth >= 1024) {
                        this.close();
                    }
                }, 250);
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', (e) => {
                // Escape key closes sidebar
                if (e.key === 'Escape' && this.isOpen()) {
                    this.close();
                    e.preventDefault();
                }

                // Ctrl/Cmd + B toggles sidebar
                if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                    this.toggle();
                    e.preventDefault();
                }
            });

            // Touch gesture support (swipe to close)
            let touchStartX = 0;
            let touchEndX = 0;

            document.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            });

            document.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe(touchStartX, touchEndX);
            });

            // Listen for sidebar toggle events
            document.addEventListener('sidebar-toggle', (e) => {
                this.handleSidebarToggle(e.detail);
            });
        },

        // Handle swipe gestures
        handleSwipe(startX, endX) {
            const swipeThreshold = 50;
            const swipeDistance = startX - endX;

            // Swipe left to close (if sidebar is open)
            if (swipeDistance > swipeThreshold && this.isOpen()) {
                this.close();
            }

            // Swipe right to open (if sidebar is closed and we're near the edge)
            if (swipeDistance < -swipeThreshold && !this.isOpen() && startX < 50) {
                this.open();
            }
        },

        // Handle sidebar toggle events
        handleSidebarToggle(detail) {
            const overlay = document.querySelector('[x-show="sidebarOpen"]');
            if (overlay && detail) {
                // Update body scroll state
                document.body.style.overflow = detail.open ? 'hidden' : '';

                // Update aria-hidden state for main content
                const mainContent = document.querySelector('main');
                if (mainContent) {
                    mainContent.setAttribute('aria-hidden', detail.open ? 'true' : 'false');
                }
            }
        }
    };

    // Initialize sidebar overlay
    document.addEventListener('DOMContentLoaded', () => {
        window.SidebarOverlay.init();
    });

    // Alpine.js integration for sidebar state
    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebarOverlay', () => ({
            open: false,

            init() {
                // Sync with main sidebar state
                this.$watch('open', (value) => {
                    const event = new CustomEvent('sidebar-overlay-toggle', {
                        detail: {
                            open: value
                        }
                    });
                    document.dispatchEvent(event);
                });

                // Listen for external toggle events
                document.addEventListener('sidebar-toggle', (e) => {
                    if (e.detail && typeof e.detail.open !== 'undefined') {
                        this.open = e.detail.open;
                    } else {
                        this.open = !this.open;
                    }
                });
            },

            close() {
                this.open = false;
            }
        }));
    });
</script>

{{-- Usage Examples --}}
{{--
<!-- Basic Usage (in main layout) -->
<x-ui.sidebar-overlay />

<!-- Custom Overlay -->
<x-ui.sidebar-overlay 
    z-index="50"
    :blur="false"
    :close-on-escape="false"
    transition="ease-in-out"
    duration="500"
/>

<!-- Mobile Trigger Button -->
<x-ui.sidebar-overlay.trigger 
    icon="bars"
    size="lg"
    position="fixed"
/>

<!-- In JavaScript -->
<script>
    // Open sidebar
    SidebarOverlay.open();
    
    // Close sidebar
    SidebarOverlay.close();
    
    // Toggle sidebar
    SidebarOverlay.toggle();
    
    // Check if open
    if (SidebarOverlay.isOpen()) {
        console.log('Sidebar is open');
    }
</script>

<!-- With Alpine.js -->
<div x-data="sidebarOverlay">
    <button @click="open = !open">
        Toggle Sidebar
    </button>
    
    <div x-show="open" @click="close()">
        <!-- Overlay content -->
    </div>
</div>
--}}
