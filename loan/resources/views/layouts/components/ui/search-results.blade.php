<div class="px-3 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
    Search Results
</div>

<div class="space-y-1">
    <template x-for="item in filteredMenuItems" :key="item.id">
        <a :href="item.url"
            class="nav-item flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-londa-50 dark:hover:bg-gray-700 hover:text-londa-orange dark:hover:text-londa-300 transition-all duration-200 ease-in-out group">
            <i class="fas fa-search w-5 text-center text-gray-400 group-hover:text-londa-orange transition-colors duration-200"
                aria-hidden="true"></i>
            <span class="ml-3 font-medium text-sm" x-text="item.name"></span>
        </a>
    </template>

    <div x-show="filteredMenuItems.length === 0" class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400 text-center">
        No results found
    </div>
</div>
