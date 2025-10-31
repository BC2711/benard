{{-- resources/views/components/admin/sidebar.blade.php --}}
@php
    $menu = [
        [
            'icon' => 'fa-tachometer-alt',
            'text' => 'Dashboard',
            'url' => route('admin.dashboard'),
            'permission' => 'view-dashboard',
        ],
        [
            'icon' => 'fa-home',
            'text' => 'Hero Section',
            'url' => route('admin.hero.index'),
            'permission' => 'edit-hero',
        ],
        ['icon' => 'fa-users', 'text' => 'About Us', 'url' => route('admin.about.index'), 'permission' => 'edit-about'],
        [
            'icon' => 'fa-handshake',
            'text' => 'Support',
            'url' => route('admin.support.index'),
            'permission' => 'edit-support',
        ],
        [
            'icon' => 'fa-calculator',
            'text' => 'Loan Calculator',
            'url' => route('admin.calculator.index'),
            'permission' => 'edit-calculator',
        ],
        ['icon' => 'fa-blog', 'text' => 'Blog', 'url' => route('admin.blog.index'), 'permission' => 'manage-blog'],
        ['icon' => 'fa-comments', 'text' => 'FAQ', 'url' => route('admin.faq.index'), 'permission' => 'edit-faq'],
        ['icon' => 'fa-cog', 'text' => 'Footer', 'url' => route('admin.footer.index'), 'permission' => 'edit-footer'],
        [
            'icon' => 'fa-users-cog',
            'text' => 'Users',
            'url' => route('admin.users.index'),
            'permission' => 'manage-users',
        ],
        ['icon' => 'fa-sign-out-alt', 'text' => 'Logout', 'url' => route('admin.logout'), 'method' => 'post'],
    ];
@endphp

<aside class="w-64 bg-primary-900 text-white min-h-screen flex flex-col shadow-2xl">
    <!-- Logo -->
    <div class="p-6 border-b border-primary-800">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 bg-accent-500 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                F
            </div>
            <div>
                <div class="text-xl font-black">FinExpert</div>
                <div class="text-xs text-accent-300">Admin Panel</div>
            </div>
        </div>
    </div>

    <!-- Menu -->
    <nav class="flex-1 p-4 space-y-1">
        @foreach ($menu as $item)
            @if (!isset($item['permission']) || auth()->user()->can($item['permission']))
                <a href="{{ $item['url'] }}"
                    class="{{ request()->routeIs(str_replace('admin.', 'admin.*', \Illuminate\Support\Str::before($item['url'], '.'))) ? 'bg-primary-800 text-white' : 'text-gray-300 hover:bg-primary-800 hover:text-white' }} 
                          flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ isset($item['method']) ? 'logout-form' : '' }}"
                    @if (isset($item['method'])) onclick="event.preventDefault(); document.getElementById('logout-form').submit();" @endif>
                    <i class="fas {{ $item['icon'] }} text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">{{ $item['text'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>

    <!-- User Info -->
    <div class="p-4 border-t border-primary-800">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-accent-500 rounded-full flex items-center justify-center text-white font-bold">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div>
                <div class="font-semibold">{{ auth()->user()->name }}</div>
                <div class="text-xs text-accent-300">{{ auth()->user()->email }}</div>
            </div>
        </div>
    </div>
</aside>

@if (isset($menu[array_key_last($menu)]['method']))
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
        @csrf
    </form>
@endif
