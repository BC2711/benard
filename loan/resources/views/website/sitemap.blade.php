<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($pages as $page)
    <url>
        <loc>{{ url($page->is_homepage ? '/' : $page->slug) }}</loc>
        <lastmod>{{ $page->updated_at->toAtomString() }}</lastmod>
        <changefreq>{{ $page->is_homepage ? 'daily' : 'weekly' }}</changefreq>
        <priority>{{ $page->is_homepage ? '1.0' : '0.7' }}</priority>
    </url>
@endforeach
</urlset>
