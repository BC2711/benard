<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LoanFlow - Get Your Loan Approved Today' }}</title>

    <!-- Laravel Asset Helper for CDN and local files -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slider-value {
            transition: all 0.3s ease;
        }

        input[type="range"] {
            -webkit-appearance: none;
            appearance: none;
            height: 8px;
            border-radius: 5px;
            background: #e5e7eb;
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
        }

        input[type="range"]::-moz-range-thumb {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold gradient-text">Londa Loans</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="nav-link text-gray-700 hover:text-purple-600 transition">Home</a>
                    <a href="#calculator" class="nav-link text-gray-700 hover:text-purple-600 transition">Calculator</a>
                    <a href="#loans" class="nav-link text-gray-700 hover:text-purple-600 transition">Loans</a>
                    <a href="#process" class="nav-link text-gray-700 hover:text-purple-600 transition">Process</a>
                    <a href="#contact" class="nav-link text-gray-700 hover:text-purple-600 transition">Contact</a>
                </div>
                <div>
                    <button
                        class="gradient-bg text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
                        Apply Now
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-24 pb-16 gradient-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white fade-in">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Get Your Dream Loan in Minutes
                    </h1>
                    <p class="text-xl mb-8 text-purple-100">
                        Fast approval, low interest rates, and flexible repayment options. Your financial freedom starts
                        here.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Get Started
                        </button>
                        <button
                            class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">
                            Learn More
                        </button>
                    </div>
                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div>
                            <div class="text-3xl font-bold">50K+</div>
                            <div class="text-purple-100">Happy Clients</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">$2B+</div>
                            <div class="text-purple-100">Loans Funded</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">4.9★</div>
                            <div class="text-purple-100">Rating</div>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white rounded-2xl shadow-2xl p-8">
                        <h3 class="text-2xl font-bold mb-6 text-gray-800">Quick Application</h3>
                        <form class="space-y-4" action="{{ route('loan.application.store') }}" method="POST">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="name"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    placeholder="John Doe" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    placeholder="john@example.com" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Loan Amount</label>
                                <input type="text" name="loan_amount"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    placeholder="$10,000" value="{{ old('loan_amount') }}">
                                @error('loan_amount')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit"
                                class="w-full gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition">
                                Get Pre-Qualified
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Loan Calculator -->
    <section id="calculator" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Loan Calculator</h2>
                <p class="text-xl text-gray-600">Calculate your monthly payments instantly</p>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl shadow-lg p-8">
                <div class="space-y-8">
                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="text-sm font-medium text-gray-700">Loan Amount</label>
                            <span class="text-lg font-bold text-purple-600" id="loanAmountValue">$50,000</span>
                        </div>
                        <input type="range" id="loanAmount" min="1000" max="500000" value="50000"
                            step="1000" class="w-full">
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="text-sm font-medium text-gray-700">Interest Rate (%)</label>
                            <span class="text-lg font-bold text-purple-600" id="interestRateValue">5.5%</span>
                        </div>
                        <input type="range" id="interestRate" min="1" max="20" value="5.5"
                            step="0.1" class="w-full">
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="text-sm font-medium text-gray-700">Loan Term (Years)</label>
                            <span class="text-lg font-bold text-purple-600" id="loanTermValue">10 years</span>
                        </div>
                        <input type="range" id="loanTerm" min="1" max="30" value="10"
                            class="w-full">
                    </div>
                </div>
                <div class="mt-12 bg-white rounded-xl p-8 text-center">
                    <div class="text-gray-600 text-lg mb-2">Your Monthly Payment</div>
                    <div class="text-5xl font-bold gradient-text" id="monthlyPayment">$537</div>
                    <div class="grid grid-cols-2 gap-6 mt-8">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-gray-600 text-sm">Total Interest</div>
                            <div class="text-2xl font-bold text-gray-800" id="totalInterest">$14,440</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-gray-600 text-sm">Total Payment</div>
                            <div class="text-2xl font-bold text-gray-800" id="totalPayment">$64,440</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Loan Types -->
    <section id="loans" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Loan Products</h2>
                <p class="text-xl text-gray-600">Choose the perfect loan for your needs</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($loanProducts ?? [] as $product)
                    <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                        <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                            {!! $product['icon'] !!}
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ $product['name'] }}</h3>
                        <p class="text-gray-600 mb-6">{{ $product['description'] }}</p>
                        <ul class="space-y-3 mb-6">
                            @foreach ($product['features'] as $feature)
                                <li class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('loan.apply', ['type' => $product['slug']]) }}"
                            class="w-full gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition block text-center">
                            Apply Now
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Process -->
    <section id="process" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">How It Works</h2>
                <p class="text-xl text-gray-600">Get your loan in 3 simple steps</p>
            </div>
            <div class="grid md:grid-cols-3 gap-12">
                @foreach ($processSteps ?? [] as $step)
                    <div class="text-center">
                        <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl font-bold text-white">{{ $step['number'] }}</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ $step['title'] }}</h3>
                        <p class="text-gray-600">{{ $step['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-purple-100 mb-8">Join thousands of satisfied customers who trusted us with their
                financial needs.</p>
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <a href="{{ route('loan.apply') }}"
                    class="bg-white text-purple-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition text-lg">
                    Apply for a Loan
                </a>
                <a href="{{ route('contact') }}"
                    class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition text-lg">
                    Contact Us
                </a>
            </div>
            <div class="grid md:grid-cols-3 gap-8 text-white">
                <div>
                    <div class="text-2xl font-bold mb-2">📞 Call Us</div>
                    <div class="text-purple-100">{{ $contactInfo['phone'] ?? '1-800-LOAN-NOW' }}</div>
                </div>
                <div>
                    <div class="text-2xl font-bold mb-2">✉️ Email</div>
                    <div class="text-purple-100">{{ $contactInfo['email'] ?? 'support@loanflow.com' }}</div>
                </div>
                <div>
                    <div class="text-2xl font-bold mb-2">⏰ Hours</div>
                    <div class="text-purple-100">{{ $contactInfo['hours'] ?? 'Mon-Fri: 8AM - 8PM' }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="text-2xl font-bold text-white mb-4">LoanFlow</div>
                    <p class="text-sm">Your trusted partner for all financial needs.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Products</h4>
                    <ul class="space-y-2 text-sm">
                        @foreach ($footerProducts ?? [] as $product)
                            <li><a href="{{ $product['url'] }}"
                                    class="hover:text-white transition">{{ $product['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        @foreach ($footerCompany ?? [] as $item)
                            <li><a href="{{ $item['url'] }}"
                                    class="hover:text-white transition">{{ $item['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        @foreach ($footerLegal ?? [] as $item)
                            <li><a href="{{ $item['url'] }}"
                                    class="hover:text-white transition">{{ $item['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} LoanFlow. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            // Smooth scrolling for navigation
            $('.nav-link, a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                const target = $(this).attr('href');
                if (target && target !== '#') {
                    $('html, body').animate({
                        scrollTop: $(target).offset().top - 70
                    }, 800);
                }
            });

            // Loan calculator functionality
            function calculateLoan() {
                const loanAmount = parseFloat($('#loanAmount').val());
                const interestRate = parseFloat($('#interestRate').val()) / 100;
                const loanTerm = parseFloat($('#loanTerm').val());

                const monthlyRate = interestRate / 12;
                const numberOfPayments = loanTerm * 12;

                const monthlyPayment = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) /
                    (Math.pow(1 + monthlyRate, numberOfPayments) - 1);

                const totalPayment = monthlyPayment * numberOfPayments;
                const totalInterest = totalPayment - loanAmount;

                $('#monthlyPayment').text('$' + monthlyPayment.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                $('#totalInterest').text('$' + totalInterest.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                $('#totalPayment').text('$' + totalPayment.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
            }

            // Update slider values
            $('#loanAmount').on('input', function() {
                const value = parseInt($(this).val());
                $('#loanAmountValue').text('$' + value.toLocaleString());
                calculateLoan();
            });

            $('#interestRate').on('input', function() {
                const value = parseFloat($(this).val());
                $('#interestRateValue').text(value.toFixed(1) + '%');
                calculateLoan();
            });

            $('#loanTerm').on('input', function() {
                const value = parseInt($(this).val());
                $('#loanTermValue').text(value + ' year' + (value !== 1 ? 's' : ''));
                calculateLoan();
            });

            // Initialize calculator
            calculateLoan();

            // Fade in animation on scroll
            $(window).on('scroll', function() {
                $('.card-hover').each(function() {
                    const elementTop = $(this).offset().top;
                    const windowBottom = $(window).scrollTop() + $(window).height();

                    if (elementTop < windowBottom - 100) {
                        $(this).addClass('fade-in');
                    }
                });
            });

            // Form submission (demo)
            $('form').on('submit', function(e) {
                // Let Laravel handle the form submission
                // This will only run if JavaScript validation is needed
            });

            // Button hover effects
            $('button').hover(
                function() {
                    $(this).css('transform', 'scale(1.05)');
                },
                function() {
                    $(this).css('transform', 'scale(1)');
                }
            );

            // Add active class to nav on scroll
            $(window).on('scroll', function() {
                const scrollPos = $(window).scrollTop() + 100;

                $('.nav-link').each(function() {
                    const target = $(this).attr('href');
                    if ($(target).length) {
                        const targetTop = $(target).offset().top;
                        const targetBottom = targetTop + $(target).outerHeight();

                        if (scrollPos >= targetTop && scrollPos < targetBottom) {
                            $('.nav-link').removeClass('text-purple-600 font-semibold');
                            $(this).addClass('text-purple-600 font-semibold');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
