<script>
    window.HeaderManager = {
        // State
        currentPage: 'Dashboard',
        searchOpen: false,
        notificationsOpen: false,
        messagesOpen: false,
        userMenuOpen: false,
        quickActionsOpen: false,

        // Initialize header functionality
        init() {
            this.updateCurrentPage();
            this.setupKeyboardShortcuts();
            this.setupClickOutside();
            this.setupResizeHandler();
        },

        // Update current page title from DOM
        updateCurrentPage() {
            const pageTitle = document.querySelector('h1')?.textContent || 'Dashboard';
            this.currentPage = pageTitle.trim();

            // Update Alpine.js state if available
            if (window.Alpine && document.querySelector('[x-data]')) {
                Alpine.$data(document.querySelector('[x-data]')).currentPage = this.currentPage;
            }
        },

        // Keyboard shortcuts
        setupKeyboardShortcuts() {
            document.addEventListener('keydown', (e) => {
                // Cmd/Ctrl + K for search
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    this.toggleSearch();
                }

                // Cmd/Ctrl + / for help
                if ((e.ctrlKey || e.metaKey) && e.key === '/') {
                    e.preventDefault();
                    this.showKeyboardShortcuts();
                }

                // Escape key to close all dropdowns
                if (e.key === 'Escape') {
                    this.closeAllDropdowns();
                }
            });
        },

        // Close dropdowns when clicking outside
        setupClickOutside() {
            document.addEventListener('click', (e) => {
                if (!e.target.closest('[x-data]')) {
                    this.closeAllDropdowns();
                }
            });
        },

        // Handle window resize
        setupResizeHandler() {
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    if (window.innerWidth >= 1024) {
                        this.closeAllDropdowns();
                    }
                }, 250);
            });
        },

        // Toggle search
        toggleSearch() {
            this.searchOpen = !this.searchOpen;
            if (this.searchOpen) {
                const searchInput = document.querySelector('input[type="text"]');
                searchInput?.focus();
                this.closeOtherDropdowns('search');
            }
        },

        // Toggle notifications
        toggleNotifications() {
            this.notificationsOpen = !this.notificationsOpen;
            if (this.notificationsOpen) {
                this.closeOtherDropdowns('notifications');
                this.markNotificationsAsRead();
            }
        },

        // Toggle messages
        toggleMessages() {
            this.messagesOpen = !this.messagesOpen;
            if (this.messagesOpen) {
                this.closeOtherDropdowns('messages');
                this.markMessagesAsRead();
            }
        },

        // Toggle user menu
        toggleUserMenu() {
            this.userMenuOpen = !this.userMenuOpen;
            if (this.userMenuOpen) {
                this.closeOtherDropdowns('userMenu');
            }
        },

        // Toggle quick actions
        toggleQuickActions() {
            this.quickActionsOpen = !this.quickActionsOpen;
            if (this.quickActionsOpen) {
                this.closeOtherDropdowns('quickActions');
            }
        },

        // Close all dropdowns except specified one
        closeOtherDropdowns(except) {
            const dropdowns = {
                search: 'searchOpen',
                notifications: 'notificationsOpen',
                messages: 'messagesOpen',
                userMenu: 'userMenuOpen',
                quickActions: 'quickActionsOpen'
            };

            Object.entries(dropdowns).forEach(([key, property]) => {
                if (key !== except) {
                    this[property] = false;
                }
            });
        },

        // Close all dropdowns
        closeAllDropdowns() {
            this.searchOpen = false;
            this.notificationsOpen = false;
            this.messagesOpen = false;
            this.userMenuOpen = false;
            this.quickActionsOpen = false;
        },

        // Mark notifications as read
        markNotificationsAsRead() {
            // Implementation would call API to mark notifications as read
            console.log('Marking notifications as read');
        },

        // Mark messages as read
        markMessagesAsRead() {
            // Implementation would call API to mark messages as read
            console.log('Marking messages as read');
        },

        // Show keyboard shortcuts help
        showKeyboardShortcuts() {
            const shortcuts = [{
                    key: '⌘K',
                    action: 'Focus search'
                },
                {
                    key: '⌘/',
                    action: 'Show shortcuts'
                },
                {
                    key: 'Esc',
                    action: 'Close modals/dropdowns'
                },
                {
                    key: '⌘B',
                    action: 'Toggle sidebar'
                },
                {
                    key: '⌘P',
                    action: 'Print current page'
                }
            ];

            // Create a modal or use browser alert for simplicity
            const message = shortcuts.map(s => `${s.key} - ${s.action}`).join('\n');
            alert('Keyboard Shortcuts:\n\n' + message);
        },

        // Update notification count
        updateNotificationCount(count) {
            this.notificationCount = count;
            // Update any badge elements
            const badge = document.querySelector('[aria-describedby="notifications-count"]');
            if (badge) {
                badge.textContent = count;
            }
        },

        // Update message count
        updateMessageCount(count) {
            this.messageCount = count;
            // Update any badge elements
            const badge = document.querySelector('[aria-describedby="messages-count"]');
            if (badge) {
                badge.textContent = count;
            }
        },

        // Show notification
        showNotification(message, type = 'info') {
            if (window.NotificationManager) {
                window.NotificationManager[type]?.(message);
            } else {
                console.log(`[${type.toUpperCase()}] ${message}`);
            }
        }
    };

    // Initialize header manager when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        window.HeaderManager.init();
    });

    // Alpine.js integration
    document.addEventListener('alpine:init', () => {
        Alpine.data('headerManager', () => ({
            ...window.HeaderManager,

            init() {
                this.$watch('currentPage', (value) => {
                    document.title = `${value} - Londa Loans Admin`;
                });
            }
        }));
    });
</script>
