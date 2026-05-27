<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'londa': {
                        '50': '#ecfeff',
                        '100': '#cffafe',
                        '200': '#a5f3fc',
                        '300': '#67e8f9',
                        '400': '#22d3ee',
                        '500': '#0891b2',
                        '600': '#0e7490',
                        '700': '#155e75',
                        '800': '#164e63',
                        '900': '#083344',
                    },
                    'londa-brown': '#155e75',
                    'londa-orange': '#0f766e',
                    'londa-light': '#f8fafc'
                },
                fontFamily: {
                    'sans': ['Inter', 'system-ui', 'sans-serif'],
                },
                animation: {
                    'fade-in': 'fadeIn 0.5s ease-in-out',
                    'slide-in-right': 'slideInRight 0.3s ease-out',
                    'slide-in-left': 'slideInLeft 0.3s ease-out',
                    'bounce-in': 'bounceIn 0.6s ease-out',
                    'pulse-soft': 'pulseSoft 2s infinite',
                },
                keyframes: {
                    fadeIn: {
                        '0%': { opacity: '0', transform: 'translateY(10px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    slideInRight: {
                        '0%': { transform: 'translateX(100%)' },
                        '100%': { transform: 'translateX(0)' }
                    },
                    slideInLeft: {
                        '0%': { transform: 'translateX(-100%)' },
                        '100%': { transform: 'translateX(0)' }
                    },
                    bounceIn: {
                        '0%': { opacity: '0', transform: 'scale(0.3)' },
                        '50%': { opacity: '1', transform: 'scale(1.05)' },
                        '70%': { transform: 'scale(0.9)' },
                        '100%': { opacity: '1', transform: 'scale(1)' }
                    },
                    pulseSoft: {
                        '0%, 100%': { opacity: '1' },
                        '50%': { opacity: '0.7' }
                    }
                }
            }
        },
        darkMode: 'class',
    }
</script>

<style>
    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Glass Morphism */
    .glass {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .glass-dark {
        background: rgba(15, 23, 42, 0.25);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Print Styles */
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>
