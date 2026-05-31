<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Login - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/premium-ui.css') }}">
</head>
<body class="premium-admin min-h-screen bg-slate-100">
    <main class="mx-auto flex min-h-screen max-w-md items-center px-5">
        <section class="w-full rounded-3xl bg-white p-8 shadow-xl">
            <h1 class="text-2xl font-bold text-slate-900">Verify your login</h1>
            <p class="mt-2 text-sm text-slate-500">Enter the six-digit code sent to your email address.</p>

            @if ($errors->any())
                <div class="mt-5 rounded-xl bg-red-50 p-3 text-sm text-red-700">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('management.two-factor.verify') }}" class="mt-6 space-y-4">
                @csrf
                <label class="block text-sm font-semibold text-slate-700" for="code">Verification code</label>
                <input id="code" name="code" inputmode="numeric" autocomplete="one-time-code" maxlength="6" required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-center text-2xl tracking-[0.45em]">
                <button class="w-full rounded-xl bg-cyan-800 px-4 py-3 font-bold text-white" type="submit">
                    Verify and continue
                </button>
            </form>
        </section>
    </main>
</body>
</html>
