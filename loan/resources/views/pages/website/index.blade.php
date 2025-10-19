<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Default Title' }}</title>
    <!-- Laravel Asset Helper for static files -->
    <script defer src="{{ asset('assets/js/tailwind.js') }}"></script>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

    <!-- Include Alpine.js for x-data functionality -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body x-data="{
    page: 'home',
    darkMode: true,
    stickyMenu: false,
    navigationOpen: false,
    scrollTop: false,
    isNavOpen: false,
    billPlan: 'monthly',
    plans: {{ json_encode($plans ?? []) }}
}" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'b eh': darkMode === true }">

    <!-- Header -->
    @include('layouts.website.header')

    <main>
        <!-- Hero -->
        @include('layouts.website.hero')

        <!-- About -->
        @include('layouts.website.about')

        <!-- Small Features -->
        @include('layouts.website.smallfeatures')

        <!-- Services -->
        @include('layouts.website.service')

        <!-- Pricing Table -->
        @include('layouts.website.price')

        <!-- Team -->
        @include('layouts.website.team')

        <!-- Projects -->
        @include('layouts.website.project')

        <!-- Testimonials -->
        @include('layouts.website.testimonials')

        <!-- Counter -->
        @include('layouts.website.counter')

        <!-- Clients -->
        @include('layouts.website.client')

        <!-- Blog -->
        @include('layouts.website.blog')

        <!-- Contact -->
        @include('layouts.website.contact')

        <!-- CTA -->
        @include('layouts.website.cta')
    </main>

    <!-- Footer -->
    @include('layouts.website.footer')

    <script defer src="{{ asset('assets/js/bundle.js') }}"></script>
</body>

</html>
