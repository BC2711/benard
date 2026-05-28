<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Londa Loans - Forgot Password</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logos/londa.jpg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/premium-ui.css') }}">

    <script src="{{ asset('assets/js/tailwind.js') }}"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif']
                    },

                    colors: {
                        brand: {
                            600: '#0e7490',
                            700: '#155e75',
                            900: '#083344'
                        },

                        gold: {
                            500: '#d99b2b'
                        }
                    },

                    boxShadow: {
                        lift: '0 30px 90px rgba(15, 23, 42, 0.18)'
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen overflow-x-hidden bg-slate-950 font-sans text-white antialiased">

    <main class="relative min-h-screen overflow-hidden lg:grid lg:grid-cols-[0.95fr_1.05fr]">

        <!-- LEFT SIDE -->
        <section
            class="relative hidden min-h-screen overflow-hidden lg:flex lg:flex-col lg:justify-between lg:p-8 xl:p-10">

            <!-- Background -->
            <div
                class="absolute inset-0 bg-[linear-gradient(135deg,rgba(14,116,144,0.92),rgba(15,118,110,0.78)),url('/assets/images/hero.png')] bg-cover bg-center">
            </div>

            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(217,155,43,0.35),transparent_32%)]">
            </div>

            <!-- Logo -->
            <div class="relative z-10">
                <div class="flex items-center gap-3">

                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-white shadow-lift">

                        <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans"
                            class="h-9 w-9 rounded-xl object-cover">

                    </span>

                    <div>
                        <p class="text-xl font-extrabold">
                            Londa Loans
                        </p>

                        <p class="text-sm text-cyan-50/80">
                            Administration System
                        </p>
                    </div>

                </div>
            </div>

            <!-- Content -->
            <div class="relative z-10 max-w-lg xl:max-w-xl">

                <span class="rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-bold backdrop-blur">

                    Secure account recovery

                </span>

                <h1 class="mt-6 text-3xl font-extrabold leading-tight tracking-tight xl:text-5xl">

                    Recover access to your admin workspace safely.

                </h1>

                <p class="mt-5 text-base leading-7 text-cyan-50/85 xl:text-lg xl:leading-8">

                    Enter your registered email address and we will send a secure
                    password reset link directly to your inbox.

                </p>

                <!-- Steps -->
                <div class="mt-6 space-y-3 xl:mt-8 xl:space-y-4">

                    <!-- Step 1 -->
                    <div class="rounded-2xl border border-white/15 bg-white/10 p-3 xl:p-4 backdrop-blur">

                        <div class="flex gap-4">

                            <span
                                class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-white/15 font-extrabold">

                                1

                            </span>

                            <div>
                                <p class="font-bold">
                                    Verify your email
                                </p>

                                <p class="mt-1 text-sm text-cyan-50/80">
                                    Use the email address linked to your admin account.
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="rounded-2xl border border-white/15 bg-white/10 p-3 xl:p-4 backdrop-blur">

                        <div class="flex gap-4">

                            <span
                                class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-white/15 font-extrabold">

                                2

                            </span>

                            <div>
                                <p class="font-bold">
                                    Check your inbox
                                </p>

                                <p class="mt-1 text-sm text-cyan-50/80">
                                    Open the secure reset link sent to your email.
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="rounded-2xl border border-white/15 bg-white/10 p-3 xl:p-4 backdrop-blur">

                        <div class="flex gap-4">

                            <span
                                class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-white/15 font-extrabold">

                                3

                            </span>

                            <div>
                                <p class="font-bold">
                                    Create a new password
                                </p>

                                <p class="mt-1 text-sm text-cyan-50/80">
                                    Set a strong new password and continue securely.
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- RIGHT SIDE -->
        <section
            class="relative flex min-h-screen items-center justify-center bg-slate-50 px-4 py-5 text-slate-950 sm:px-6 lg:px-8 xl:px-10">

            <!-- Grid Background -->
            <div
                class="absolute inset-0 bg-[linear-gradient(rgba(15,23,42,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(15,23,42,0.04)_1px,transparent_1px)] bg-[size:44px_44px]">
            </div>

            <div class="relative w-full max-w-lg">

                <!-- Mobile Logo -->
                <div class="mb-8 flex items-center gap-3 lg:hidden">

                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-700 shadow-lift">

                        <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans"
                            class="h-9 w-9 rounded-xl object-cover">

                    </span>

                    <div>
                        <p class="text-xl font-extrabold">
                            Londa Loans
                        </p>

                        <p class="text-sm text-slate-500">
                            Administration System
                        </p>
                    </div>

                </div>

                <!-- Card -->
                <div
                    class="w-full rounded-3xl border border-white bg-white/95 p-5 shadow-lift backdrop-blur sm:p-7 lg:p-8">

                    <!-- Back -->
                    <a href="{{ route('login') }}"
                        class="mb-6 inline-flex items-center gap-2 text-sm font-bold text-brand-700 transition hover:text-brand-600">

                        <i class="fas fa-arrow-left"></i>

                        Back to login

                    </a>

                    @if (session('status'))

                        <!-- Success State -->
                        <div class="text-center">

                            <div
                                class="mx-auto grid h-20 w-20 place-items-center rounded-full bg-emerald-50 text-3xl text-emerald-600">

                                <i class="fas fa-check"></i>

                            </div>

                            <h2 class="mt-6 text-3xl font-extrabold tracking-tight">
                                Check your email
                            </h2>

                            <p class="mt-3 text-sm leading-6 text-slate-500">

                                We have sent a secure password reset link to

                                <strong class="text-slate-800">
                                    {{ session('email') ?? 'your email address' }}
                                </strong>

                                . The link will expire in 30 minutes.

                            </p>

                            <a href="{{ route('management.login') }}"
                                class="mt-6 flex h-12 w-full items-center justify-center gap-2 rounded-2xl bg-brand-700 px-4 font-bold text-white shadow-lift transition hover:-translate-y-0.5 hover:bg-brand-600">

                                <i class="fas fa-arrow-right-to-bracket"></i>

                                Return to login

                            </a>

                            <p class="mt-6 border-t border-slate-200 pt-5 text-sm text-slate-500">

                                Did not receive the email?

                                <a href="/contact" class="font-bold text-brand-700 hover:text-brand-600">

                                    Contact support

                                </a>

                            </p>

                        </div>
                    @else
                        <!-- Header -->
                        <div>

                            <p class="text-sm font-bold uppercase tracking-wider text-brand-700">

                                Password recovery

                            </p>

                            <h2 class="mt-2 text-2xl font-extrabold tracking-tight sm:text-3xl">

                                Forgot password?

                            </h2>

                            <p class="mt-2 text-sm leading-6 text-slate-500">

                                Enter your admin email address and we will send
                                you a secure password reset link.

                            </p>

                        </div>

                        <!-- Errors -->
                        <div class="mt-6 space-y-3">

                            @if ($errors->any())

                                <div class="rounded-2xl border border-red-200 bg-red-50 p-3 text-sm text-red-700">

                                    <ul class="list-inside list-disc">

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach

                                    </ul>

                                </div>

                            @endif

                        </div>

                        <!-- Form -->
                        <form class="mt-5 space-y-4" action="{{ route('management.password.email') }}" method="POST"
                            x-data="{ loading: false }" @submit="loading = true">

                            @csrf

                            <!-- Email -->
                            <div>

                                <label for="email" class="mb-2 block text-sm font-bold text-slate-700">

                                    Email address

                                </label>

                                <div class="relative">

                                    <i
                                        class="fas fa-envelope pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                                        required autofocus class="admin-input h-12 w-full pl-11 pr-4"
                                        placeholder="you@londaloans.com">

                                </div>

                                @error('email')
                                    <p class="mt-2 text-sm font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            <!-- Button -->
                            <button type="submit"
                                class="flex h-12 w-full items-center justify-center gap-2 rounded-2xl bg-brand-700 px-4 font-bold text-white shadow-lift transition hover:-translate-y-0.5 hover:bg-brand-600 disabled:cursor-not-allowed disabled:opacity-60"
                                :disabled="loading">

                                <i class="fas" :class="loading ? 'fa-spinner fa-spin' : 'fa-paper-plane'"></i>

                                <span x-show="!loading">
                                    Send reset link
                                </span>

                                <span x-show="loading">
                                    Sending link...
                                </span>

                            </button>

                            <!-- Divider -->
                            <div class="relative py-2 text-center">

                                <div class="absolute inset-x-0 top-1/2 h-px bg-slate-200"></div>

                                <span
                                    class="relative bg-white px-3 text-xs font-bold uppercase tracking-wider text-slate-400">

                                    Need help?

                                </span>

                            </div>

                            <!-- Support -->
                            <div
                                class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-center text-sm text-slate-500">

                                Cannot access your email?

                                <a href="/contact" class="font-bold text-brand-700 hover:text-brand-600">

                                    Contact support

                                </a>

                            </div>

                        </form>

                    @endif

                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>

</html>
