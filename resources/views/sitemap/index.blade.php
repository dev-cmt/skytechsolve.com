{{-- resources/views/sitemap/index.blade.php --}}
{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    {{-- Home page --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Main List Pages --}}
    @php
        $mainPages = [
            'page.about-us', 'page.contact-us', 'page.services', 
            'page.projects', 'page.products', 'page.blogs', 'page.teams'
        ];
    @endphp
    @foreach($mainPages as $route)
        @if(Route::has($route))
            <url>
                <loc>{{ route($route) }}</loc>
                <lastmod>{{ $lastmod }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.9</priority>
            </url>
        @endif
    @endforeach

    {{-- Static Pages --}}
    @if(!empty($pages))
        @foreach($pages as $page)
            <url>
                <loc>{{ url('/' . $page->slug) }}</loc>
                <lastmod>{{ optional($page->updated_at)->toIso8601String() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif

    {{-- Products --}}
    @if(!empty($products))
        @foreach($products as $product)
            <url>
                <loc>{{ route('page.products-details', $product->slug) }}</loc>
                <lastmod>{{ optional($product->updated_at ?? now())->toIso8601String() }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.7</priority>
            </url>
        @endforeach
    @endif

    {{-- Services --}}
    @if(!empty($services))
        @foreach($services as $service)
            <url>
                <loc>{{ route('page.services-details', $service->slug) }}</loc>
                <lastmod>{{ optional($service->updated_at ?? now())->toIso8601String() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif

    {{-- Projects --}}
    @if(!empty($projects))
        @foreach($projects as $project)
            <url>
                <loc>{{ route('page.projects-details', $project->slug) }}</loc>
                <lastmod>{{ optional($project->updated_at ?? now())->toIso8601String() }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif

    {{-- Blogs --}}
    @if(!empty($blogs))
        @foreach($blogs as $blog)
            <url>
                <loc>{{ route('page.blogs-details', $blog->slug) }}</loc>
                <lastmod>{{ optional($blog->updated_at ?? now())->toIso8601String() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.7</priority>
            </url>
        @endforeach
    @endif

    {{-- Teams --}}
    @if(!empty($teams))
        @foreach($teams as $team)
            <url>
                <loc>{{ route('page.teams-details', $team->slug) }}</loc>
                <lastmod>{{ optional($team->updated_at ?? now())->toIso8601String() }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.6</priority>
            </url>
        @endforeach
    @endif

</urlset>
