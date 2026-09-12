{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('resources.index') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('courses.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('notices.index') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('links.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('about') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ route('contact') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    @foreach($courses as $course)
    <url>
        <loc>{{ route('courses.show', $course->slug) }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
    @foreach($resources as $res)
    <url>
        <loc>{{ route('resources.show', ['program' => $res->program->slug, 'semester' => $res->semester->slug, 'subject' => $res->subject->slug, 'slug' => $res->slug]) }}</loc>
        <lastmod>{{ $res->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
    @foreach($notices as $not)
    <url>
        <loc>{{ route('notices.show', $not->slug) }}</loc>
        <lastmod>{{ $not->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
</urlset>
