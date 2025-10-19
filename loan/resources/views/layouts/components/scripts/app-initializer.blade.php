<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeApp();
    });

    function initializeApp() {
        // Hide loading screen
        setTimeout(() => {
            const loadingScreen = document.getElementById('loadingScreen');
            if (loadingScreen) {
                loadingScreen.style.opacity = '0';
                setTimeout(() => loadingScreen.remove(), 500);
            }
        }, 1000);

        // Initialize components
        initBackToTop();
        initFlashMessages();
        initPrintButtons();
        initKeyboardShortcuts();
        initPerformanceMonitor();
    }

    function initBackToTop() {
        const backToTop = document.getElementById('backToTop');
        if (backToTop) {
            window.addEventListener('scroll', () => {
                backToTop.classList.toggle('hidden', window.scrollY < 300);
            });
        }
    }

    function initFlashMessages() {
        const flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(message => {
            setTimeout(() => {
                message.style.opacity = '0';
                setTimeout(() => message.remove(), 300);
            }, 5000);
        });
    }

    function initPrintButtons() {
        document.querySelectorAll('[data-print]').forEach(button => {
            button.addEventListener('click', () => {
                window.print();
            });
        });
    }

    function initKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + K for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.getElementById('searchInput');
                if (searchInput) {
                    searchInput.focus();
                }
            }

            // Ctrl/Cmd + / for help
            if ((e.ctrlKey || e.metaKey) && e.key === '/') {
                e.preventDefault();
                showKeyboardShortcuts();
            }
        });
    }

    function initPerformanceMonitor() {
        if (window.performance) {
            const navTiming = performance.getEntriesByType('navigation')[0];
            if (navTiming) {
                const loadTime = navTiming.loadEventEnd - navTiming.navigationStart;
                if (loadTime > 3000) {
                    console.warn(`Page load time: ${loadTime}ms - Consider optimizing`);
                }
            }
        }
    }
</script>
