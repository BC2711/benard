<style>
    :root {
        --primary-color: #db9123;
        --secondary-color: #7a4603;
        --accent-color: #f59e0b;
        --success-color: #10b981;
        --error-color: #ef4444;
        --warning-color: #f59e0b;
        --info-color: #3b82f6;
        --white: #ffffff;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-800: #1f2937;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15);
        --shadow-xl: 0 20px 50px rgba(0, 0, 0, 0.2);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --border-radius: 12px;
        --border-radius-lg: 16px;
    }

    /* Hero Preview Container */
    .hero-preview-container {
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-xl);
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
    }

    .hero-section {
        color: var(--white);
        padding: clamp(2rem, 4vw, 4rem) 0;
        position: relative;
        overflow: hidden;
        isolation: isolate;
        min-height: 600px;
        display: flex;
        align-items: center;
    }

    /* Add all the hero section styles from your original code */
    /* ... (copy all the hero section CSS from your original code) ... */

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            min-height: 400px;
            padding: 1.5rem 0;
        }

        .hero-images {
            width: 100%;
            height: 40%;
            opacity: 0.3;
        }

        .hero-cta {
            flex-direction: column;
            align-items: flex-start;
            gap: 1.5rem;
        }

        .trust-indicators {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
    }
</style>
