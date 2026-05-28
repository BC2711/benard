@extends('layouts.admin.main')

@section('title', 'Settings')
@section('page-title', 'System Settings')
@section('page-description', 'Configure company defaults, notifications, security posture, integrations, and loan rules.')
@section('page-icon')
    <i class="fas fa-sliders"></i>
@endsection
@section('page-actions')
    <button class="inline-flex h-11 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-600 shadow-sm dark:border-slate-800 dark:bg-slate-900"><i class="fas fa-rotate-left"></i>Reset</button>
    <button class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-4 text-sm font-bold text-white shadow-soft"><i class="fas fa-save"></i>Save</button>
@endsection

@section('content')
    <section class="grid grid-cols-1 gap-6 xl:grid-cols-[20rem_1fr]">
        <aside class="admin-card p-3">
            @foreach ([['General','fa-sliders'],['Loan rules','fa-hand-holding-dollar'],['Notifications','fa-bell'],['Security','fa-shield-halved'],['Integrations','fa-plug'],['Data management','fa-database']] as $item)
                <a href="#" class="admin-menu-item {{ $loop->first ? 'bg-brand-50 text-brand-700 dark:bg-cyan-400/10 dark:text-cyan-200' : '' }}">
                    <i class="fas {{ $item[1] }}"></i>{{ $item[0] }}
                </a>
            @endforeach
        </aside>

        <div class="space-y-6">
            <form class="admin-card p-5">
                <h2 class="text-lg font-bold">General settings</h2>
                <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">
                    <label class="block">
                        <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Company name</span>
                        <input class="admin-input h-11 w-full px-4" value="Londa Loans">
                    </label>
                    <label class="block">
                        <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Support email</span>
                        <input class="admin-input h-11 w-full px-4" value="support@londaloans.com">
                    </label>
                    <label class="block md:col-span-2">
                        <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Company address</span>
                        <textarea class="admin-input min-h-24 w-full px-4 py-3">Lusaka, Zambia</textarea>
                    </label>
                </div>
                <div class="mt-5 flex items-center justify-between rounded-2xl bg-slate-50 p-4 dark:bg-slate-900">
                    <div>
                        <p class="font-bold">Maintenance mode</p>
                        <p class="text-sm text-slate-500">Temporarily disable public application access.</p>
                    </div>
                    <button type="button" class="h-7 w-12 rounded-full bg-slate-300 p-1" role="switch" aria-checked="false">
                        <span class="block h-5 w-5 rounded-full bg-white shadow"></span>
                    </button>
                </div>
            </form>

            <form class="admin-card p-5">
                <h2 class="text-lg font-bold">Loan configuration</h2>
                <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-3">
                    <label>
                        <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Minimum amount</span>
                        <input type="number" class="admin-input h-11 w-full px-4" value="5000">
                    </label>
                    <label>
                        <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Maximum amount</span>
                        <input type="number" class="admin-input h-11 w-full px-4" value="500000">
                    </label>
                    <label>
                        <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Default rate</span>
                        <input type="number" step="0.1" class="admin-input h-11 w-full px-4" value="8.5">
                    </label>
                </div>
                <div class="mt-5 flex items-center justify-between rounded-2xl bg-brand-50 p-4 dark:bg-cyan-400/5">
                    <div>
                        <p class="font-bold">Auto approval</p>
                        <p class="text-sm text-slate-500">Automatically approve requests that match configured policy.</p>
                    </div>
                    <button type="button" class="h-7 w-12 rounded-full bg-brand-700 p-1" role="switch" aria-checked="true">
                        <span class="ml-auto block h-5 w-5 rounded-full bg-white shadow"></span>
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
