{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($staticUrls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        <lastmod>{{ $url['lastmod'] }}</lastmod>
        <changefreq>{{ $url['changefreq'] }}</changefreq>
        <priority>{{ $url['priority'] }}</priority>
    </url>
@endforeach
@foreach ($packages as $pkg)
    <url>
        <loc>{{ route('packages.show', $pkg->slug) }}</loc>
        <lastmod>{{ $pkg->updated_at ? $pkg->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
@endforeach
@foreach ($services as $srv)
    <url>
        <loc>{{ route('services.show', $srv->slug) }}</loc>
        <lastmod>{{ $srv->updated_at ? $srv->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
@foreach ($posts as $post)
    <url>
        <loc>{{ route('posts.show', $post->slug) }}</loc>
        <lastmod>{{ $post->updated_at ? $post->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
</urlset>
