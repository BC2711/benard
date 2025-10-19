<script>
    // Global utility functions for Londa Loans Admin
    window.LondaUtils = {
        // Date and Time utilities
        DateUtils: {
            // Format date in various formats
            formatDate(date, format = 'medium') {
                const dateObj = new Date(date);
                const formats = {
                    short: {
                        dateStyle: 'short'
                    },
                    medium: {
                        dateStyle: 'medium'
                    },
                    long: {
                        dateStyle: 'long'
                    },
                    full: {
                        dateStyle: 'full'
                    },
                    relative: {}
                };

                if (format === 'relative') {
                    return this.getRelativeTime(dateObj);
                }

                return dateObj.toLocaleDateString('en-US', formats[format] || formats.medium);
            },

            // Get relative time (e.g., "2 hours ago")
            getRelativeTime(date) {
                const now = new Date();
                const diffInSeconds = Math.floor((now - date) / 1000);

                const intervals = {
                    year: 31536000,
                    month: 2592000,
                    week: 604800,
                    day: 86400,
                    hour: 3600,
                    minute: 60,
                    second: 1
                };

                for (const [unit, seconds] of Object.entries(intervals)) {
                    const interval = Math.floor(diffInSeconds / seconds);
                    if (interval >= 1) {
                        return interval === 1 ? `1 ${unit} ago` : `${interval} ${unit}s ago`;
                    }
                }

                return 'Just now';
            },

            // Format time
            formatTime(date, showSeconds = false) {
                return new Date(date).toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: showSeconds ? '2-digit' : undefined
                });
            },

            // Add days to date
            addDays(date, days) {
                const result = new Date(date);
                result.setDate(result.getDate() + days);
                return result;
            },

            // Check if date is today
            isToday(date) {
                const today = new Date();
                return new Date(date).toDateString() === today.toDateString();
            },

            // Get start of day
            startOfDay(date) {
                const result = new Date(date);
                result.setHours(0, 0, 0, 0);
                return result;
            },

            // Get end of day
            endOfDay(date) {
                const result = new Date(date);
                result.setHours(23, 59, 59, 999);
                return result;
            }
        },

        // Currency utilities
        CurrencyUtils: {
            // Format currency
            format(amount, currency = 'ZMW', locale = 'en-ZM') {
                return new Intl.NumberFormat(locale, {
                    style: 'currency',
                    currency: currency
                }).format(amount);
            },

            // Format without currency symbol
            formatNumber(amount, locale = 'en-ZM') {
                return new Intl.NumberFormat(locale).format(amount);
            },

            // Parse currency string to number
            parse(currencyString) {
                return parseFloat(currencyString.replace(/[^\d.-]/g, ''));
            },

            // Calculate percentage
            calculatePercentage(part, total) {
                if (total === 0) return 0;
                return (part / total) * 100;
            },

            // Format percentage
            formatPercentage(value, decimals = 1) {
                return `${value.toFixed(decimals)}%`;
            }
        },

        // String utilities
        StringUtils: {
            // Capitalize first letter
            capitalize(str) {
                return str.charAt(0).toUpperCase() + str.slice(1);
            },

            // Title case
            titleCase(str) {
                return str.replace(/\w\S*/g, txt =>
                    txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()
                );
            },

            // Truncate text
            truncate(str, length = 50, suffix = '...') {
                if (str.length <= length) return str;
                return str.substr(0, length - suffix.length) + suffix;
            },

            // Generate random string
            randomString(length = 8) {
                const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let result = '';
                for (let i = 0; i < length; i++) {
                    result += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                return result;
            },

            // Slugify string
            slugify(str) {
                return str
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
        },

        // Array utilities
        ArrayUtils: {
            // Remove duplicates
            unique(arr) {
                return [...new Set(arr)];
            },

            // Group by property
            groupBy(arr, key) {
                return arr.reduce((groups, item) => {
                    const group = item[key];
                    groups[group] = groups[group] || [];
                    groups[group].push(item);
                    return groups;
                }, {});
            },

            // Sort by property
            sortBy(arr, key, order = 'asc') {
                return [...arr].sort((a, b) => {
                    const aVal = a[key];
                    const bVal = b[key];

                    if (order === 'desc') {
                        return aVal < bVal ? 1 : aVal > bVal ? -1 : 0;
                    }

                    return aVal > bVal ? 1 : aVal < bVal ? -1 : 0;
                });
            },

            // Chunk array
            chunk(arr, size) {
                const chunks = [];
                for (let i = 0; i < arr.length; i += size) {
                    chunks.push(arr.slice(i, i + size));
                }
                return chunks;
            },

            // Flatten array
            flatten(arr) {
                return arr.reduce((flat, next) =>
                    flat.concat(Array.isArray(next) ? this.flatten(next) : next), []);
            }
        },

        // Object utilities
        ObjectUtils: {
            // Deep clone object
            clone(obj) {
                return JSON.parse(JSON.stringify(obj));
            },

            // Merge objects
            merge(target, ...sources) {
                sources.forEach(source => {
                    for (const key in source) {
                        if (source[key] && typeof source[key] === 'object' && !Array.isArray(source[key])) {
                            target[key] = this.merge(target[key] || {}, source[key]);
                        } else {
                            target[key] = source[key];
                        }
                    }
                });
                return target;
            },

            // Pick properties from object
            pick(obj, keys) {
                return keys.reduce((result, key) => {
                    if (obj.hasOwnProperty(key)) {
                        result[key] = obj[key];
                    }
                    return result;
                }, {});
            },

            // Omit properties from object
            omit(obj, keys) {
                const result = {
                    ...obj
                };
                keys.forEach(key => delete result[key]);
                return result;
            }
        },

        // Form utilities
        FormUtils: {
            // Serialize form data
            serialize(form) {
                const formData = new FormData(form);
                const data = {};
                for (const [key, value] of formData.entries()) {
                    data[key] = value;
                }
                return data;
            },

            // Validate email
            validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            },

            // Validate phone number
            validatePhone(phone) {
                const re = /^[+]?[0-9\s\-()]{10,}$/;
                return re.test(phone);
            },

            // Validate URL
            validateURL(url) {
                try {
                    new URL(url);
                    return true;
                } catch {
                    return false;
                }
            },

            // Show form errors
            showErrors(form, errors) {
                this.clearErrors(form);

                Object.entries(errors).forEach(([field, messages]) => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('border-red-300', 'bg-red-50');
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'text-red-600 text-sm mt-1';
                        errorDiv.textContent = messages[0];
                        input.parentNode.appendChild(errorDiv);
                    }
                });
            },

            // Clear form errors
            clearErrors(form) {
                form.querySelectorAll('.border-red-300').forEach(el => {
                    el.classList.remove('border-red-300', 'bg-red-50');
                });
                form.querySelectorAll('.text-red-600').forEach(el => el.remove());
            }
        },

        // Storage utilities
        StorageUtils: {
            // Set item with expiration
            set(key, value, expirationMinutes = null) {
                const item = {
                    value,
                    timestamp: expirationMinutes ? Date.now() + (expirationMinutes * 60 * 1000) : null
                };
                localStorage.setItem(key, JSON.stringify(item));
            },

            // Get item with expiration check
            get(key) {
                const itemStr = localStorage.getItem(key);
                if (!itemStr) return null;

                const item = JSON.parse(itemStr);
                if (item.timestamp && Date.now() > item.timestamp) {
                    localStorage.removeItem(key);
                    return null;
                }

                return item.value;
            },

            // Remove item
            remove(key) {
                localStorage.removeItem(key);
            },

            // Clear all storage
            clear() {
                localStorage.clear();
            }
        },

        // API utilities
        ApiUtils: {
            // Make API request
            async request(url, options = {}) {
                const config = {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    ...options
                };

                try {
                    const response = await fetch(url, config);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    return {
                        success: true,
                        data
                    };
                } catch (error) {
                    console.error('API request failed:', error);
                    return {
                        success: false,
                        error: error.message
                    };
                }
            },

            // GET request
            async get(url) {
                return this.request(url);
            },

            // POST request
            async post(url, data) {
                return this.request(url, {
                    method: 'POST',
                    body: JSON.stringify(data)
                });
            },

            // PUT request
            async put(url, data) {
                return this.request(url, {
                    method: 'PUT',
                    body: JSON.stringify(data)
                });
            },

            // DELETE request
            async delete(url) {
                return this.request(url, {
                    method: 'DELETE'
                });
            }
        },

        // UI utilities
        UiUtils: {
            // Debounce function
            debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            },

            // Throttle function
            throttle(func, limit) {
                let inThrottle;
                return function(...args) {
                    if (!inThrottle) {
                        func.apply(this, args);
                        inThrottle = true;
                        setTimeout(() => inThrottle = false, limit);
                    }
                };
            },

            // Copy to clipboard
            async copyToClipboard(text) {
                try {
                    await navigator.clipboard.writeText(text);
                    return true;
                } catch (err) {
                    console.error('Failed to copy text: ', err);
                    return false;
                }
            },

            // Download file
            downloadFile(content, filename, contentType = 'text/plain') {
                const blob = new Blob([content], {
                    type: contentType
                });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.download = filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
            },

            // Scroll to element
            scrollTo(element, behavior = 'smooth') {
                element.scrollIntoView({
                    behavior
                });
            },

            // Toggle element visibility
            toggleVisibility(element) {
                const isHidden = element.style.display === 'none';
                element.style.display = isHidden ? 'block' : 'none';
                return !isHidden;
            }
        },

        // Validation utilities
        ValidationUtils: {
            // Required field
            required(value) {
                return value !== null && value !== undefined && value !== '';
            },

            // Min length
            minLength(value, min) {
                return value.length >= min;
            },

            // Max length
            maxLength(value, max) {
                return value.length <= max;
            },

            // Between
            between(value, min, max) {
                return value >= min && value <= max;
            },

            // Pattern match
            matches(value, pattern) {
                return pattern.test(value);
            }
        },

        // Initialize all utilities
        init() {
            console.log('Londa Utilities initialized');
        }
    };

    // Initialize utilities when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        window.LondaUtils.init();
    });

    // Make utilities available globally
    if (typeof window.LondaAdmin === 'undefined') {
        window.LondaAdmin = {};
    }

    window.LondaAdmin.utils = window.LondaUtils;
</script>
