@props([
    'threshold' => 300,
    'position' => 'bottom-right', // bottom-right, bottom-left, bottom-center
    'size' => 'md',
])

@php
    $positions = [
        'bottom-right' => 'bottom-8 right-8',
        'bottom-left' => 'bottom-8 left-8',
        'bottom-center' => 'bottom-8 left-1/2 transform -translate-x-1/2',
    ];

    $sizes = [
        'sm' => 'w-10 h-10 text-sm',
        'md' => 'w-12 h-12 text-base',
        'lg' => 'w-14 h-14 text-lg',
    ];

    $positionClass = $positions[$position] ?? $positions['bottom-right'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<button id="backToTop"
    class="fixed {{ $positionClass }} {{ $sizeClass }} bg-londa-orange text-white rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 ease-in-out z-30 hidden items-center justify-center focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2"
    aria-label="Back to top" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" x-data="backToTop"
    x-init="init({{ $threshold }})">
    <i class="fas fa-chevron-up"></i>
</button>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('backToTop', () => ({
            init(threshold) {
                const button = this.$el;

                window.addEventListener('scroll', () => {
                    const isVisible = window.scrollY > threshold;
                    button.classList.toggle('hidden', !isVisible);
                    button.classList.toggle('opacity-0', !isVisible);
                    button.classList.toggle('opacity-100', isVisible);
                });

                // Keyboard accessibility
                button.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }
                });
            }
        }));
    });
</script>
