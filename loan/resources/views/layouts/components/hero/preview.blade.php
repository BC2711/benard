<!-- Enhanced Hero Preview -->
<div class="hero-preview-container">
    <div class="preview-controls">
        <button class="preview-btn" id="toggleShapes">
            <i class="fas fa-shapes"></i>
            Shapes
        </button>
        <button class="preview-btn" id="toggleAnimations">
            <i class="fas fa-play"></i>
            Animations
        </button>
        <button class="preview-btn" id="togglePreview">
            <i class="fas fa-eye"></i>
            Preview Mode
        </button>
    </div>

    <div class="hero-section">
        <!-- Hero Images -->
        <div class="hero-images">
            <img src="{{ asset('images/hero/main-image.png') }}" alt="Loan Application"
                class="hero-image hero-image--main">
            <img src="{{ asset('images/hero/shape1.svg') }}" alt="Shape 1" class="hero-image hero-image--shape1">
            <img src="{{ asset('images/hero/shape2.svg') }}" alt="Shape 2" class="hero-image hero-image--shape2">
            <img src="{{ asset('images/hero/shape3.svg') }}" alt="Shape 3" class="hero-image hero-image--shape3">
            <img src="{{ asset('images/hero/shape4.svg') }}" alt="Shape 4" class="hero-image hero-image--shape4">
        </div>

        <!-- Hero Content -->
        <div class="hero-content">
            <div class="hero-text">
                <!-- Logo -->
                <a href="#" class="logo-container">
                    <div class="logo-text">
                        <span class="logo-londa">Londa</span>
                        <span class="logo-loans">Loans</span>
                    </div>
                    <span class="logo-tagline">Your Trusted Partner</span>
                </a>

                <!-- Heading -->
                <h1 class="hero-heading" id="previewHeading">
                    Fast & Reliable Loans When You Need Them Most
                </h1>

                <!-- Description -->
                <p class="hero-description" id="previewDescription">
                    Get instant approval for personal loans, business funding, and emergency cash.
                    Competitive rates, flexible terms, and 24/7 customer support.
                </p>

                <!-- CTA Section -->
                <div class="hero-cta">
                    <a href="#" class="cta-button" id="previewCtaButton">
                        <i class="fas fa-rocket"></i>
                        Apply Now - Get Instant Decision
                    </a>
                    <div class="cta-contact">
                        <a href="tel:+18005551234" class="cta-phone" id="previewPhone">
                            <i class="fas fa-phone"></i>
                            +1 (800) 555-1234
                        </a>
                        <span class="cta-phone-subtext">Call us for free consultation</span>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div class="trust-indicators" id="previewTrustIndicators">
                    <div class="trust-indicator">
                        <span class="trust-value">15K+</span>
                        <span class="trust-label">Happy Customers</span>
                    </div>
                    <div class="trust-indicator">
                        <span class="trust-value">$50M+</span>
                        <span class="trust-label">Loans Approved</span>
                    </div>
                    <div class="trust-indicator">
                        <span class="trust-value">4.9★</span>
                        <span class="trust-label">Customer Rating</span>
                    </div>
                    <div class="trust-indicator">
                        <span class="trust-value">24/7</span>
                        <span class="trust-label">Support Available</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
