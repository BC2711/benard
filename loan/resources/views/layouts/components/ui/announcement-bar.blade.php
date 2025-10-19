@props([
    'message' => 'Welcome to Londa Loans Admin v2.0 - New features available!',
    'type' => 'info', // info, success, warning, error
    'dismissible' => true,
    'link' => '#',
    'linkText' => 'Learn more',
])

@php
    $styles = [
        'info' => 'bg-gradient-to-r from-londa-orange to-orange-500',
        'success' => 'bg-gradient-to-r from-green-500 to-green-600',
        'warning' => 'bg-gradient-to-r from-yellow-500 to-yellow-600',
        'error' => 'bg-gradient-to-r from-red-500 to-red-600',
    ];

    $style = $styles[$type] ?? $styles['info'];
@endphp

<div class="{{ $style }} px-4 py-2 text-white text-sm text-center relative" x-data="announcementBar" role="region"
    aria-label="Announcement">

    <div class="flex items-center justify-center space-x-2">
        <!-- Icon -->
        <i class="fas fa-rocket animate-pulse" aria-hidden="true"></i>

        <!-- Message -->
        <span>{{ $message }}</span>

        <!-- Link -->
        @if ($link)
            <a href="{{ $link }}"
                class="underline hover:no-underline ml-2 font-medium transition-all duration-200 hover:scale-105">
                {{ $linkText }}
            </a>
        @endif
    </div>

    <!-- Dismiss Button -->
    @if ($dismissible)
        <button @click="dismiss()"
            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-current rounded"
            aria-label="Dismiss announcement">
            <i class="fas fa-times text-sm"></i>
        </button>
    @endif
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('announcementBar', () => ({
            init() {
                // Check if announcement was dismissed
                if (localStorage.getItem('announcementDismissed')) {
                    this.$el.style.display = 'none';
                }
            },

            dismiss() {
                this.$el.style.opacity = '0';
                this.$el.style.height = '0';
                this.$el.style.padding = '0';
                this.$el.style.margin = '0';

                setTimeout(() => {
                    this.$el.style.display = 'none';
                }, 300);

                // Remember dismissal
                localStorage.setItem('announcementDismissed', 'true');
            }
        }));
    });
</script>
