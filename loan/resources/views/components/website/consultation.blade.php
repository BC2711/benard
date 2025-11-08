@php $cs = \App\Models\ConsultationSection::first(); @endphp
<style>
    .gradient-consultation-bg {
        background: linear-gradient(135deg, #f8f5f0 0%, #fef8f0 100%);
    }

    .consultation-bg {
        background: linear-gradient(135deg, #7a4603 0%, #db9123 100%);
    }

    .team-card {
        transition: all 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-8px);
    }

    .social-links {
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .team-card:hover .social-links {
        opacity: 1;
        transform: translateY(0);
    }

    .carousel-track {
        transition: transform 0.5s ease-in-out;
    }

    .shape {
        position: absolute;
        z-index: 0;
    }

    .carousel-indicator {
        transition: all 0.3s ease;
    }

    .carousel-indicator.active {
        width: 32px;
        border-radius: 8px;
    }

    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(219, 145, 35, 0.2);
    }

    .consultation-step {
        transition: all 0.3s ease;
    }

    .consultation-step.active {
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>
<section id="consultation" class="py-16 consultation-bg text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto text-center mb-12 animate-fadeIn">
            <h1 class="text-5xl font-bold mb-6">{{ $cs->heading }}</h1>
            <p class="text-xl opacity-90 leading-relaxed">{{ $cs->description }}</p>
        </div>

        <div class="max-w-8xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">

            <div class="bg-white rounded-2xl p-8 shadow-xl animate-fadeInUp">
                <form id="consultation-form" action="{{ route('management.consultation.store') }}" method="POST"
                    class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="firstName" class="block text-gray-700 mb-2 font-medium">First Name</label>
                            <input type="text" name="first_name" id="firstName" value="{{ old('first_name') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-500 @error('first_name') border-red-500 @enderror"
                                required>
                            @error('first_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="lastName" class="block text-gray-700 mb-2 font-medium">Last Name</label>
                            <input type="text" name="last_name" id="lastName" value="{{ old('last_name') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-500 @error('last_name') border-red-500 @enderror"
                                required>
                            @error('last_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-gray-700 mb-2 font-medium">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-500 @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-gray-700 mb-2 font-medium">Phone Number</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-500 @error('phone') border-red-500 @enderror"
                                required>
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="date" class="block text-gray-700 mb-2 font-medium">Preferred Date</label>
                            <input type="date" name="preferred_date" id="date"
                                value="{{ old('preferred_date') }}" min="{{ now()->format('Y-m-d') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-500 @error('preferred_date') border-red-500 @enderror"
                                required>
                            @error('preferred_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="time" class="block text-gray-700 mb-2 font-medium">Preferred Time</label>
                            <select name="preferred_time" id="time"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-500 @error('preferred_time') border-red-500 @enderror"
                                required>
                                <option value="">Select a time slot</option>
                                <option value="09:00" {{ old('preferred_time') == '09:00' ? 'selected' : '' }}>9:00 AM
                                </option>
                                <option value="10:00" {{ old('preferred_time') == '10:00' ? 'selected' : '' }}>10:00
                                    AM</option>
                                <option value="11:00" {{ old('preferred_time') == '11:00' ? 'selected' : '' }}>11:00
                                    AM</option>
                                <option value="13:00" {{ old('preferred_time') == '13:00' ? 'selected' : '' }}>1:00 PM
                                </option>
                                <option value="14:00" {{ old('preferred_time') == '14:00' ? 'selected' : '' }}>2:00 PM
                                </option>
                                <option value="15:00" {{ old('preferred_time') == '15:00' ? 'selected' : '' }}>3:00 PM
                                </option>
                                <option value="16:00" {{ old('preferred_time') == '16:00' ? 'selected' : '' }}>4:00 PM
                                </option>
                            </select>
                            @error('preferred_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-gray-700 mb-2 font-medium">Additional
                            Information</label>
                        <textarea name="message" id="message" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-500 @error('message') border-red-500 @enderror"
                            placeholder="Tell us about your funding needs and goals...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- reCAPTCHA v3 (Optional) -->
                    @if (config('services.recaptcha.site_key'))
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                            data-action="consultation"></div>
                    @endif

                    <div id="error-message" class="error-message text-sm mt-4 p-3 rounded-lg hidden"></div>
                    <button type="submit"
                        class="w-full bg-primary-700 text-white py-4 rounded-lg font-semibold text-lg hover:bg-primary-800 transition-colors flex items-center justify-center">
                        <span id="submit-text">Schedule My Consultation</span>
                        <span id="loading-spinner" class="hidden ml-2">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </button>

                    @if (session('success'))
                        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p class="text-gray-500 text-sm text-center">
                        By submitting this form, you agree to our <a href="#"
                            class="text-primary-700 hover:underline">Privacy Policy</a> and consent to be contacted by
                        our team.
                    </p>
                </form>
            </div>

            <!-- Dynamic Info -->
            <div class="animate-fadeInUp" style="animation-delay: 0.2s;">
                <h2 class="text-3xl font-bold mb-6">{{ $cs->info_heading }}</h2>

                <div class="space-y-6 mb-8">
                    @foreach ($cs->benefits ?? [] as $benefit)
                        <div class="flex items-start gap-4">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <i class="fas {{ $benefit['icon'] }} text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">{{ $benefit['title'] }}</h3>
                                <p class="opacity-90">{{ $benefit['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="bg-white bg-opacity-10 rounded-xl p-6 mb-8">
                    <h3 class="text-xl font-semibold mb-4">{{ $cs->expect_heading }}</h3>
                    <ul class="space-y-3">
                        @foreach ($cs->expectations ?? [] as $exp)
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check-circle text-accent-500"></i>
                                <span>{{ $exp['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white rounded-xl p-6 text-primary-700">
                    <h3 class="text-xl font-semibold mb-2">{{ $cs->contact_heading }}</h3>
                    <p class="mb-4">{{ $cs->contact_description }}</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="tel:{{ $cs->phone }}"
                            class="flex items-center gap-2 text-primary-700 hover:text-primary-800">
                            <i class="fas fa-phone"></i> <span>{{ $cs->phone }}</span>
                        </a>
                        <a href="mailto:{{ $cs->email }}"
                            class="flex items-center gap-2 text-primary-700 hover:text-primary-800">
                            <i class="fas fa-envelope"></i> <span>{{ $cs->email }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('consultation-form');

        if (!form) {
            console.error('Consultation form not found');
            return;
        }

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const errorMessageEl = document.getElementById('error-message');
            const submitBtn = form.querySelector('button[type="submit"]');
            const submitText = document.getElementById('submit-text');
            const spinner = document.getElementById('loading-spinner');

            // Reset previous messages
            if (errorMessageEl) {
                errorMessageEl.textContent = '';
                errorMessageEl.className = 'error-message text-sm mt-4 p-3 rounded-lg hidden';
            }

            // Show loading
            submitBtn.disabled = true;
            if (submitText) submitText.classList.add('hidden');
            if (spinner) spinner.classList.remove('hidden');

            try {
                // Get CSRF token safely
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                    'content') || '';

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Server returned non-JSON response');
                }

                const data = await response.json();

                if (response.ok && data.success) {
                    // Success
                    form.reset();
                    if (errorMessageEl) {
                        errorMessageEl.textContent = data.message ||
                            'Thank you! We\'ll contact you soon.';
                        errorMessageEl.className =
                            'error-message bg-green-100 text-green-700 p-3 rounded-lg block';
                    }

                    // Show success message at the top
                    const successDiv = document.createElement('div');
                    successDiv.className =
                        'mt-4 p-4 bg-green-100 text-green-700 rounded-lg text-center';
                    successDiv.textContent = data.message ||
                        'Thank you! Your consultation has been scheduled.';
                    form.prepend(successDiv);

                    // Remove success message after 5 seconds
                    setTimeout(() => {
                        successDiv.remove();
                    }, 5000);

                } else {
                    // Validation or server error
                    let errorMsg = data.message || 'Please fix the errors below.';
                    if (data.errors) {
                        errorMsg = Object.values(data.errors).flat().join('<br>');
                    }
                    if (errorMessageEl) {
                        errorMessageEl.innerHTML = errorMsg;
                        errorMessageEl.className =
                            'error-message bg-red-100 text-red-700 p-3 rounded-lg block';
                    }
                }
            } catch (error) {
                console.error('Submission error:', error);
                if (errorMessageEl) {
                    errorMessageEl.textContent =
                        'An error occurred. Please try again or contact us directly.';
                    errorMessageEl.className =
                        'error-message bg-red-100 text-red-700 p-3 rounded-lg block';
                }
            } finally {
                // Hide loading
                submitBtn.disabled = false;
                if (submitText) submitText.classList.remove('hidden');
                if (spinner) spinner.classList.add('hidden');
            }
        });
    });
</script>
