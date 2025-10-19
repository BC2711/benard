@props([
    'count' => 0,
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
        'lg' => 'w-12 h-12 text-lg',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div class="relative" x-data="notifications">
    <button @click="toggleNotifications()"
        class="{{ $sizeClass }} text-gray-500 hover:text-londa-orange dark:text-gray-400 dark:hover:text-londa-300 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 p-2 rounded-lg transition-all duration-200 relative group"
        aria-label="View notifications" :aria-expanded="notificationsOpen" aria-describedby="notifications-count">

        <i class="fas fa-bell"></i>

        <!-- Notification Count Badge -->
        <span x-show="unreadCount > 0"
            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium shadow-lg animate-pulse"
            x-text="unreadCount" id="notifications-count"></span>

        <!-- Hover Dot -->
        <div class="absolute -top-1 -right-1 w-2 h-2 bg-londa-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"
            x-show="unreadCount === 0"></div>
    </button>

    <!-- Notifications Dropdown -->
    <div x-show="notificationsOpen" @click.away="notificationsOpen = false"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-80 sm:w-96 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 py-2 z-50 max-h-96 overflow-y-auto custom-scrollbar"
        x-cloak>

        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Notifications</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400" x-text="`${unreadCount} unread`"></span>
                    <button @click="markAllAsRead()"
                        class="text-xs text-londa-orange hover:text-orange-700 font-medium">
                        Mark all as read
                    </button>
                </div>
            </div>
        </div>

        <!-- Notification Items -->
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
            <template x-for="notification in notifications" :key="notification.id">
                <a :href="notification.url"
                    class="flex items-start px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 group"
                    :class="{ 'bg-blue-50 dark:bg-blue-900/20': notification.unread }">
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-2 h-2 rounded-full animate-pulse"
                            :class="{
                                'bg-blue-500': notification.type === 'info',
                                'bg-green-500': notification.type === 'success',
                                'bg-yellow-500': notification.type === 'warning',
                                'bg-red-500': notification.type === 'error'
                            }">
                        </div>
                    </div>
                    <div class="ml-3 flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-londa-orange transition-colors"
                            x-text="notification.title"></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="notification.message"></p>
                        <div class="flex items-center mt-2 space-x-2">
                            <span class="text-xs text-gray-400 dark:text-gray-500" x-text="notification.time"></span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium"
                                :class="{
                                    'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300': notification
                                        .type === 'info',
                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': notification
                                        .type === 'success',
                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300': notification
                                        .type === 'warning',
                                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': notification
                                        .type === 'error'
                                }"
                                x-text="notification.type"></span>
                        </div>
                    </div>
                    <button @click.stop="markAsRead(notification.id)"
                        class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </a>
            </template>
        </div>

        <div
            class="px-4 py-3 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-b-xl">
            <a href="{{ route('management.dashboard') }}"
                class="block text-center text-sm font-medium text-londa-orange hover:text-orange-700 dark:hover:text-orange-300 transition-colors duration-200">
                View all notifications
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('notifications', () => ({
            notificationsOpen: false,
            unreadCount: {{ $count }},
            notifications: [],

            init() {
                this.loadNotifications();
                this.setupRealTimeUpdates();
            },

            toggleNotifications() {
                this.notificationsOpen = !this.notificationsOpen;
                if (this.notificationsOpen) {
                    this.markAllAsRead();
                }
            },

            async loadNotifications() {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 200));

                this.notifications = [{
                        id: 1,
                        title: 'New Loan Application',
                        message: 'John Smith submitted a loan application for $25,000',
                        type: 'info',
                        time: '2 minutes ago',
                        unread: true,
                        url: '/loans/456'
                    },
                    {
                        id: 2,
                        title: 'Payment Received',
                        message: 'Payment of $1,200 received from Sarah Johnson',
                        type: 'success',
                        time: '1 hour ago',
                        unread: true,
                        url: '/payments/789'
                    }
                ];

                this.updateUnreadCount();
            },

            markAsRead(notificationId) {
                const notification = this.notifications.find(n => n.id === notificationId);
                if (notification && notification.unread) {
                    notification.unread = false;
                    this.updateUnreadCount();
                }
            },

            markAllAsRead() {
                this.notifications.forEach(notification => {
                    notification.unread = false;
                });
                this.updateUnreadCount();
            },

            updateUnreadCount() {
                this.unreadCount = this.notifications.filter(n => n.unread).length;
            },

            setupRealTimeUpdates() {
                // Simulate real-time notifications
                setInterval(() => {
                    if (Math.random() > 0.8) { // 20% chance every 30 seconds
                        this.addNewNotification();
                    }
                }, 30000);
            },

            addNewNotification() {
                const newNotification = {
                    id: Date.now(),
                    title: 'System Update',
                    message: 'New features available in the latest update',
                    type: 'info',
                    time: 'Just now',
                    unread: true,
                    url: '/updates'
                };

                this.notifications.unshift(newNotification);
                this.updateUnreadCount();

                // Show toast notification
                if (window.NotificationManager) {
                    window.NotificationManager.info(newNotification.message, newNotification.title);
                }
            }
        }));
    });
</script>
