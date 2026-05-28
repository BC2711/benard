@php
    $content = old('content_json', $section ? json_encode($section->content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : "{\n  \"title\": \"Section title\",\n  \"description\": \"Section body\"\n}");
    $settings = old('settings_json', $section ? json_encode($section->settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : "{}");
@endphp
<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <input name="name" class="admin-input h-11 px-4" value="{{ old('name', $section->name ?? '') }}" placeholder="Section name" required>
    <input name="section_key" class="admin-input h-11 px-4" value="{{ old('section_key', $section->section_key ?? '') }}" placeholder="section-id" required>
    <input name="component" class="admin-input h-11 px-4" value="{{ old('component', $section->component ?? 'website.content-block') }}" placeholder="website.hero">
    <input type="number" name="sort_order" class="admin-input h-11 px-4" value="{{ old('sort_order', $section->sort_order ?? 0) }}" placeholder="Sort order" required>
    <select name="status" class="admin-input h-11 px-4">
        @foreach (['draft', 'published', 'disabled'] as $status)
            <option value="{{ $status }}" @selected(old('status', $section->status ?? 'published') === $status)>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
    <input type="datetime-local" name="published_at" class="admin-input h-11 px-4" value="{{ old('published_at', optional($section?->published_at)->format('Y-m-d\TH:i')) }}">
    <textarea name="content_json" class="admin-input min-h-44 px-4 py-3 font-mono text-xs md:col-span-2" placeholder="Content JSON">{{ $content }}</textarea>
    <textarea name="settings_json" class="admin-input min-h-28 px-4 py-3 font-mono text-xs md:col-span-2" placeholder="Settings JSON">{{ $settings }}</textarea>
</div>
