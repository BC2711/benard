{{-- Flash Notification Container --}}
@props(['position' => 'top-right'])

@php
    $positions = [
        'top-right' => 'top-4 right-4',
        'top-left' => 'top-4 left-4',
        'top-center' => 'top-4 left-1/2 transform -translate-x-1/2',
        'bottom-right' => 'bottom-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        'bottom-center' => 'bottom-4 left-1/2 transform -translate-x-1/2',
    ];
@endphp

<div id="notification-container"
    {{ $attributes->merge(['class' => 'fixed z-50 space-y-3 w-80 sm:w-96 ' . $positions[$position]]) }}
    aria-live="polite" aria-atomic="true">
    {{-- {{ $slot }} --}}
</div>

{{-- Flash Message --}}
@props([
    'type' => 'info',
    'title' => null,
    'message' => null,
    'dismissible' => true,
    'timeout' => 5000,
    'id' => null,
])

@php
    $id = $id ?? uniqid('notification-');

    $styles = [
        'success' => [
            'bg' => 'bg-green-50 dark:bg-green-900/20',
            'border' => 'border-green-200 dark:border-green-800',
            'icon' => 'fa-check-circle',
            'iconColor' => 'text-green-400',
            'titleColor' => 'text-green-800 dark:text-green-300',
            'textColor' => 'text-green-700 dark:text-green-400',
        ],
        'error' => [
            'bg' => 'bg-red-50 dark:bg-red-900/20',
            'border' => 'border-red-200 dark:border-red-800',
            'icon' => 'fa-exclamation-circle',
            'iconColor' => 'text-red-400',
            'titleColor' => 'text-red-800 dark:text-red-300',
            'textColor' => 'text-red-700 dark:text-red-400',
        ],
        'warning' => [
            'bg' => 'bg-yellow-50 dark:bg-yellow-900/20',
            'border' => 'border-yellow-200 dark:border-yellow-800',
            'icon' => 'fa-exclamation-triangle',
            'iconColor' => 'text-yellow-400',
            'titleColor' => 'text-yellow-800 dark:text-yellow-300',
            'textColor' => 'text-yellow-700 dark:text-yellow-400',
        ],
        'info' => [
            'bg' => 'bg-blue-50 dark:bg-blue-900/20',
            'border' => 'border-blue-200 dark:border-blue-800',
            'icon' => 'fa-info-circle',
            'iconColor' => 'text-blue-400',
            'titleColor' => 'text-blue-800 dark:text-blue-300',
            'textColor' => 'text-blue-700 dark:text-blue-400',
        ],
    ];

    $style = $styles[$type] ?? $styles['info'];
@endphp

<div id="{{ $id }}"
    class="notification animate-fade-in w-full {{ $style['bg'] }} {{ $style['border'] }} rounded-lg shadow-lg border-l-4 {{ $style['border'] }} p-4 transition-all duration-300 transform hover:scale-105"
    role="alert" data-timeout="{{ $timeout }}" {{ $attributes }}>
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <i class="fas {{ $style['icon'] }} {{ $style['iconColor'] }} text-lg"></i>
        </div>

        <div class="ml-3 flex-1">
            @if ($title)
                <p class="text-sm font-medium {{ $style['titleColor'] }}">
                    {{ $title }}
                </p>
            @endif

            @if ($message)
                <p class="mt-1 text-sm {{ $style['textColor'] }}">
                    {{ $message }}
                </p>
            @else
                <div class="mt-1 text-sm {{ $style['textColor'] }}">
                    {{-- {{ $slot }} --}}
                </div>
            @endif
        </div>

        @if ($dismissible)
            <div class="ml-4 flex-shrink-0">
                <button type="button"
                    class="inline-flex {{ $style['textColor'] }} hover:opacity-70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-current rounded"
                    onclick="window.NotificationManager.dismiss('{{ $id }}')"
                    aria-label="Dismiss notification">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    </div>

    @if ($timeout > 0)
        <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1">
            <div class="h-1 rounded-full {{ $style['bg'] }} transition-all duration-100 ease-linear"
                id="{{ $id }}-progress"></div>
        </div>
    @endif
</div>

{{-- Toast Notification --}}
@props([
    'type' => 'info',
    'message' => null,
    'icon' => null,
])

@php
    $toastStyles = [
        'success' => 'bg-green-500 text-white',
        'error' => 'bg-red-500 text-white',
        'warning' => 'bg-yellow-500 text-white',
        'info' => 'bg-blue-500 text-white',
    ];

    $toastIcon =
        $icon ??
        [
            'success' => 'fa-check-circle',
            'error' => 'fa-exclamation-circle',
            'warning' => 'fa-exclamation-triangle',
            'info' => 'fa-info-circle',
        ][$type];
@endphp

<div
    class="toast animate-bounce-in max-w-sm {{ $toastStyles[$type] }} rounded-lg shadow-lg p-3 flex items-center space-x-3">
    @if ($toastIcon)
        <i class="fas {{ $toastIcon }}"></i>
    @endif

    <span class="text-sm font-medium flex-1">{{ $message ?? ''
    // $slot 
    }}</span>

    <button type="button" class="flex-shrink-0 text-white hover:opacity-70 focus:outline-none"
        onclick="this.parentElement.remove()" aria-label="Dismiss toast">
        <i class="fas fa-times text-sm"></i>
    </button>
</div>

{{-- Inline Alert --}}
@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => true,
])

@php
    $alertStyles = [
        'success' => [
            'bg' => 'bg-green-50 dark:bg-green-900/20',
            'border' => 'border-green-200 dark:border-green-800',
            'text' => 'text-green-800 dark:text-green-300',
        ],
        'error' => [
            'bg' => 'bg-red-50 dark:bg-red-900/20',
            'border' => 'border-red-200 dark:border-red-800',
            'text' => 'text-red-800 dark:text-red-300',
        ],
        'warning' => [
            'bg' => 'bg-yellow-50 dark:bg-yellow-900/20',
            'border' => 'border-yellow-200 dark:border-yellow-800',
            'text' => 'text-yellow-800 dark:text-yellow-300',
        ],
        'info' => [
            'bg' => 'bg-blue-50 dark:bg-blue-900/20',
            'border' => 'border-blue-200 dark:border-blue-800',
            'text' => 'text-blue-800 dark:text-blue-300',
        ],
    ];

    $style = $alertStyles[$type] ?? $alertStyles['info'];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-lg border ' . $style['bg'] . ' ' . $style['border'] . ' ' . $style['text'] . ' p-4']) }}
    role="alert">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            @if ($title)
                <p class="font-medium">{{ $title }}</p>
            @endif
            <div class="{{ $title ? 'ml-2' : '' }}">
                {{-- {{ $slot }} --}}
            </div>
        </div>

        @if ($dismissible)
            <button type="button" class="flex-shrink-0 hover:opacity-70 focus:outline-none"
                onclick="this.parentElement.parentElement.remove()" aria-label="Dismiss alert">
                <i class="fas fa-times"></i>
            </button>
        @endif
    </div>
</div>

{{-- Notification Manager Script --}}
<script>
    window.NotificationManager = {
        // Show a new notification
        show(options) {
            const container = document.getElementById('notification-container') || this.createContainer();
            const id = 'notification-' + Date.now();

            const notification = document.createElement('div');
            notification.innerHTML = `
                <div id="${id}" class="notification animate-fade-in w-full ${options.bg} ${options.border} rounded-lg shadow-lg border-l-4 ${options.border} p-4 transition-all duration-300">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas ${options.icon} ${options.iconColor} text-lg"></i>
                        </div>
                        <div class="ml-3 flex-1">
                            ${options.title ? `<p class="text-sm font-medium ${options.titleColor}">${options.title}</p>` : ''}
                            <p class="mt-1 text-sm ${options.textColor}">${options.message}</p>
                        </div>
                        <button type="button" class="ml-4 flex-shrink-0 ${options.textColor} hover:opacity-70" onclick="NotificationManager.dismiss('${id}')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;

            container.appendChild(notification.firstElementChild);

            if (options.timeout > 0) {
                setTimeout(() => this.dismiss(id), options.timeout);
            }

            return id;
        },

        // Create notification container if it doesn't exist
        createContainer() {
            const container = document.createElement('div');
            container.id = 'notification-container';
            container.className = 'fixed z-50 space-y-3 w-80 sm:w-96 top-4 right-4';
            container.setAttribute('aria-live', 'polite');
            container.setAttribute('aria-atomic', 'true');
            document.body.appendChild(container);
            return container;
        },

        // Dismiss a notification
        dismiss(id) {
            const notification = document.getElementById(id);
            if (notification) {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 300);
            }
        },

        // Quick methods for common notification types
        success(message, title = 'Success!', timeout = 5000) {
            return this.show({
                title,
                message,
                bg: 'bg-green-50 dark:bg-green-900/20',
                border: 'border-green-200 dark:border-green-800',
                icon: 'fa-check-circle',
                iconColor: 'text-green-400',
                titleColor: 'text-green-800 dark:text-green-300',
                textColor: 'text-green-700 dark:text-green-400',
                timeout
            });
        },

        error(message, title = 'Error!', timeout = 0) {
            return this.show({
                title,
                message,
                bg: 'bg-red-50 dark:bg-red-900/20',
                border: 'border-red-200 dark:border-red-800',
                icon: 'fa-exclamation-circle',
                iconColor: 'text-red-400',
                titleColor: 'text-red-800 dark:text-red-300',
                textColor: 'text-red-700 dark:text-red-400',
                timeout
            });
        },

        warning(message, title = 'Warning!', timeout = 5000) {
            return this.show({
                title,
                message,
                bg: 'bg-yellow-50 dark:bg-yellow-900/20',
                border: 'border-yellow-200 dark:border-yellow-800',
                icon: 'fa-exclamation-triangle',
                iconColor: 'text-yellow-400',
                titleColor: 'text-yellow-800 dark:text-yellow-300',
                textColor: 'text-yellow-700 dark:text-yellow-400',
                timeout
            });
        },

        info(message, title = 'Information', timeout = 5000) {
            return this.show({
                title,
                message,
                bg: 'bg-blue-50 dark:bg-blue-900/20',
                border: 'border-blue-200 dark:border-blue-800',
                icon: 'fa-info-circle',
                iconColor: 'text-blue-400',
                titleColor: 'text-blue-800 dark:text-blue-300',
                textColor: 'text-blue-700 dark:text-blue-400',
                timeout
            });
        },

        // Initialize auto-dismiss for existing notifications
        init() {
            // Auto-dismiss flash messages
            document.querySelectorAll('.flash-message').forEach(message => {
                const timeout = message.dataset.timeout || 5000;
                setTimeout(() => {
                    message.style.opacity = '0';
                    setTimeout(() => message.remove(), 300);
                }, timeout);
            });

            // Auto-dismiss notifications with timeout
            document.querySelectorAll('.notification[data-timeout]').forEach(notification => {
                const timeout = parseInt(notification.dataset.timeout);
                if (timeout > 0) {
                    setTimeout(() => this.dismiss(notification.id), timeout);
                }
            });
        }
    };

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        window.NotificationManager.init();
    });
</script>

{{-- Usage Examples (commented out for reference) --}}
{{--
<!-- Flash Notification -->
<x-ui.notification type="success" title="Success!" message="Your changes have been saved successfully." />

<!-- Toast -->
<x-ui.toast type="success" message="Operation completed successfully" />

<!-- Inline Alert -->
<x-ui.alert type="warning" title="Heads up!" dismissible>
    This is a warning message that can be dismissed.
</x-ui.alert>

<!-- Using Notification Manager in JavaScript -->
<script>
    // Show success notification
    NotificationManager.success('Your changes have been saved!');
    
    // Show error notification that doesn't auto-dismiss
    NotificationManager.error('Something went wrong!');
    
    // Show custom notification
    NotificationManager.show({
        title: 'Custom Notification',
        message: 'This is a custom notification',
        type: 'info',
        timeout: 3000
    });
</script>
--}}
