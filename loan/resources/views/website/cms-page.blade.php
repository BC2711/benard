@include('components.website.header')
@include('components.website.menu')

@php
    $sections = $cmsSections ?? collect();
@endphp

@forelse ($sections as $cmsSection)
    @include('components.website.dynamic-section', ['cmsSection' => $cmsSection])
@empty
    <main class="premium-shell py-32">
        <div class="rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-xl">
            <p class="text-sm font-bold uppercase tracking-wider text-cyan-700">Content coming soon</p>
            <h1 class="mt-3 text-4xl font-black">{{ $cmsPage->title ?? 'Page' }}</h1>
            <p class="mx-auto mt-4 max-w-xl text-slate-600">This page is published, but no visible sections have been added yet.</p>
        </div>
    </main>
@endforelse

@include('components.website.footer')
@include('components.website.closing_header')
