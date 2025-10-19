<script>
    class HeroSectionManager {
        constructor() {
            this.elements = this.initializeElements();
            this.state = this.initializeState();
            this.init();
        }

        initializeElements() {
            return {
                adminPanel: document.getElementById('adminPanel'),
                toggleAdminBtn: document.getElementById('toggleAdmin'),
                heroForm: document.getElementById('heroForm'),
                cancelEditBtn: document.getElementById('cancelEdit'),
                trustIndicatorsContainer: document.getElementById('trustIndicatorsContainer'),
                addTrustIndicatorBtn: document.getElementById('addTrustIndicator'),
                preview: {
                    heading: document.getElementById('previewHeading'),
                    description: document.getElementById('previewDescription'),
                    ctaButton: document.getElementById('previewCtaButton'),
                    phone: document.getElementById('previewPhone'),
                    phoneSubtext: document.getElementById('previewCtaPhoneSubtext')
                }
            };
        }

        initializeState() {
            return {
                trustIndicatorCount: document.querySelectorAll('.trust-item-row').length,
                isAdminPanelVisible: false
            };
        }

        init() {
            this.setupEventListeners();
            this.setupRealTimePreview();
            this.initializeCharacterCounters();
        }

        setupEventListeners() {
            // Admin panel toggle
            if (this.elements.toggleAdminBtn) {
                this.elements.toggleAdminBtn.addEventListener('click', () => this.toggleAdminPanel());
            }

            // Form events
            if (this.elements.cancelEditBtn) {
                this.elements.cancelEditBtn.addEventListener('click', () => this.hideAdminPanel());
            }

            if (this.elements.addTrustIndicatorBtn) {
                this.elements.addTrustIndicatorBtn.addEventListener('click', () => this.addTrustIndicator());
            }

            if (this.elements.heroForm) {
                this.elements.heroForm.addEventListener('submit', (e) => this.validateForm(e));
            }

            // Trust indicators delegation
            if (this.elements.trustIndicatorsContainer) {
                this.elements.trustIndicatorsContainer.addEventListener('click', (e) => {
                    if (e.target.closest('.remove-trust-indicator')) {
                        this.removeTrustIndicator(e.target.closest('.remove-trust-indicator'));
                    }
                });
            }

            // Preview controls
            this.setupPreviewControls();
        }

        setupRealTimePreview() {
            const previewFields = [{
                    input: 'heroHeading',
                    preview: 'previewHeading',
                    type: 'text'
                },
                {
                    input: 'heroDescription',
                    preview: 'previewDescription',
                    type: 'text'
                },
                {
                    input: 'ctaButtonText',
                    preview: 'previewCtaButton',
                    type: 'text'
                },
                {
                    input: 'ctaButtonUrl',
                    preview: 'previewCtaButton',
                    type: 'href'
                },
                {
                    input: 'ctaPhone',
                    preview: 'previewPhone',
                    type: 'text'
                },
                {
                    input: 'ctaPhone',
                    preview: 'previewPhone',
                    type: 'href',
                    prefix: 'tel:'
                },
                {
                    input: 'ctaPhoneSubtext',
                    preview: 'previewCtaPhoneSubtext',
                    type: 'text'
                }
            ];

            previewFields.forEach(field => {
                const input = document.getElementById(field.input);
                if (input) {
                    input.addEventListener('input', () => this.updatePreview(field));
                }
            });
        }

        setupPreviewControls() {
            // Add preview control event listeners here
            const toggleShapes = document.getElementById('toggleShapes');
            const toggleAnimations = document.getElementById('toggleAnimations');

            if (toggleShapes) {
                toggleShapes.addEventListener('click', () => this.toggleShapes());
            }

            if (toggleAnimations) {
                toggleAnimations.addEventListener('click', () => this.toggleAnimations());
            }
        }

        updatePreview(field) {
            const input = document.getElementById(field.input);
            const preview = this.elements.preview[field.preview];

            if (input && preview) {
                switch (field.type) {
                    case 'text':
                        preview.textContent = input.value;
                        break;
                    case 'href':
                        let value = input.value;
                        if (field.prefix) {
                            value = field.prefix + value;
                        }
                        preview.setAttribute('href', value);
                        break;
                }
            }

            this.updateCharacterCounter(field.input);
        }

        initializeCharacterCounters() {
            const fields = ['heroHeading', 'heroDescription', 'ctaButtonText'];
            fields.forEach(fieldId => this.updateCharacterCounter(fieldId));
        }

        updateCharacterCounter(fieldId) {
            const input = document.getElementById(fieldId);
            const counter = document.getElementById(`${fieldId}CharCount`);

            if (input && counter) {
                const maxLength = input.getAttribute('maxlength') || 100;
                const currentLength = input.value.length;
                counter.textContent = currentLength;

                // Update color based on usage
                if (currentLength > maxLength * 0.9) {
                    counter.style.color = '#ef4444';
                } else if (currentLength > maxLength * 0.75) {
                    counter.style.color = '#f59e0b';
                } else {
                    counter.style.color = '#6b7280';
                }
            }
        }

        toggleAdminPanel() {
            if (this.elements.adminPanel) {
                this.state.isAdminPanelVisible = !this.state.isAdminPanelVisible;
                this.elements.adminPanel.classList.toggle('show');

                if (this.state.isAdminPanelVisible) {
                    this.elements.adminPanel.focus();
                    this.elements.adminPanel.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        }

        hideAdminPanel() {
            if (this.elements.adminPanel) {
                this.state.isAdminPanelVisible = false;
                this.elements.adminPanel.classList.remove('show');
            }
        }

        addTrustIndicator() {
            const newId = this.state.trustIndicatorCount;
            this.state.trustIndicatorCount++;

            const indicatorHtml = `
                <div class="trust-item-row">
                    <input type="text" name="trustIndicators[${newId}][value]" 
                           class="form-control trust-value-input" data-id="${newId}" 
                           placeholder="Value (e.g., 500+)" required>
                    <input type="text" name="trustIndicators[${newId}][label]" 
                           class="form-control trust-label-input" data-id="${newId}" 
                           placeholder="Label (e.g., Marketeers Funded)" required>
                    <button type="button" class="admin-btn btn-danger remove-trust-indicator" 
                            data-id="${newId}" aria-label="Remove trust indicator">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;

            if (this.elements.trustIndicatorsContainer) {
                this.elements.trustIndicatorsContainer.insertAdjacentHTML('beforeend', indicatorHtml);
            }
        }

        removeTrustIndicator(button) {
            if (confirm('Are you sure you want to remove this trust indicator?')) {
                button.closest('.trust-item-row').remove();
            }
        }

        validateForm(e) {
            let isValid = true;
            this.clearErrors();

            // Required fields validation
            const requiredFields = [
                'heroHeading', 'heroDescription', 'ctaButtonText',
                'ctaButtonUrl', 'ctaPhone', 'ctaPhoneSubtext'
            ];

            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field && !field.value.trim()) {
                    this.showError(fieldId, 'This field is required.');
                    isValid = false;
                }
            });

            // URL validation
            const urlField = document.getElementById('ctaButtonUrl');
            if (urlField && urlField.value && !this.isValidUrl(urlField.value)) {
                this.showError('ctaButtonUrl', 'Please enter a valid URL.');
                isValid = false;
            }

            // Phone validation
            const phoneField = document.getElementById('ctaPhone');
            if (phoneField && phoneField.value && !this.isValidPhone(phoneField.value)) {
                this.showError('ctaPhone', 'Please enter a valid phone number.');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                if (this.elements.adminPanel) {
                    this.elements.adminPanel.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        }

        clearErrors() {
            document.querySelectorAll('.error-message').forEach(error => {
                error.classList.remove('show');
                error.textContent = '';
            });
            document.querySelectorAll('.form-control--error').forEach(input => {
                input.classList.remove('form-control--error');
            });
        }

        showError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorElement = document.getElementById(fieldId + 'Error');

            if (field && errorElement) {
                field.classList.add('form-control--error');
                errorElement.textContent = message;
                errorElement.classList.add('show');
            }
        }

        isValidUrl(string) {
            try {
                new URL(string);
                return true;
            } catch (_) {
                return false;
            }
        }

        isValidPhone(phone) {
            const phoneRegex = /^[+]?[0-9\s\-()]{10,}$/;
            return phoneRegex.test(phone);
        }

        toggleShapes() {
            const shapes = document.querySelectorAll(
                '.hero-image--shape1, .hero-image--shape2, .hero-image--shape3');
            shapes.forEach(shape => {
                shape.style.display = shape.style.display === 'none' ? 'block' : 'none';
            });
        }

        toggleAnimations() {
            const heroSection = document.querySelector('.hero-section');
            if (heroSection) {
                heroSection.style.animationPlayState =
                    heroSection.style.animationPlayState === 'paused' ? 'running' : 'paused';
            }
        }
    }

    // Initialize the hero section manager
    document.addEventListener('DOMContentLoaded', () => {
        try {
            new HeroSectionManager();
        } catch (error) {
            console.error('Error initializing HeroSectionManager:', error);
        }
    });
</script>
