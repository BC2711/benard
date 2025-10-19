<script>
    window.sidebarManager = {
        // State
        collapsed: localStorage.getItem('sidebarCollapsed') === 'true',
        userMenuOpen: false,
        activeSubmenu: null,
        searchQuery: '',
        isResizing: false,

        // Computed
        get filteredMenuItems() {
            if (!this.searchQuery) return [];
            // Search implementation
            return this.menuItems.filter(item =>
                item.name.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },

        // Methods
        init() {
            this.setupResizeHandler();
        },

        setupResizeHandler() {
            const resizeHandle = document.querySelector('[data-resize-handle="true"]');
            if (resizeHandle) {
                resizeHandle.addEventListener('mousedown', (e) => this.startResize(e));
            }
        },

        startResize(e) {
            this.isResizing = true;
            document.addEventListener('mousemove', this.handleResize.bind(this));
            document.addEventListener('mouseup', this.stopResize.bind(this));
            e.preventDefault();
        },

        handleResize(e) {
            if (!this.isResizing) return;
            const newWidth = Math.max(200, Math.min(400, e.clientX - this.$el.getBoundingClientRect().left));
            this.$el.style.width = `${newWidth}px`;
        },

        stopResize() {
            this.isResizing = false;
            document.removeEventListener('mousemove', this.handleResize.bind(this));
            document.removeEventListener('mouseup', this.stopResize.bind(this));
        },

        toggleCollapsed() {
            this.collapsed = !this.collapsed;
            localStorage.setItem('sidebarCollapsed', this.collapsed);
        }
    };

    // Initialize sidebar when Alpine is ready
    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebarManager', () => window.sidebarManager);
    });
</script>
