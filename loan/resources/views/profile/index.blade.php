@extends('layouts.admin.main')

@section('title', 'User Management')
@section('page-title', 'User Management')
@section('page-description', 'Manage administrators, managers, access status, and profile records.')
@section('page-icon')
    <i class="fas fa-users-gear"></i>
@endsection
@section('breadcrumbs')
    <nav class="flex items-center gap-2" aria-label="Breadcrumb">
        <a href="{{ route('management.dashboard.index') }}" class="hover:text-brand-700 dark:hover:text-cyan-300">Admin</a>
        <i class="fas fa-chevron-right text-[10px]"></i>
        <span>User Management</span>
    </nav>
@endsection
@section('page-actions')
    <button type="button"
        class="inline-flex h-11 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-600 shadow-sm transition hover:-translate-y-0.5 hover:border-brand-200 hover:text-brand-700 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300">
        <i class="fas fa-file-export"></i> Export
    </button>
    <a href="{{ route('management.users.create') }}"
        class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-4 text-sm font-bold text-white shadow-soft transition hover:-translate-y-0.5 hover:bg-brand-600">
        <i class="fas fa-plus"></i> Add User
    </a>
@endsection

@section('content')
    @php
        $summary = [
            ['label' => 'Total users', 'value' => $users->total(), 'icon' => 'fa-users', 'tone' => 'brand'],
            ['label' => 'Active', 'value' => $users->where('status', 'ACTIVE')->count(), 'icon' => 'fa-user-check', 'tone' => 'emerald'],
            ['label' => 'Inactive', 'value' => $users->where('status', 'INACTIVE')->count(), 'icon' => 'fa-user-clock', 'tone' => 'amber'],
            ['label' => 'Locked', 'value' => $users->whereNotNull('locked_at')->count(), 'icon' => 'fa-lock', 'tone' => 'rose'],
        ];
    @endphp

    <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($summary as $item)
            <article class="admin-card p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">{{ $item['label'] }}</p>
                        <p class="mt-2 text-3xl font-extrabold">{{ number_format($item['value']) }}</p>
                    </div>
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        <i class="fas {{ $item['icon'] }}"></i>
                    </span>
                </div>
            </article>
        @endforeach
    </section>

    <section class="admin-card overflow-hidden" x-data="{ selected: [], query: '', role: '', status: '' }">
        <div class="border-b border-slate-200 p-5 dark:border-slate-800">
            <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                <div>
                    <h2 class="text-lg font-bold">Directory</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Search, filter, sort, and act on user records.</p>
                </div>
                <div class="grid gap-3 sm:grid-cols-3">
                    <label class="relative">
                        <span class="sr-only">Search users</span>
                        <i class="fas fa-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400"></i>
                        <input type="search" x-model="query" class="admin-input h-11 w-full pl-9 pr-3 text-sm"
                            placeholder="Search users">
                    </label>
                    <select x-model="role" class="admin-input h-11 px-3 text-sm" aria-label="Filter by role">
                        <option value="">All roles</option>
                        <option value="ADMIN">Administrator</option>
                        <option value="MANAGER">Manager</option>
                        <option value="USER">User</option>
                    </select>
                    <select x-model="status" class="admin-input h-11 px-3 text-sm" aria-label="Filter by status">
                        <option value="">All statuses</option>
                        <option value="ACTIVE">Active</option>
                        <option value="INACTIVE">Inactive</option>
                        <option value="SUSPENDED">Suspended</option>
                    </select>
                </div>
            </div>

            <div x-show="selected.length" x-transition
                class="mt-4 flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-brand-100 bg-brand-50 p-3 text-sm dark:border-cyan-400/10 dark:bg-cyan-400/5">
                <span class="font-bold text-brand-700 dark:text-cyan-200" x-text="`${selected.length} selected`"></span>
                <div class="flex gap-2">
                    <button class="rounded-xl bg-white px-3 py-2 font-bold text-slate-600 shadow-sm dark:bg-slate-900 dark:text-slate-300">Bulk activate</button>
                    <button class="rounded-xl bg-white px-3 py-2 font-bold text-red-600 shadow-sm dark:bg-slate-900 dark:text-red-300">Delete selected</button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:bg-slate-900">
                    <tr>
                        <th class="w-12 px-5 py-4">
                            <input type="checkbox" class="rounded border-slate-300 text-brand-700 focus:ring-brand-600"
                                @change="selected = $event.target.checked ? [...document.querySelectorAll('[data-user-id]')].map(el => el.value) : []"
                                aria-label="Select all users">
                        </th>
                        <th class="px-5 py-4">
                            <button class="inline-flex items-center gap-2">User <i class="fas fa-sort text-slate-300"></i></button>
                        </th>
                        <th class="px-5 py-4">Role</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Verified</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($users as $user)
                        <tr class="transition hover:bg-brand-50/50 dark:hover:bg-cyan-400/5"
                            x-show="(!query || '{{ strtolower($user->first_name . ' ' . $user->last_name . ' ' . $user->email) }}'.includes(query.toLowerCase())) && (!role || role === '{{ $user->role }}') && (!status || status === '{{ $user->status }}')">
                            <td class="px-5 py-4">
                                <input type="checkbox" data-user-id value="{{ $user->id }}" x-model="selected"
                                    class="rounded border-slate-300 text-brand-700 focus:ring-brand-600"
                                    aria-label="Select {{ $user->first_name }} {{ $user->last_name }}">
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <img class="h-11 w-11 rounded-xl object-cover"
                                        src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->first_name . ' ' . $user->last_name) . '&color=155e75&background=ecfeff' }}"
                                        alt="{{ $user->first_name }} {{ $user->last_name }}">
                                    <div>
                                        <p class="font-bold text-slate-950 dark:text-white">{{ $user->first_name }} {{ $user->last_name }}</p>
                                        <p class="text-slate-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="rounded-full bg-violet-100 px-3 py-1 text-xs font-bold text-violet-700 dark:bg-violet-400/10 dark:text-violet-200">
                                    {{ ucfirst(strtolower($user->role)) }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <span class="rounded-full px-3 py-1 text-xs font-bold {{ $user->status === 'ACTIVE' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-400/10 dark:text-emerald-200' : ($user->status === 'SUSPENDED' ? 'bg-red-100 text-red-700 dark:bg-red-400/10 dark:text-red-200' : 'bg-amber-100 text-amber-700 dark:bg-amber-400/10 dark:text-amber-200') }}">
                                        {{ ucfirst(strtolower($user->status)) }}
                                    </span>
                                    @if ($user->locked_at)
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700 dark:bg-red-400/10 dark:text-red-200">Locked</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-4 text-slate-500">
                                {{ $user->email_verified_at ? $user->email_verified_at->format('M j, Y') : 'Pending' }}
                            </td>
                            <td class="px-5 py-4 text-right" x-data="{ open: false }">
                                <div class="relative inline-block text-left">
                                    <button type="button" class="admin-icon-btn h-10 w-10" @click="open = !open"
                                        aria-label="Open row actions for {{ $user->first_name }}">
                                        <i class="fas fa-ellipsis"></i>
                                    </button>
                                    <div x-show="open" x-transition @click.outside="open = false"
                                        class="absolute right-0 z-20 mt-2 w-48 rounded-2xl border border-slate-200 bg-white p-2 text-left shadow-lift dark:border-slate-800 dark:bg-slate-900">
                                        <a href="{{ route('management.users.show', $user) }}" class="admin-menu-item"><i class="fas fa-eye"></i>View</a>
                                        <a href="{{ route('management.users.edit', $user) }}" class="admin-menu-item"><i class="fas fa-pen"></i>Edit</a>
                                        <form action="{{ route('management.toggle-status', $user) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="admin-menu-item w-full">
                                                <i class="fas {{ $user->status === 'ACTIVE' ? 'fa-pause' : 'fa-play' }}"></i>
                                                {{ $user->status === 'ACTIVE' ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                        @if ($user->locked_at)
                                            <form action="{{ route('management.unlock', $user) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="admin-menu-item w-full"><i class="fas fa-unlock"></i>Unlock</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('management.users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="admin-menu-item w-full text-red-600 dark:text-red-300"
                                                onclick="AdminUI.confirmSubmit(this.form, 'Delete this user permanently?')">
                                                <i class="fas fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-800">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                                <p class="mt-4 font-bold">No users found</p>
                                <p class="mt-1 text-sm text-slate-500">Create your first administrator to get started.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="border-t border-slate-200 px-5 py-4 dark:border-slate-800">
                {{ $users->links() }}
            </div>
        @endif
    </section>
@endsection
