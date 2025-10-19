@props([
    'placeholder' => 'Search customers, loans, reports...',
    'shortcut' => 'K',
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'py-2 text-sm',
        'md' => 'py-2.5 text-sm',
        'lg' => 'py-3 text-base',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div class="relative flex-1 max-w-2xl" x-data="globalSearch">
    <div class="relative">
        <!-- Search Icon -->
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none" aria-hidden="true">
            <i class="fas fa-search text-gray-400 text-sm" :class="{ 'text-londa-orange': searchOpen }"></i>
        </div>

        <!-- Search Input -->
        <input type="text" x-model="searchQuery" @focus="searchOpen = true" @input.debounce.300ms="performSearch"
            class="w-full pl-10 pr-12 {{ $sizeClass }} bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-londa-orange focus:border-londa-orange dark:focus:ring-londa-400 dark:focus:border-londa-400 transition-all duration-200 placeholder-gray-500 dark:placeholder-gray-400"
            placeholder="{{ $placeholder }}" aria-label="Global search" aria-haspopup="true"
            :aria-expanded="searchOpen">

        <!-- Keyboard Shortcut -->
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
            <kbd
                class="hidden sm:inline-flex items-center px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 font-mono">
                ⌘{{ $shortcut }}
            </kbd>
        </div>
    </div>

    <!-- Search Results Dropdown -->
    <div x-show="searchOpen && searchQuery.length > 0" @click.away="searchOpen = false"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-2xl z-50 max-h-96 overflow-y-auto custom-scrollbar"
        x-cloak>

        <!-- Recent Searches -->
        <template x-if="searchQuery.length < 2">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                    <i class="fas fa-clock mr-2 text-gray-400"></i>
                    Recent Searches
                </h3>
                <div class="space-y-2">
                    <template x-for="recent in recentSearches" :key="recent.id">
                        <button @click="selectRecent(recent)"
                            class="flex items-center w-full text-left p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-sm text-gray-600 dark:text-gray-400">
                            <i class="fas fa-search mr-3 text-gray-400"></i>
                            <span x-text="recent.query"></span>
                        </button>
                    </template>
                </div>
            </div>
        </template>

        <!-- Search Results -->
        <template x-if="searchQuery.length >= 2">
            <div>
                <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                            Search Results
                        </h3>
                        <span class="text-xs text-gray-500 dark:text-gray-400"
                            x-text="`${filteredResults.length} results`"></span>
                    </div>
                </div>

                <div class="max-h-80 overflow-y-auto">
                    <template x-for="item in filteredResults" :key="item.id">
                        <a :href="item.url"
                            class="flex items-center p-4 hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700 last:border-b-0 group transition-colors duration-150">
                            <div
                                class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-londa-orange to-orange-500 flex items-center justify-center text-white mr-4">
                                <i class="fas text-sm" :class="item.icon"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-londa-orange transition-colors"
                                    x-text="item.title"></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="item.description"></p>
                            </div>
                            <div class="flex-shrink-0 ml-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                    :class="item.type === 'Customer' ?
                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : item
                                        .type === 'Loan' ?
                                        'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' :
                                        'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300'"
                                    x-text="item.type"></span>
                            </div>
                        </a>
                    </template>

                    <div x-show="filteredResults.length === 0 && !isLoading" class="p-8 text-center">
                        <i class="fas fa-search text-gray-300 dark:text-gray-600 text-3xl mb-3"></i>
                        <p class="text-sm text-gray-500 dark:text-gray-400">No results found for "<span
                                x-text="searchQuery" class="font-medium"></span>"</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Try different keywords or check your
                            spelling</p>
                    </div>
                </div>
            </div>
        </template>

        <!-- Quick Actions -->
        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-b-xl">
            <div class="flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400">Quick Actions</span>
                <div class="flex space-x-2">
                    <kbd class="px-1.5 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs">↑↓</kbd>
                    <span class="text-gray-400">to navigate</span>
                    <kbd class="px-1.5 py-1 border border-gray-300 dark:border-gray-600 rounded text-xs">↵</kbd>
                    <span class="text-gray-400">to select</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('globalSearch', () => ({
            searchOpen: false,
            searchQuery: '',
            searchResults: [],
            recentSearches: [],
            isLoading: false,

            init() {
                this.loadRecentSearches();

                // Keyboard shortcut
                document.addEventListener('keydown', (e) => {
                    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                        e.preventDefault();
                        this.searchOpen = true;
                        this.$el.querySelector('input').focus();
                    }
                });
            },

            get filteredResults() {
                if (!this.searchQuery) return [];
                return this.searchResults.filter(item =>
                    item.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.description.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            },

            async performSearch() {
                if (this.searchQuery.length < 2) return;

                this.isLoading = true;

                try {
                    // Simulate API call - replace with actual endpoint
                    await new Promise(resolve => setTimeout(resolve, 300));

                    // Mock data - replace with actual API response
                    this.searchResults = [{
                            id: 1,
                            title: 'John Doe',
                            description: 'Customer - Loan Application Pending',
                            type: 'Customer',
                            icon: 'fa-user',
                            url: '/customers/1'
                        },
                        {
                            id: 2,
                            title: 'Business Expansion Loan',
                            description: 'Loan Application - $50,000',
                            type: 'Loan',
                            icon: 'fa-file-invoice-dollar',
                            url: '/loans/123'
                        }
                    ];
                } catch (error) {
                    console.error('Search failed:', error);
                } finally {
                    this.isLoading = false;
                }
            },

            loadRecentSearches() {
                const recent = localStorage.getItem('recentSearches');
                this.recentSearches = recent ? JSON.parse(recent) : [{
                        id: 1,
                        query: 'John Doe - Loan Application'
                    },
                    {
                        id: 2,
                        query: 'Business Loans Report'
                    }
                ];
            },

            selectRecent(recent) {
                this.searchQuery = recent.query;
                this.searchOpen = true;
                this.performSearch();
            }
        }));
    });
</script>
