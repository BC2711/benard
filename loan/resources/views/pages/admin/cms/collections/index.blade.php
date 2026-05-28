@extends('layouts.admin.main')

@section('title', $label)
@section('page-title', $label)
@section('page-description', 'Manage database-driven CMS records with status, ordering, media references, and JSON content.')
@section('page-icon')
    <i class="fas fa-database"></i>
@endsection
@section('page-actions')
    <a href="{{ route('management.cms.collections.create', $type) }}" class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-4 text-sm font-bold text-white shadow-soft">
        <i class="fas fa-plus"></i> New
    </a>
@endsection

@section('content')
    <section class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:bg-slate-900">
                    <tr>
                        <th class="px-5 py-4">Title</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Order</th>
                        <th class="px-5 py-4">Published</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse ($items as $item)
                        <tr>
                            <td class="px-5 py-4">
                                <p class="font-bold">{{ $item->title ?: $item->slug }}</p>
                                <p class="text-slate-500">{{ $item->subtitle }}</p>
                            </td>
                            <td class="px-5 py-4">{{ ucfirst($item->status) }}</td>
                            <td class="px-5 py-4">{{ $item->sort_order }}</td>
                            <td class="px-5 py-4">{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('M j, Y') : 'Not set' }}</td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('management.cms.collections.edit', [$type, $item->id]) }}" class="admin-icon-btn inline-grid h-10 w-10"><i class="fas fa-pen"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-16 text-center text-slate-500">No records yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-200 px-5 py-4 dark:border-slate-800">{{ $items->links() }}</div>
    </section>
@endsection
