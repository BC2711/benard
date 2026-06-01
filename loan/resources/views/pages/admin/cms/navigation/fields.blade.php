<input name="label" class="admin-input h-11 px-3" value="{{ old('label', $item->label ?? '') }}" placeholder="Label" required>
<select name="location" class="admin-input h-11 px-3">
    @foreach (['primary', 'footer'] as $location)
        <option value="{{ $location }}" @selected(old('location', $item->location ?? 'primary') === $location)>{{ ucfirst($location) }}</option>
    @endforeach
</select>
<select name="page_id" class="admin-input h-11 px-3">
    <option value="">Custom URL</option>
    @foreach ($pages as $page)
        <option value="{{ $page->id }}" @selected((string) old('page_id', $item->page_id ?? '') === (string) $page->id)>{{ $page->title }}</option>
    @endforeach
</select>
<input name="url" class="admin-input h-11 px-3" value="{{ old('url', $item->url ?? '') }}" placeholder="/custom-url">
<select name="parent_id" class="admin-input h-11 px-3">
    <option value="">Top level</option>
    @foreach ($parents as $parent)
        @if (!$item || $parent->id !== $item->id)
            <option value="{{ $parent->id }}" @selected((string) old('parent_id', $item->parent_id ?? '') === (string) $parent->id)>{{ $parent->label }}</option>
        @endif
    @endforeach
</select>
<input name="icon" class="admin-input h-11 px-3" value="{{ old('icon', $item->icon ?? '') }}" placeholder="fas fa-link">
<input type="number" name="sort_order" class="admin-input h-11 px-3" value="{{ old('sort_order', $item->sort_order ?? 0) }}" placeholder="Order" required>
<select name="status" class="admin-input h-11 px-3">
    @foreach (['published', 'draft', 'disabled'] as $status)
        <option value="{{ $status }}" @selected(old('status', $item->status ?? 'published') === $status)>{{ ucfirst($status) }}</option>
    @endforeach
</select>
<select name="target" class="admin-input h-11 px-3">
    <option value="_self" @selected(old('target', $item->target ?? '_self') === '_self')>Same tab</option>
    <option value="_blank" @selected(old('target', $item->target ?? '_self') === '_blank')>New tab</option>
</select>
<input type="datetime-local" name="published_at" class="admin-input h-11 px-3" value="{{ old('published_at', optional($item?->published_at)->format('Y-m-d\TH:i')) }}" title="Publish at">
<input type="datetime-local" name="expires_at" class="admin-input h-11 px-3" value="{{ old('expires_at', optional($item?->expires_at)->format('Y-m-d\TH:i')) }}" title="Expire at">
