@extends('layouts.admin.main')

@section('title', 'Consultation Request')
@section('page-title', $consultation->first_name . ' ' . $consultation->last_name)
@section('page-description', 'Consultation request details and scheduling status.')
@section('page-icon')<i class="fas fa-calendar-check"></i>@endsection
@section('page-actions')
    <a href="{{ route('management.consultation.edit', $consultation) }}" class="inline-flex h-11 items-center gap-2 rounded-xl bg-brand-700 px-4 text-sm font-bold text-white"><i class="fas fa-pen"></i> Edit Request</a>
@endsection

@section('content')
    <section class="grid gap-6 xl:grid-cols-[1fr_20rem]">
        <article class="admin-card p-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-bold">Request Details</h2>
                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $consultation->status === 'new' ? 'bg-blue-100 text-blue-700' : ($consultation->status === 'scheduled' ? 'bg-emerald-100 text-emerald-700' : ($consultation->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700')) }}">{{ ucfirst($consultation->status) }}</span>
            </div>
            <dl class="mt-6 grid gap-5 text-sm md:grid-cols-2">
                <div><dt class="font-bold text-slate-500">Customer</dt><dd class="mt-1">{{ $consultation->first_name }} {{ $consultation->last_name }}</dd></div>
                <div><dt class="font-bold text-slate-500">Email</dt><dd class="mt-1"><a class="text-brand-700 dark:text-cyan-300" href="mailto:{{ $consultation->email }}">{{ $consultation->email }}</a></dd></div>
                <div><dt class="font-bold text-slate-500">Phone</dt><dd class="mt-1"><a class="text-brand-700 dark:text-cyan-300" href="tel:{{ $consultation->phone }}">{{ $consultation->phone }}</a></dd></div>
                <div><dt class="font-bold text-slate-500">Preferred appointment</dt><dd class="mt-1">{{ $consultation->preferred_date?->format('M j, Y') }} at {{ $consultation->preferred_time?->format('g:i A') }}</dd></div>
                <div class="md:col-span-2"><dt class="font-bold text-slate-500">Message</dt><dd class="mt-2 whitespace-pre-line rounded-2xl bg-slate-50 p-4 dark:bg-slate-900">{{ $consultation->message ?: 'No additional message provided.' }}</dd></div>
            </dl>
        </article>

        <aside class="admin-card h-fit p-5 text-sm">
            <h2 class="text-lg font-bold">Timeline</h2>
            <p class="mt-4 text-slate-500">Received</p>
            <p class="font-bold">{{ $consultation->created_at->format('M j, Y g:i A') }}</p>
            <p class="mt-4 text-slate-500">Last updated</p>
            <p class="font-bold">{{ $consultation->updated_at->format('M j, Y g:i A') }}</p>
            <a href="{{ route('management.consultation.index') }}" class="mt-6 inline-flex items-center gap-2 font-bold text-brand-700 dark:text-cyan-300"><i class="fas fa-arrow-left"></i> All requests</a>
        </aside>
    </section>
@endsection
