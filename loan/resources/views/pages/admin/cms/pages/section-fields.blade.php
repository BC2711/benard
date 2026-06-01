@php
    $content = old('content_json', $section ? json_encode($section->content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : "{\n  \"title\": \"Section title\",\n  \"description\": \"Section body\"\n}");
    $settings = old('settings_json', $section ? json_encode($section->settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : "{}");
    $body = old('body_html', $section->content['body'] ?? '');
@endphp
<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <input name="name" class="admin-input h-11 px-4" value="{{ old('name', $section->name ?? '') }}" placeholder="Section name" required>
    <input name="section_key" class="admin-input h-11 px-4" value="{{ old('section_key', $section->section_key ?? '') }}" placeholder="section-id" required>
    <select name="type" class="admin-input h-11 px-4">
        @foreach (['hero', 'about', 'services', 'features', 'statistics', 'team', 'testimonials', 'faq', 'gallery', 'video', 'pricing', 'partners', 'blog', 'contact', 'newsletter', 'custom'] as $type)
            <option value="{{ $type }}" @selected(old('type', $section->type ?? 'custom') === $type)>{{ ucfirst($type) }}</option>
        @endforeach
    </select>
    <input name="component" class="admin-input h-11 px-4" value="{{ old('component', $section->component ?? 'website.content-block') }}" placeholder="website.content-block">
    <input type="number" name="sort_order" class="admin-input h-11 px-4" value="{{ old('sort_order', $section->sort_order ?? 0) }}" placeholder="Sort order" required>
    <select name="status" class="admin-input h-11 px-4">
        @foreach (['draft', 'published', 'disabled'] as $status)
            <option value="{{ $status }}" @selected(old('status', $section->status ?? 'published') === $status)>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
    <input type="datetime-local" name="published_at" class="admin-input h-11 px-4" value="{{ old('published_at', optional($section?->published_at)->format('Y-m-d\TH:i')) }}">
    <input type="datetime-local" name="scheduled_for" class="admin-input h-11 px-4" value="{{ old('scheduled_for', optional($section?->scheduled_for)->format('Y-m-d\TH:i')) }}" title="Schedule publish">
    <input type="datetime-local" name="expires_at" class="admin-input h-11 px-4" value="{{ old('expires_at', optional($section?->expires_at)->format('Y-m-d\TH:i')) }}" title="Expire content">
    <div class="md:col-span-2">
        <div class="mb-2 flex gap-2">
            <button type="button" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-bold dark:bg-slate-800" onclick="document.execCommand('bold')">Bold</button>
            <button type="button" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-bold dark:bg-slate-800" onclick="document.execCommand('italic')">Italic</button>
            <button type="button" class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-bold dark:bg-slate-800" onclick="document.execCommand('insertUnorderedList')">List</button>
        </div>
        <input type="hidden" name="body_html" value="{{ $body }}">
        <div contenteditable="true" class="admin-input min-h-32 px-4 py-3 text-sm" oninput="this.previousElementSibling.value = this.innerHTML">{!! $body !!}</div>
        <p class="mt-1 text-xs text-slate-400">Rich text body</p>
    </div>
    <textarea name="content_json" class="admin-input min-h-44 px-4 py-3 font-mono text-xs md:col-span-2" placeholder="Content JSON">{{ $content }}</textarea>
    <textarea name="settings_json" class="admin-input min-h-28 px-4 py-3 font-mono text-xs md:col-span-2" placeholder="Settings JSON">{{ $settings }}</textarea>
</div>
