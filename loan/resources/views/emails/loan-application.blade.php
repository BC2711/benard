<!DOCTYPE html>
<html>

<head>
    <title>New Loan Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans">
    <div class="max-w-2xl mx-auto my-8 bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Header with Logo -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <!-- Company Logo -->
                    @if ($logoData)
                        <div class="w-16 h-16 bg-white rounded-xl p-2 flex items-center justify-center shadow-md">
                            <img src="{{ $logoData }}" alt="Londa Logo"
                                class="w-full h-full object-contain rounded-lg"
                                style="display: block; max-width: 100%;">
                        </div>
                    @else
                        <!-- Fallback text logo -->
                        <div class="w-16 h-16 bg-white rounded-xl p-2 flex items-center justify-center shadow-md">
                            <span class="text-blue-600 font-bold text-sm text-center">LONDA FINANCE</span>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-2xl font-bold">New Loan Application</h1>
                        <p class="text-blue-100 mt-1">A new application has been submitted</p>
                    </div>
                </div>
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-file-invoice-dollar text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Alert Banner -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-yellow-400 text-lg"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Action Required:</strong> Please review this application and contact the applicant
                        within 24 hours.
                    </p>
                </div>
            </div>
        </div>

        <!-- Applicant Information -->
        <div class="px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Info -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">
                        <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                        Applicant Information
                    </h3>

                    <div class="space-y-3">
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-user text-blue-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Full Name</p>
                                <p class="text-gray-900 font-semibold">{{ $data['fullname'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-envelope text-green-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email Address</p>
                                <p class="text-gray-900 font-semibold">
                                    <a href="mailto:{{ $data['email'] }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $data['email'] }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-phone text-purple-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone Number</p>
                                <p class="text-gray-900 font-semibold">
                                    @if (isset($data['phone']) && $data['phone'])
                                        <a href="tel:{{ $data['phone'] }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $data['phone'] }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-building text-orange-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Company</p>
                                <p class="text-gray-900 font-semibold">
                                    {{ $data['company'] ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loan Details -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">
                        <i class="fas fa-chart-line text-green-500 mr-2"></i>
                        Loan Details
                    </h3>

                    <div class="space-y-3">
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-briefcase text-indigo-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Business Type</p>
                                <p class="text-gray-900 font-semibold">
                                    {{ ucwords(str_replace('-', ' ', $data['businessType'])) }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-money-bill-wave text-red-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Loan Amount</p>
                                <p class="text-gray-900 font-semibold">
                                    {{ strtoupper($data['loanAmount']) }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-teal-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-bullseye text-teal-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Purpose</p>
                                <p class="text-gray-900 font-semibold">
                                    {{ ucwords(str_replace('-', ' ', $data['loanPurpose'])) }}
                                </p>
                            </div>
                        </div>

                        @if (isset($data['timeline']) && $data['timeline'])
                            <div class="flex items-start">
                                <div
                                    class="w-6 h-6 bg-pink-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                    <i class="fas fa-clock text-pink-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Funding Timeline</p>
                                    <p class="text-gray-900 font-semibold">
                                        {{ ucwords(str_replace('-', ' ', $data['timeline'])) }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Message Section -->
            @if (isset($data['message']) && $data['message'])
                <div class="mt-6 pt-6 border-t">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">
                        <i class="fas fa-comment-dots text-gray-500 mr-2"></i>
                        Additional Message
                    </h3>
                    <div class="bg-gray-50 rounded-lg p-4 border">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $data['message'] }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="bg-gray-50 px-8 py-4 border-t">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                <div class="text-sm text-gray-500">
                    <i class="fas fa-calendar-day mr-1"></i>
                    Submitted: {{ now()->format('M j, Y \a\t g:i A') }}
                </div>
                <div class="flex space-x-3">
                    <a href="mailto:{{ $data['email'] }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-reply mr-2"></i>
                        Reply via Email
                    </a>
                    @if (isset($data['phone']) && $data['phone'])
                        <a href="tel:{{ $data['phone'] }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-phone mr-2"></i>
                            Call Now
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer with Logo -->
        <div class="bg-gray-800 text-white px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <!-- Small Logo in Footer -->
                    @if ($logoData)
                        <div class="w-10 h-10 bg-white rounded-lg p-1 flex items-center justify-center">
                            <img src="{{ $logoData }}" alt="Londa Logo"
                                class="w-full h-full object-contain rounded" style="display: block; max-width: 100%;">
                        </div>
                    @else
                        <div class="w-10 h-10 bg-white rounded-lg p-1 flex items-center justify-center">
                            <span class="text-blue-600 font-bold text-xs text-center">LONDA</span>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-semibold">Londa Loan</p>
                        <p class="text-xs text-gray-300">Professional Loan Services</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-300">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Secure Application
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        Please follow up within 24 hours
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
