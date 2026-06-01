@extends('layouts.admin.main')

@section('title', 'Loan Agreement')
@section('page-title', 'Loan Agreement PDF')
@section('page-description', 'Upload the loan agreement form customers can download before submitting an application.')
@section('page-icon')<i class="fas fa-file-pdf"></i>@endsection

@section('content')
    <section class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_22rem]">
        <form method="POST" enctype="multipart/form-data" action="{{ route('management.loan-agreement.update') }}" class="admin-card p-5">
            @csrf
            @method('PUT')
            <h2 class="text-lg font-bold">Upload agreement</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Upload a PDF up to 10 MB. A new upload replaces the current website download.</p>
            <label class="mt-5 block">
                <span class="mb-2 block text-sm font-bold text-slate-600 dark:text-slate-300">Loan agreement PDF</span>
                <input type="file" name="agreement_pdf" accept="application/pdf,.pdf" class="admin-input w-full p-3 text-sm" required>
            </label>
            @error('agreement_pdf')
                <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
            @enderror
            <button class="mt-5 inline-flex items-center gap-2 rounded-xl bg-brand-700 px-5 py-3 text-sm font-bold text-white shadow-soft">
                <i class="fas fa-upload"></i>
                Upload PDF
            </button>
        </form>

        <aside class="admin-card p-5">
            <h2 class="text-lg font-bold">Website download</h2>
            @if ($agreementPath)
                <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-900 dark:bg-emerald-950/30">
                    <p class="text-xs font-bold uppercase text-emerald-700 dark:text-emerald-300">Published</p>
                    <p class="mt-2 break-words text-sm font-semibold">{{ $agreementName ?: 'loan-agreement.pdf' }}</p>
                </div>
                <a href="{{ route('loan-agreement.download') }}" class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-brand-700 dark:text-cyan-300">
                    <i class="fas fa-download"></i>
                    Download current PDF
                </a>
                <form method="POST" action="{{ route('management.loan-agreement.destroy') }}" class="mt-5">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="text-sm font-bold text-red-600" onclick="AdminUI.confirmSubmit(this.form, 'Remove the website loan agreement PDF?')">
                        Remove PDF
                    </button>
                </form>
            @else
                <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">No PDF has been uploaded. The website download button is hidden until an agreement is available.</p>
            @endif
        </aside>
    </section>
@endsection
