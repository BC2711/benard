@php $cs = \App\Models\ConsultationSection::first(); @endphp

<style>
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(219, 145, 35, 0.2);
        border-color: #db9123;
    }
</style>

<section id="consultation" class="py-16 bg-gradient-to-br from-primary-primary via-primary-800 to-primary-700 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto text-center mb-10">
            <div
                class="inline-flex items-center space-x-2 bg-white/10 text-white px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wider mb-5 border border-white/20">
                <i class="fas fa-calendar-check text-xs"></i>
                <span>Free Consultation</span>
            </div>
            <h1 class="text-3xl lg:text-4xl xl:text-5xl font-black mb-4">{{ $cs->heading }}</h1>
            <div class="w-20 h-1 bg-primary-accent mx-auto rounded-full mb-5"></div>
            <p class="text-lg text-white/80 leading-relaxed max-w-3xl mx-auto">{{ $cs->description }}</p>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- Form Column -->
            <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-2xl">
                <form action="{{ route('management.consultation.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="firstName" class="block text-primary-primary text-sm font-bold mb-2">First Name
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="first_name" id="firstName" value="{{ old('first_name') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-secondary @error('first_name') border-red-500 @enderror"
                                required>
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="lastName" class="block text-primary-primary text-sm font-bold mb-2">Last Name
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="last_name" id="lastName" value="{{ old('last_name') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-secondary @error('last_name') border-red-500 @enderror"
                                required>
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="email" class="block text-primary-primary text-sm font-bold mb-2">Email
                                Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-secondary @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="phone" class="block text-primary-primary text-sm font-bold mb-2">Phone Number
                                <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-secondary @error('phone') border-red-500 @enderror"
                                required>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="date" class="block text-primary-primary text-sm font-bold mb-2">Preferred
                                Date <span class="text-red-500">*</span></label>
                            <input type="date" name="preferred_date" id="date"
                                value="{{ old('preferred_date') }}" min="{{ now()->format('Y-m-d') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-secondary @error('preferred_date') border-red-500 @enderror"
                                required>
                            @error('preferred_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="time" class="block text-primary-primary text-sm font-bold mb-2">Preferred
                                Time <span class="text-red-500">*</span></label>
                            <select name="preferred_time" id="time"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-secondary @error('preferred_time') border-red-500 @enderror"
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
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-primary-primary text-sm font-bold mb-2">Additional
                            Information</label>
                        <textarea name="message" id="message" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg form-input focus:outline-none focus:border-primary-secondary @error('message') border-red-500 @enderror"
                            placeholder="Tell us about your funding needs and goals...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if (config('services.recaptcha.site_key'))
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                            data-action="consultation"></div>
                    @endif

                    <button type="submit" id="submitBtn"
                        class="w-full bg-primary-primary text-white py-3 rounded-xl font-bold shadow-lg hover:bg-primary-secondary transition-all duration-300 hover:scale-105 flex items-center justify-center gap-2">
                        <i class="fas fa-calendar-check"></i>
                        <span id="submit-text">Schedule My Consultation</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                        <div id="loading-spinner" class="hidden">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                    </button>

                    @if (session('success'))
                        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg text-center text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p class="text-gray-400 text-xs text-center">
                        By submitting this form, you agree to our <a href="#"
                            class="text-primary-secondary hover:underline">Privacy Policy</a> and consent to be
                        contacted.
                    </p>
                </form>
            </div>

            <!-- Info Column -->
            <div>
                <h2 class="text-2xl lg:text-3xl font-black mb-5">{{ $cs->info_heading }}</h2>

                <div class="space-y-5 mb-6">
                    @foreach ($cs->benefits ?? [] as $benefit)
                        <div class="flex items-start gap-3">
                            <div class="bg-white/20 p-2.5 rounded-full flex-shrink-0">
                                <i class="fas {{ $benefit['icon'] }} text-primary-accent text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-1">{{ $benefit['title'] }}</h3>
                                <p class="text-white/70 text-sm">{{ $benefit['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 mb-6 border border-white/20">
                    <h3 class="text-lg font-bold mb-3 flex items-center gap-2">
                        <i class="fas fa-list-check text-primary-accent"></i>
                        {{ $cs->expect_heading }}
                    </h3>
                    <ul class="space-y-2">
                        @foreach ($cs->expectations ?? [] as $exp)
                            <li class="flex items-center gap-2 text-sm">
                                <i class="fas fa-check-circle text-primary-accent text-xs"></i>
                                <span class="text-white/80">{{ $exp['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-lg">
                    <h3 class="text-lg font-bold text-primary-primary mb-2 flex items-center gap-2">
                        <i class="fas fa-headset text-primary-secondary"></i>
                        {{ $cs->contact_heading }}
                    </h3>
                    <p class="text-gray-500 text-sm mb-3">{{ $cs->contact_description }}</p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="tel:{{ preg_replace('/\D/', '', $cs->phone) }}"
                            class="flex items-center gap-2 text-primary-primary hover:text-primary-secondary transition text-sm font-semibold">
                            <i class="fas fa-phone"></i> <span>{{ $cs->phone }}</span>
                        </a>
                        <a href="mailto:{{ $cs->email }}"
                            class="flex items-center gap-2 text-primary-primary hover:text-primary-secondary transition text-sm font-semibold">
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
        const form = document.querySelector('#consultation form');

        if (form) {
            form.addEventListener('submit', function(e) {
                const submitBtn = document.getElementById('submitBtn');
                const submitText = document.getElementById('submit-text');
                const spinner = document.getElementById('loading-spinner');

                if (submitBtn && submitText && spinner) {
                    submitBtn.disabled = true;
                    submitText.classList.add('hidden');
                    spinner.classList.remove('hidden');
                }
            });
        }
    });
</script>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-input {
        background-color: white;
        color: #374151;
        border: 1px solid #d1d5db;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #db9123;
        box-shadow: 0 0 0 3px rgba(219, 145, 35, 0.1);
    }

    input,
    textarea,
    select {
        color: #374151 !important;
    }

    input::placeholder,
    textarea::placeholder {
        color: #9ca3af !important;
    }
</style>
