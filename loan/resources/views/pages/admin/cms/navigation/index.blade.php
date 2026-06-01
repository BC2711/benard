@extends('layouts.admin.main')

@section('title', 'Website Navigation')
@section('page-title', 'Website Navigation')
@section('page-description', 'Create visible menu items, link pages, build dropdowns, and control ordering.')
@section('page-icon')<i class="fas fa-bars"></i>@endsection

@section('content')
    <section class="grid gap-6 xl:grid-cols-[23rem_1fr]">
        <form class="admin-card p-5" method="POST" action="{{ route('management.cms.navigation.store') }}">
            @csrf
            <h2 class="text-lg font-bold">Add menu item</h2>
            <div class="mt-4 grid gap-3">
                @include('pages.admin.cms.navigation.fields', ['item' => null])
            </div>
            <button class="mt-4 rounded-xl bg-brand-700 px-4 py-3 text-sm font-bold text-white">Add navigation item</button>
        </form>

        <section class="admin-card overflow-hidden">
            <div class="border-b border-slate-200 p-5 dark:border-slate-800">
                <h2 class="text-lg font-bold">Menu registry</h2>
                <p class="text-sm text-slate-500">Parent items create dropdowns. Use order values to place links.</p>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse ($items as $item)
                    <form method="POST" action="{{ route('management.cms.navigation.update', $item) }}" class="p-5">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-3 lg:grid-cols-4">
                            @include('pages.admin.cms.navigation.fields', ['item' => $item])
                        </div>
                        <div class="mt-3 flex items-center justify-between">
                            <p class="text-xs text-slate-500">{{ ucfirst($item->location) }} menu{{ $item->parent ? ' under ' . $item->parent->label : '' }}</p>
                            <div class="flex gap-2">
                                <button class="rounded-xl bg-brand-700 px-3 py-2 text-xs font-bold text-white">Save</button>
                                <button type="button" class="rounded-xl bg-red-50 px-3 py-2 text-xs font-bold text-red-600" onclick="AdminUI.confirmSubmit(this.form.nextElementSibling, 'Delete this menu item?')">Delete</button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('management.cms.navigation.destroy', $item) }}" class="hidden">@csrf @method('DELETE')</form>
                @empty
                    <p class="p-10 text-center text-sm text-slate-500">No menu items yet.</p>
                @endforelse
            </div>
        </section>
    </section>
@endsection
