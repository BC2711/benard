<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Londa Loans - Admin Login</title>
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
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                    colors: { brand: { 600: '#0e7490', 700: '#155e75', 900: '#083344' }, gold: { 500: '#d99b2b' } },
                    boxShadow: { lift: '0 30px 90px rgba(15, 23, 42, 0.18)' }
                }
            }
        }
    </script>
</head>

<body class="min-h-full bg-slate-950 font-sans text-white antialiased">
    <main class="relative grid min-h-screen overflow-hidden lg:grid-cols-[1.05fr_0.95fr]">
        <section class="relative hidden p-10 lg:flex lg:flex-col lg:justify-between">
            <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(14,116,144,0.92),rgba(15,118,110,0.78)),url('/assets/images/hero.png')] bg-cover bg-center"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(217,155,43,0.35),transparent_32%)]"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-white shadow-lift">
                        <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans" class="h-9 w-9 rounded-xl object-cover">
                    </span>
                    <div>
                        <p class="text-xl font-extrabold">Londa Loans</p>
                        <p class="text-sm text-cyan-50/80">Administration System</p>
                    </div>
                </div>
            </div>
            <div class="relative z-10 max-w-xl">
                <span class="rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-bold backdrop-blur">Secure enterprise access</span>
                <h1 class="mt-6 text-5xl font-extrabold tracking-tight">Run approvals, users, content, and reports from one premium workspace.</h1>
                <div class="mt-8 grid grid-cols-3 gap-3">
                    <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                        <p class="text-2xl font-extrabold">24/7</p>
                        <p class="mt-1 text-sm text-cyan-50/80">Monitoring</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                        <p class="text-2xl font-extrabold">RBAC</p>
                        <p class="mt-1 text-sm text-cyan-50/80">Access control</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                        <p class="text-2xl font-extrabold">Live</p>
                        <p class="mt-1 text-sm text-cyan-50/80">Analytics</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative grid place-items-center bg-slate-50 px-4 py-10 text-slate-950 sm:px-6 lg:px-10">
            <div class="absolute inset-0 bg-[linear-gradient(rgba(15,23,42,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(15,23,42,0.04)_1px,transparent_1px)] bg-[size:44px_44px]"></div>
            <div class="relative w-full max-w-md">
                <div class="mb-8 flex items-center gap-3 lg:hidden">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-700 shadow-lift">
                        <img src="{{ asset('assets/logos/londa.jpg') }}" alt="Londa Loans" class="h-9 w-9 rounded-xl object-cover">
                    </span>
                    <div>
                        <p class="text-xl font-extrabold">Londa Loans</p>
                        <p class="text-sm text-slate-500">Administration System</p>
                    </div>
                </div>

                <div class="rounded-3xl border border-white bg-white/90 p-6 shadow-lift backdrop-blur sm:p-8">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-brand-700">Welcome back</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight">Sign in to admin</h2>
                        <p class="mt-2 text-sm text-slate-500">Use your management credentials to continue.</p>
                    </div>

                    <div class="mt-6 space-y-3">
                        @foreach (['success', 'error', 'info', 'attempts_warning', 'account_locked'] as $key)
                            @if (session($key))
                                <div class="rounded-2xl border p-3 text-sm font-semibold {{ in_array($key, ['error', 'account_locked']) ? 'border-red-200 bg-red-50 text-red-700' : (in_array($key, ['info', 'attempts_warning']) ? 'border-amber-200 bg-amber-50 text-amber-700' : 'border-emerald-200 bg-emerald-50 text-emerald-700') }}">
                                    {{ session($key) }}
                                </div>
                            @endif
                        @endforeach

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

                    <form class="mt-6 space-y-5" action="{{ route('login') }}" method="POST" x-data="{ showPassword: false, loading: false }"
                        @submit="loading = true">
                        @csrf
                        <div>
                            <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Email address</label>
                            <div class="relative">
                                <i class="fas fa-envelope pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                                    @if (session('account_locked')) disabled @endif
                                    class="admin-input h-12 w-full pl-11 pr-4" placeholder="you@londaloans.com">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-bold text-slate-700">Password</label>
                            <div class="relative">
                                <i class="fas fa-lock pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required
                                    @if (session('account_locked')) disabled @endif
                                    class="admin-input h-12 w-full pl-11 pr-12" placeholder="Enter your password">
                                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-lg p-2 text-slate-400 hover:text-brand-700"
                                    @click="showPassword = !showPassword" aria-label="Toggle password visibility">
                                    <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <label class="flex items-center gap-2 text-sm font-semibold text-slate-600">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                    class="rounded border-slate-300 text-brand-700 focus:ring-brand-600">
                                Remember me
                            </label>
                            <a href="{{ route('management.password.request') }}" class="text-sm font-bold text-brand-700 hover:text-brand-600">
                                Forgot password?
                            </a>
                        </div>

                        <button type="submit"
                            class="flex h-12 w-full items-center justify-center gap-2 rounded-2xl bg-brand-700 px-4 font-bold text-white shadow-lift transition hover:-translate-y-0.5 hover:bg-brand-600 disabled:cursor-not-allowed disabled:opacity-60"
                            :disabled="loading" @if (session('account_locked')) disabled @endif>
                            <i class="fas" :class="loading ? 'fa-spinner fa-spin' : 'fa-arrow-right-to-bracket'"></i>
                            <span x-show="!loading">{{ session('account_locked') ? 'Account locked' : 'Sign in securely' }}</span>
                            <span x-show="loading">Signing in...</span>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
