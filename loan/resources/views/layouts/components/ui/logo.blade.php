@props([
    'collapsed' => false,
])

<div
    class="w-12 h-12 bg-gradient-to-br from-londa-orange to-orange-600 rounded-xl flex items-center justify-center shadow-lg group relative">
    <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans Logo"
        class="w-8 h-8 rounded object-cover transition-transform duration-300 group-hover:scale-110" loading="lazy">
    <div
        class="absolute inset-0 bg-londa-orange rounded-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300">
    </div>
</div>

<div class="flex-1 min-w-0 transition-all duration-300"
    :class="{ 'opacity-0 w-0 hidden': {{ $collapsed ? 'true' : 'false' }} }">
    <h1 class="text-xl font-bold text-gray-900 dark:text-white truncate">
        Londa<span class="text-green-600 dark:text-green-400">Loans</span>
    </h1>
    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 font-medium animate-pulse-soft">
        Ma Loans Yama Londa!
    </p>
</div>
