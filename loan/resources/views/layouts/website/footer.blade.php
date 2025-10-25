<footer style="background-color: #7a4603; color: white; padding: 2rem 0; font-family: Arial, sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <!-- Footer Top -->
        <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
            @foreach ($sectionData['columns'] ?? [] as $column)
                @if ($column['type'] == 'logo')
                    <!-- Logo and Description Column -->
                    <div style="animation: fadeIn 0.5s ease-in;">
                        <a href="/"
                            style="display: flex; flex-direction: column; align-items: flex-start; text-decoration: none; margin-bottom: 1rem;">
                            <div style="display: flex; align-items: center;">
                                <span style="font-size: 1.5rem; font-weight: bold; color: white;">Londa</span>
                                <span style="font-size: 1.5rem; font-weight: bold; color: #db9123;">Loans</span>
                            </div>
                            <span style="font-size: 0.9rem; opacity: 0.8;">empowering marketeers</span>
                        </a>
                        <p style="font-size: 0.9rem; opacity: 0.8; line-height: 1.5; margin-bottom: 1rem;">
                            {{ $sectionData['company_info']['description'] ?? 'Providing specialized financial solutions for marketing professionals and entrepreneurs to fuel business growth and campaign success.' }}
                        </p>
                        <!-- Contact Info -->
                        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg style="width: 20px; height: 20px; color: #db9123;" fill="currentColor"
                                    viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M2.94 6.412A2 2 0 002 8.108V16a2 2 0 002 2h12a2 2 0 002-2V8.108a2 2 0 00-.94-1.696l-6-3.75a2 2 0 00-2.12 0l-6 3.75zM4 8.108l6 3.75 6-3.75V16H4V8.108z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href="mailto:{{ $sectionData['company_info']['email'] ?? 'loans@londaloans.com' }}"
                                    style="font-size: 0.9rem; opacity: 0.8; color: white; text-decoration: none;">
                                    {{ $sectionData['company_info']['email'] ?? 'loans@londaloans.com' }}
                                </a>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg style="width: 20px; height: 20px; color: #db9123;" fill="currentColor"
                                    viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M2 3.5A1.5 1.5 0 013.5 2h1A1.5 1.5 0 016 3.5v1A1.5 1.5 0 014.5 6h-1A1.5 1.5 0 012 4.5v-1zM3.5 10a1.5 1.5 0 01-1.5-1.5v-1A1.5 1.5 0 013.5 6h1A1.5 1.5 0 016 7.5v1A1.5 1.5 0 014.5 10h-1zM8 3.5A1.5 1.5 0 019.5 2h1a1.5 1.5 0 011.5 1.5v1a1.5 1.5 0 01-1.5 1.5h-1A1.5 1.5 0 018 4.5v-1zM9.5 10a1.5 1.5 0 01-1.5-1.5v-1a1.5 1.5 0 011.5-1.5h1a1.5 1.5 0 011.5 1.5v1a1.5 1.5 0 01-1.5 1.5h-1zM16 3.5a1.5 1.5 0 00-1.5-1.5h-1a1.5 1.5 0 00-1.5 1.5v1a1.5 1.5 0 001.5 1.5h1a1.5 1.5 0 001.5-1.5v-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span style="font-size: 0.9rem; opacity: 0.8;">
                                    {{ $sectionData['company_info']['address'] ?? '123 Marketing District, SF 94105' }}
                                </span>
                            </div>
                            @if (isset($sectionData['company_info']['phone']))
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg style="width: 20px; height: 20px; color: #db9123;" fill="currentColor"
                                        viewBox="0 0 20 20" aria-hidden="true">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $sectionData['company_info']['phone']) }}"
                                        style="font-size: 0.9rem; opacity: 0.8; color: white; text-decoration: none;">
                                        {{ $sectionData['company_info']['phone'] }}
                                    </a>
                                </div>
                            @endif
                        </div>
                        <!-- Social Links -->
                        <ul style="display: flex; gap: 0.5rem; list-style: none; padding: 0;">
                            @foreach ($sectionData['social_links'] ?? [] as $social)
                                <li>
                                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                        style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: #db9123; border-radius: 50%; text-decoration: none; transition: opacity 0.3s;"
                                        aria-label="{{ $social['aria_label'] ?? 'Follow us on ' . $social['platform'] }}">
                                        @if (strtolower($social['platform']) == 'facebook')
                                            <i class="fab fa-facebook-f" style="color: white; font-size: 14px;"></i>
                                        @elseif(strtolower($social['platform']) == 'twitter')
                                            <i class="fab fa-twitter" style="color: white; font-size: 14px;"></i>
                                        @elseif(strtolower($social['platform']) == 'linkedin')
                                            <i class="fab fa-linkedin-in" style="color: white; font-size: 14px;"></i>
                                        @elseif(strtolower($social['platform']) == 'instagram')
                                            <i class="fab fa-instagram" style="color: white; font-size: 14px;"></i>
                                        @else
                                            <i class="fas fa-share-alt" style="color: white; font-size: 14px;"></i>
                                        @endif
                                    </a>
                                </li>
                            @endforeach

                            {{-- Fallback social links --}}
                            @if (empty($sectionData['social_links']))
                                <li>
                                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer"
                                        style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: #db9123; border-radius: 50%; text-decoration: none;"
                                        aria-label="Facebook">
                                        <i class="fab fa-facebook-f" style="color: white; font-size: 14px;"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com" target="_blank" rel="noopener noreferrer"
                                        style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: #db9123; border-radius: 50%; text-decoration: none;"
                                        aria-label="Twitter">
                                        <i class="fab fa-twitter" style="color: white; font-size: 14px;"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer"
                                        style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background-color: #db9123; border-radius: 50%; text-decoration: none;"
                                        aria-label="LinkedIn">
                                        <i class="fab fa-linkedin-in" style="color: white; font-size: 14px;"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                @elseif($column['type'] == 'links')
                    <!-- Links Column -->
                    <div style="animation: fadeIn 0.5s ease-in;">
                        <h4 style="font-size: 1.2rem; font-weight: bold; color: #db9123; margin-bottom: 1rem;">
                            {{ $column['title'] ?? 'Links' }}</h4>
                        <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 0.5rem;">
                            @foreach ($column['links'] ?? [] as $link)
                                <li>
                                    <a href="{{ $link['url'] ?? '#' }}"
                                        style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none; transition: opacity 0.3s;">
                                        {{ $link['text'] ?? 'Link' }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @elseif($column['type'] == 'newsletter')
                    <!-- Newsletter Column -->
                    <div style="animation: fadeIn 0.5s ease-in;">
                        <h4 style="font-size: 1.2rem; font-weight: bold; color: #db9123; margin-bottom: 1rem;">
                            {{ $column['title'] ?? 'Newsletter' }}</h4>
                        <p style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 1rem;">
                            {{ $column['description'] ?? 'Get marketing finance tips and loan insights' }}
                        </p>

                        <form id="newsletterForm">
                            @csrf
                            <div style="display: flex; gap: 0.5rem;">
                                <input type="email" name="email" placeholder="Your email address" required
                                    style="flex: 1; padding: 0.5rem; background-color: rgba(255,255,255,0.1); border: 1px solid #db9123; color: white; border-radius: 4px; font-size: 0.9rem;"
                                    aria-label="Email address" />
                                <button type="submit"
                                    style="padding: 0.5rem 1rem; background-color: #db9123; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;"
                                    aria-label="Subscribe to newsletter">
                                    <svg style="width: 20px; height: 20px;" fill="white" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.1175 1.17318L18.5025 9.63484C18.5678 9.67081 18.6223 9.72365 18.6602 9.78786C18.6982 9.85206 18.7182 9.92527 18.7182 9.99984C18.7182 10.0744 18.6982 10.1476 18.6602 10.2118C18.6223 10.276 18.5678 10.3289 18.5025 10.3648L3.1175 18.8265C3.05406 18.8614 2.98262 18.8792 2.91023 18.8781C2.83783 18.8769 2.76698 18.857 2.70465 18.8201C2.64232 18.7833 2.59066 18.7308 2.55478 18.6679C2.51889 18.6051 2.50001 18.5339 2.5 18.4615V1.53818C2.50001 1.46577 2.51889 1.39462 2.55478 1.33174C2.59066 1.26885 2.64232 1.2164 2.70465 1.17956C2.76698 1.14272 2.83783 1.12275 2.91023 1.12163C2.98262 1.12051 3.05406 1.13828 3.1175 1.17318ZM4.16667 10.8332V16.3473L15.7083 9.99984L4.16667 3.65234V9.16651H8.33333V10.8332H4.16667Z" />
                                    </svg>
                                </button>
                            </div>
                            <p id="newsletterMessage" style="margin-top: 0.5rem; font-size: 0.9rem; min-height: 20px;">
                            </p>
                        </form>
                    </div>
                @endif
            @endforeach

            {{-- Fallback columns if no data --}}
            @if (empty($sectionData['columns']))
                <!-- Logo and Description (Fallback) -->
                <div style="animation: fadeIn 0.5s ease-in;">
                    <a href="/"
                        style="display: flex; flex-direction: column; align-items: flex-start; text-decoration: none; margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center;">
                            <span style="font-size: 1.5rem; font-weight: bold; color: white;">Londa</span>
                            <span style="font-size: 1.5rem; font-weight: bold; color: #db9123;">Loans</span>
                        </div>
                        <span style="font-size: 0.9rem; opacity: 0.8;">empowering marketeers</span>
                    </a>
                    <p style="font-size: 0.9rem; opacity: 0.8; line-height: 1.5; margin-bottom: 1rem;">
                        Providing specialized financial solutions for marketing professionals and entrepreneurs to fuel
                        business growth and campaign success.
                    </p>
                </div>

                <!-- Quick Links (Fallback) -->
                <div style="animation: fadeIn 0.5s ease-in;">
                    <h4 style="font-size: 1.2rem; font-weight: bold; color: #db9123; margin-bottom: 1rem;">Quick Links
                    </h4>
                    <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 0.5rem;">
                        <li><a href="/about"
                                style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none;">About
                                Us</a></li>
                        <li><a href="/loans"
                                style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none;">Loan
                                Products</a></li>
                        <li><a href="/apply"
                                style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none;">Apply
                                Now</a></li>
                        <li><a href="/contact"
                                style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none;">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Resources (Fallback) -->
                <div style="animation: fadeIn 0.5s ease-in;">
                    <h4 style="font-size: 1.2rem; font-weight: bold; color: #db9123; margin-bottom: 1rem;">Resources
                    </h4>
                    <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 0.5rem;">
                        <li><a href="/blog"
                                style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none;">Blog</a>
                        </li>
                        <li><a href="/faq"
                                style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none;">FAQ</a>
                        </li>
                        <li><a href="/guides"
                                style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none;">Guides</a>
                        </li>
                        <li><a href="/calculator"
                                style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none;">Loan
                                Calculator</a></li>
                    </ul>
                </div>

                <!-- Newsletter (Fallback) -->
                <div style="animation: fadeIn 0.5s ease-in;">
                    <h4 style="font-size: 1.2rem; font-weight: bold; color: #db9123; margin-bottom: 1rem;">Newsletter
                    </h4>
                    <p style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 1rem;">
                        Get marketing finance tips and loan insights
                    </p>
                    <form id="newsletterFormFallback">
                        @csrf
                        <div style="display: flex; gap: 0.5rem;">
                            <input type="email" name="email" placeholder="Your email address" required
                                style="flex: 1; padding: 0.5rem; background-color: rgba(255,255,255,0.1); border: 1px solid #db9123; color: white; border-radius: 4px; font-size: 0.9rem;"
                                aria-label="Email address" />
                            <button type="submit"
                                style="padding: 0.5rem 1rem; background-color: #db9123; border: none; border-radius: 4px; cursor: pointer;"
                                aria-label="Subscribe to newsletter">
                                <svg style="width: 20px; height: 20px;" fill="white" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.1175 1.17318L18.5025 9.63484C18.5678 9.67081 18.6223 9.72365 18.6602 9.78786C18.6982 9.85206 18.7182 9.92527 18.7182 9.99984C18.7182 10.0744 18.6982 10.1476 18.6602 10.2118C18.6223 10.276 18.5678 10.3289 18.5025 10.3648L3.1175 18.8265C3.05406 18.8614 2.98262 18.8792 2.91023 18.8781C2.83783 18.8769 2.76698 18.857 2.70465 18.8201C2.64232 18.7833 2.59066 18.7308 2.55478 18.6679C2.51889 18.6051 2.50001 18.5339 2.5 18.4615V1.53818C2.50001 1.46577 2.51889 1.39462 2.55478 1.33174C2.59066 1.26885 2.64232 1.2164 2.70465 1.17956C2.76698 1.14272 2.83783 1.12275 2.91023 1.12163C2.98262 1.12051 3.05406 1.13828 3.1175 1.17318ZM4.16667 10.8332V16.3473L15.7083 9.99984L4.16667 3.65234V9.16651H8.33333V10.8332H4.16667Z" />
                                </svg>
                            </button>
                        </div>
                        <p id="newsletterMessageFallback"
                            style="margin-top: 0.5rem; font-size: 0.9rem; min-height: 20px;"></p>
                    </form>
                </div>
            @endif
        </div>
        <!-- Footer Bottom -->
        <div
            style="border-top: 1px solid #db9123; padding-top: 1rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem;">
            <ul style="display: flex; gap: 1rem; list-style: none; padding: 0;">
                @foreach ($sectionData['bottom_links'] ?? [] as $link)
                    <li>
                        <a href="{{ $link['url'] ?? '#' }}"
                            style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none; transition: opacity 0.3s;">
                            {{ $link['text'] ?? 'Link' }}
                        </a>
                    </li>
                @endforeach

                {{-- Fallback bottom links --}}
                @if (empty($sectionData['bottom_links']))
                    <li><a href="/privacy"
                            style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none; transition: opacity 0.3s;">Privacy
                            Policy</a></li>
                    <li><a href="/terms"
                            style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none; transition: opacity 0.3s;">Terms
                            of Service</a></li>
                    <li><a href="/compliance"
                            style="font-size: 0.9rem; color: white; opacity: 0.8; text-decoration: none; transition: opacity 0.3s;">Compliance</a>
                    </li>
                @endif
            </ul>
            <p style="font-size: 0.9rem; opacity: 0.8;">
                {{ $sectionData['copyright'] ?? '© 2025 Londa Loans. All rights reserved. Empowering marketeers with financial solutions.' }}
            </p>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button id="scrollTopBtn"
    style="position: fixed; bottom: 20px; right: 20px; width: 40px; height: 40px; background-color: #db9123; border: none; border-radius: 50%; cursor: pointer; display: none; align-items: center; justify-content: center; transition: opacity 0.3s; z-index: 1000;"
    aria-label="Scroll to top">
    <svg style="width: 24px; height: 24px;" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path
            d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
    </svg>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll to top functionality
        const scrollTopBtn = document.getElementById('scrollTopBtn');

        window.addEventListener('scroll', () => {
            scrollTopBtn.style.display = window.pageYOffset > 50 ? 'flex' : 'none';
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Newsletter form handling
        const newsletterForm = document.getElementById('newsletterForm');
        const newsletterMessage = document.getElementById('newsletterMessage');

        if (newsletterForm) {
            newsletterForm.addEventListener('submit', handleNewsletterSubmit);
        }

        // Fallback newsletter form
        const newsletterFormFallback = document.getElementById('newsletterFormFallback');
        const newsletterMessageFallback = document.getElementById('newsletterMessageFallback');

        if (newsletterFormFallback) {
            newsletterFormFallback.addEventListener('submit', handleNewsletterSubmit);
        }

        // Update your footer JavaScript
        async function handleNewsletterSubmit(event) {
            event.preventDefault();

            const form = event.target;
            const messageElement = form.id === 'newsletterForm' ? newsletterMessage :
                newsletterMessageFallback;
            const emailInput = form.querySelector('input[type="email"]');
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;

            const email = emailInput.value.trim();

            // Basic email validation
            if (!email) {
                showMessage(messageElement, 'Please enter a valid email address.', 'error');
                return;
            }

            if (!isValidEmail(email)) {
                showMessage(messageElement, 'Please enter a valid email address.', 'error');
                return;
            }

            // Show loading state
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            submitButton.disabled = true;
            showMessage(messageElement, 'Subscribing...', 'info');

            try {
                console.log('Sending request to /notifications/subscribe');

                const response = await fetch('/notifications/subscribe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        email: email,
                        full_name: ''
                    })
                });

                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);

                // Get the response text first to see what we're getting
                const responseText = await response.text();
                console.log('Raw response:', responseText);

                // Try to parse as JSON
                let result;
                try {
                    result = JSON.parse(responseText);
                } catch (parseError) {
                    console.error('JSON parse error:', parseError);
                    console.error('Response was not JSON:', responseText);
                    throw new Error('Server returned an invalid response. Please try again.');
                }

                if (response.ok && result.success) {
                    showMessage(messageElement, 'Thank you for subscribing to our newsletter!', 'success');
                    emailInput.value = '';

                    // Reset form after success
                    setTimeout(() => {
                        showMessage(messageElement, '', 'success');
                    }, 5000);
                } else {
                    showMessage(messageElement, result.message ||
                        'Subscription failed. Please try again later.', 'error');
                }
            } catch (error) {
                console.error('Error subscribing to newsletter:', error);
                showMessage(messageElement, error.message || 'An error occurred. Please try again later.',
                    'error');
            } finally {
                // Reset button state
                submitButton.innerHTML = originalButtonText;
                submitButton.disabled = false;
            }
        }

        function showMessage(element, message, type) {
            if (!element) return;

            element.textContent = message;
            element.style.color = type === 'error' ? '#ff6b6b' :
                type === 'success' ? '#51cf66' :
                '#db9123';
            element.style.opacity = message ? '1' : '0';
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    });
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    a:hover {
        opacity: 1 !important;
    }

    button:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    #scrollTopBtn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    input:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(219, 145, 35, 0.3);
    }

    @media (max-width: 768px) {
        footer {
            padding: 1rem 0 !important;
        }

        footer>div {
            padding: 0 0.5rem !important;
        }

        footer h4 {
            font-size: 1rem !important;
        }

        footer p,
        footer a,
        footer input {
            font-size: 0.85rem !important;
        }

        .footer-bottom {
            flex-direction: column !important;
            text-align: center !important;
            gap: 0.5rem !important;
        }

        #scrollTopBtn {
            bottom: 10px !important;
            right: 10px !important;
            width: 35px !important;
            height: 35px !important;
        }
    }

    @media (max-width: 480px) {
        .footer-grid {
            grid-template-columns: 1fr !important;
            gap: 1.5rem !important;
        }
    }
</style>
