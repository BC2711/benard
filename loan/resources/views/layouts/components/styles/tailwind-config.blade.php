<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'londa': {
                        '50': '#fef6e6',
                        '100': '#fdebc7',
                        '200': '#fbd895',
                        '300': '#f8be58',
                        '400': '#f5a32a',
                        '500': '#ef8710',
                        '600': '#db9123',
                        '700': '#b3741c',
                        '800': '#7a4603',
                        '900': '#663a0a',
                    },
                    'londa-brown': '#7a4603',
                    'londa-orange': '#db9123',
                    'londa-light': '#f8f5f0'
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