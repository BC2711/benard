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

<div class="relative" x-data="messages">
    <button @click="toggleMessages()"
        class="{{ $sizeClass }} text-gray-500 hover:text-londa-orange dark:text-gray-400 dark:hover:text-londa-300 focus:outline-none focus:ring-2 focus:ring-londa-orange focus:ring-offset-2 p-2 rounded-lg transition-all duration-200 relative group"
        aria-label="View messages" :aria-expanded="messagesOpen" aria-describedby="messages-count">

        <i class="fas fa-envelope"></i>

        <!-- Message Count Badge -->
        <span x-show="unreadCount > 0"
            class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium shadow-lg"
            x-text="unreadCount" id="messages-count"></span>

        <!-- Hover Dot -->
        <div class="absolute -top-1 -right-1 w-2 h-2 bg-londa-orange rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"
            x-show="unreadCount === 0"></div>
    </button>

    <!-- Messages Dropdown -->
    <div x-show="messagesOpen" @click.away="messagesOpen = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-80 sm:w-96 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 py-2 z-50 max-h-96 overflow-y-auto custom-scrollbar"
        x-cloak>

        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Messages</h3>
                <span class="text-sm text-gray-500 dark:text-gray-400" x-text="`${unreadCount} unread`"></span>
            </div>
        </div>

        <!-- Message Items -->
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
            <template x-for="message in messages" :key="message.id">
                <a :href="message.url"
                    class="flex items-start px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 group"
                    :class="{ 'bg-blue-50 dark:bg-blue-900/20': message.unread }">
                    <img class="w-8 h-8 rounded-full flex-shrink-0 ring-2 ring-white dark:ring-gray-800"
                        :src="message.avatar" :alt="message.name">
                    <div class="ml-3 flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-londa-orange transition-colors"
                                x-text="message.name"></p>
                            <span class="text-xs text-gray-400 dark:text-gray-500" x-text="message.time"></span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 truncate" x-text="message.preview"></p>
                    </div>
                </a>
            </template>
        </div>

        <div
            class="px-4 py-3 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-b-xl">
            <a href="{{ route('management.dashboard') }}"
                class="block text-center text-sm font-medium text-londa-orange hover:text-orange-700 dark:hover:text-orange-300 transition-colors duration-200">
                View all messages
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('messages', () => ({
            messagesOpen: false,
            unreadCount: {{ $count }},
            messages: [],

            init() {
                this.loadMessages();
            },

            toggleMessages() {
                this.messagesOpen = !this.messagesOpen;
                if (this.messagesOpen) {
                    this.markAllAsRead();
                }
            },

            async loadMessages() {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 200));

                this.messages = [{
                        id: 1,
                        name: 'Sarah Johnson',
                        avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                        preview: 'Hi, I wanted to follow up on my loan application...',
                        time: '10:24 AM',
                        unread: true,
                        url: '/messages/1'
                    },
                    {
                        id: 2,
                        name: 'Mike Chen',
                        avatar: 'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                        preview: 'Regarding the document requirements for...',
                        time: 'Yesterday',
                        unread: false,
                        url: '/messages/2'
                    }
                ];

                this.updateUnreadCount();
            },

            markAllAsRead() {
                this.messages.forEach(message => {
                    message.unread = false;
                });
                this.updateUnreadCount();
            },

            updateUnreadCount() {
                this.unreadCount = this.messages.filter(m => m.unread).length;
            }
        }));
    });
</script>
