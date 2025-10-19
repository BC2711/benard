<script>
    window.NotificationManager = {
        // Default configuration
        config: {
            position: 'top-right',
            duration: 5000,
            maxNotifications: 5,
            closeOnClick: true
        },

        // Initialize notification system
        init() {
            this.createContainer();
            this.setupServiceWorker();
            this.setupAutoDismiss();
        },

        // Create notification container if it doesn't exist
        createContainer() {
            if (!document.getElementById('notification-container')) {
                const container = document.createElement('div');
                container.id = 'notification-container';
                container.className = `fixed z-50 space-y-3 w-80 sm:w-96 ${this.getPositionClass()}`;
                container.setAttribute('aria-live', 'polite');
                container.setAttribute('aria-atomic', 'true');
                document.body.appendChild(container);
            }
            return document.getElementById('notification-container');
        },

        // Get CSS class for notification position
        getPositionClass() {
            const positions = {
                'top-right': 'top-4 right-4',
                'top-left': 'top-4 left-4',
                'top-center': 'top-4 left-1/2 transform -translate-x-1/2',
                'bottom-right': 'bottom-4 right-4',
                'bottom-left': 'bottom-4 left-4',
                'bottom-center': 'bottom-4 left-1/2 transform -translate-x-1/2'
            };
            return positions[this.config.position] || positions['top-right'];
        },

        // Show a notification
        show(options) {
            const container = this.createContainer();
            const id = 'notification-' + Date.now();

            // Limit number of notifications
            if (container.children.length >= this.config.maxNotifications) {
                this.removeOldestNotification();
            }

            const notification = document.createElement('div');
            notification.innerHTML = this.generateNotificationHTML(id, options);
            container.appendChild(notification.firstElementChild);

            // Auto-dismiss if duration is set
            if (options.duration > 0) {
                setTimeout(() => this.dismiss(id), options.duration);
            }

            // Play sound for important notifications
            if (options.sound) {
                this.playSound(options.sound);
            }

            // Trigger event
            this.triggerEvent('notification:show', {
                id,
                options
            });

            return id;
        },

        // Generate notification HTML
        generateNotificationHTML(id, options) {
            const styles = this.getNotificationStyles(options.type);

            return `
                <div id="${id}" 
                     class="notification animate-fade-in w-full ${styles.bg} ${styles.border} rounded-lg shadow-lg border-l-4 ${styles.border} p-4 transition-all duration-300 transform hover:scale-105 cursor-pointer"
                     role="alert"
                     data-duration="${options.duration || this.config.duration}"
                     ${this.config.closeOnClick ? `onclick="NotificationManager.dismiss('${id}')"` : ''}>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas ${styles.icon} ${styles.iconColor} text-lg"></i>
                        </div>
                        
                        <div class="ml-3 flex-1">
                            ${options.title ? `<p class="text-sm font-medium ${styles.titleColor}">${options.title}</p>` : ''}
                            <p class="mt-1 text-sm ${styles.textColor}">${options.message}</p>
                            
                            ${options.actions ? this.generateActionsHTML(options.actions) : ''}
                        </div>
                        
                        <button type="button"
                                class="ml-4 flex-shrink-0 ${styles.textColor} hover:opacity-70 focus:outline-none focus:ring-2 focus:ring-current rounded"
                                onclick="NotificationManager.dismiss('${id}')"
                                aria-label="Dismiss notification">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    ${options.duration > 0 ? this.generateProgressBar(id, options.duration) : ''}
                </div>
            `;
        },

        // Get styles for notification type
        getNotificationStyles(type = 'info') {
            const styles = {
                success: {
                    bg: 'bg-green-50 dark:bg-green-900/20',
                    border: 'border-green-200 dark:border-green-800',
                    icon: 'fa-check-circle',
                    iconColor: 'text-green-400',
                    titleColor: 'text-green-800 dark:text-green-300',
                    textColor: 'text-green-700 dark:text-green-400'
                },
                error: {
                    bg: 'bg-red-50 dark:bg-red-900/20',
                    border: 'border-red-200 dark:border-red-800',
                    icon: 'fa-exclamation-circle',
                    iconColor: 'text-red-400',
                    titleColor: 'text-red-800 dark:text-red-300',
                    textColor: 'text-red-700 dark:text-red-400'
                },
                warning: {
                    bg: 'bg-yellow-50 dark:bg-yellow-900/20',
                    border: 'border-yellow-200 dark:border-yellow-800',
                    icon: 'fa-exclamation-triangle',
                    iconColor: 'text-yellow-400',
                    titleColor: 'text-yellow-800 dark:text-yellow-300',
                    textColor: 'text-yellow-700 dark:text-yellow-400'
                },
                info: {
                    bg: 'bg-blue-50 dark:bg-blue-900/20',
                    border: 'border-blue-200 dark:border-blue-800',
                    icon: 'fa-info-circle',
                    iconColor: 'text-blue-400',
                    titleColor: 'text-blue-800 dark:text-blue-300',
                    textColor: 'text-blue-700 dark:text-blue-400'
                }
            };

            return styles[type] || styles.info;
        },

        // Generate actions HTML
        generateActionsHTML(actions) {
            return `
                <div class="mt-3 flex space-x-2">
                    ${actions.map(action => `
                        <button type="button"
                                class="text-xs font-medium px-3 py-1 rounded border transition-colors duration-200
                                       ${action.primary ? 
                                           'bg-londa-orange text-white border-londa-orange hover:bg-orange-600' : 
                                           'bg-transparent text-current border-current hover:bg-current hover:text-white'
                                       }"
                                onclick="${action.onclick}">
                            ${action.label}
                        </button>
                    `).join('')}
                </div>
            `;
        },

        // Generate progress bar
        generateProgressBar(id, duration) {
            return `
                <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1">
                    <div class="h-1 rounded-full bg-current transition-all duration-100 ease-linear"
                         style="animation: progress ${duration}ms linear forwards;"
                         id="${id}-progress"></div>
                </div>
                
                <style>
                    @keyframes progress {
                        from { width: 100%; }
                        to { width: 0%; }
                    }
                </style>
            `;
        },

        // Dismiss a notification
        dismiss(id) {
            const notification = document.getElementById(id);
            if (notification) {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';

                setTimeout(() => {
                    notification.remove();
                    this.triggerEvent('notification:dismiss', {
                        id
                    });
                }, 300);
            }
        },

        // Remove oldest notification
        removeOldestNotification() {
            const container = document.getElementById('notification-container');
            if (container && container.firstChild) {
                container.firstChild.remove();
            }
        },

        // Clear all notifications
        clearAll() {
            const container = document.getElementById('notification-container');
            if (container) {
                container.innerHTML = '';
            }
        },

        // Quick methods for common notification types
        success(message, title = 'Success!', duration = this.config.duration) {
            return this.show({
                title,
                message,
                type: 'success',
                duration
            });
        },

        error(message, title = 'Error!', duration = 0) {
            return this.show({
                title,
                message,
                type: 'error',
                duration
            });
        },

        warning(message, title = 'Warning!', duration = this.config.duration) {
            return this.show({
                title,
                message,
                type: 'warning',
                duration
            });
        },

        info(message, title = 'Information', duration = this.config.duration) {
            return this.show({
                title,
                message,
                type: 'info',
                duration
            });
        },

        // Play notification sound
        playSound(sound) {
            // Implementation for playing sounds
            // This would typically use the Web Audio API
            console.log(`Playing sound: ${sound}`);
        },

        // Setup service worker for push notifications
        async setupServiceWorker() {
            if ('serviceWorker' in navigator && 'PushManager' in window) {
                try {
                    const registration = await navigator.serviceWorker.register('/sw.js');
                    console.log('Service Worker registered');

                    // Request permission for push notifications
                    const permission = await Notification.requestPermission();
                    if (permission === 'granted') {
                        console.log('Push notifications granted');
                    }
                } catch (error) {
                    console.log('Service Worker registration failed:', error);
                }
            }
        },

        // Setup auto-dismiss for existing notifications
        setupAutoDismiss() {
            document.addEventListener('DOMContentLoaded', () => {
                // Auto-dismiss flash messages
                document.querySelectorAll('.flash-message').forEach(message => {
                    const timeout = message.dataset.timeout || 5000;
                    setTimeout(() => {
                        message.style.opacity = '0';
                        setTimeout(() => message.remove(), 300);
                    }, timeout);
                });
            });
        },

        // Trigger custom events
        triggerEvent(name, detail) {
            const event = new CustomEvent(name, {
                detail
            });
            document.dispatchEvent(event);
        },

        // Update configuration
        updateConfig(newConfig) {
            this.config = {
                ...this.config,
                ...newConfig
            };
        }
    };

    // Initialize notification manager
    document.addEventListener('DOMContentLoaded', () => {
        window.NotificationManager.init();
    });

    // Global error handler for notifications
    window.addEventListener('error', (e) => {
        if (window.NotificationManager) {
            window.NotificationManager.error('An unexpected error occurred');
        }
    });
</script>
