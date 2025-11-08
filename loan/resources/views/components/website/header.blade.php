<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LondaLoans</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logos/londa.jpg') }}">
    <script src="{{ asset('assets/js/tailwind.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': {
                            '50': '#fef8f0',
                            '100': '#fdebd6',
                            '500': '#db9123',
                            '600': '#c27a1a',
                            '700': '#7a4603',
                            '800': '#5c3502',
                            'primary': '#7a4603',
                            'primary_2': '#db9123',
                            'secondary': '#db9123',
                            'accent': '#f8b750',
                            'light': '#f8f5f0',
                            'dark': '#1a1a1a',
                        },
                        'accent': {
                            '50': '#fdf8f3',
                            '100': '#f7e9d9',
                            '500': '#db9123',
                            '600': '#c27a1a',
                        }

                    },
                    animation: {
                        'fade-in-down': 'fadeInDown 0.5s ease-out',
                        'slide-in': 'slideIn 0.3s ease-out',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'fade-in-right': 'fadeInRight 0.8s ease-out forwards',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'pulse-glow': 'pulseGlow 2s ease-in-out infinite',
                        'gradient': 'gradient 8s ease infinite',
                        'slide-in-left': 'slideInLeft 0.8s ease-out forwards',
                        'countUp': 'countUp 2s ease-out forwards',
                        'slideInfinite': 'slideInfinite 30s linear infinite',
                        'bounce-subtle': 'bounce-subtle 2s ease-in-out infinite',
                        'pulse-subtle': 'pulse-subtle 2s ease-in-out infinite',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    keyframes: {
                        fadeInDown: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(-20px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        slideIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateX(-20px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateX(0)'
                            },
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        },
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(40px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        fadeInRight: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateX(40px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateX(0)'
                            },
                        },
                        gradient: {
                            '0%, 100%': {
                                backgroundPosition: '0% 50%'
                            },
                            '50%': {
                                backgroundPosition: '100% 50%'
                            },
                        },
                        slideInLeft: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateX(-30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateX(0)'
                            },
                        },
                        pulseGlow: {
                            '0%, 100%': {
                                boxShadow: '0 0 20px rgba(219, 145, 35, 0.3)'
                            },
                            '50%': {
                                boxShadow: '0 0 30px rgba(219, 145, 35, 0.6)'
                            },
                        },
                        countUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px) scale(0.8)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0) scale(1)'
                            },
                        },
                        slideInfinite: {
                            '0%': {
                                transform: 'translateX(0)'
                            },
                            '100%': {
                                transform: 'translateX(-50%)'
                            },
                        },
                        'bounce-subtle': {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-5px)'
                            },
                        },
                        'pulse-subtle': {
                            '0%, 100%': {
                                opacity: '1'
                            },
                            '50%': {
                                opacity: '0.8'
                            },
                        }
                    }
                }
            }
        }
    </script>

</head>

<body class="bg-gray-50">
