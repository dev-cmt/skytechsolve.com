<x-frontend-layout title="Blogs" :breadcrumbs="$breadcrumbs" :seotags="$seotags">
    <!--Page Title-->
    <section class="page-title" style="background-image:url({{ asset('frontend/images/pages/bg-title.jpg') }});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>News & Artical</h1>
                    <span class="title">The Interior speak for themselves</span>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Blogs</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="auto-container">
            <div class="row">
                @forelse($blogPosts as $post)
                <!-- News Block -->
                <div class="news-block-two col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <div class="image-box">
                            @if($post->main_image)
                            <figure class="image">
                                <img loading="lazy" src="{{ asset($post->main_image->path) }}" alt="{{ $post->title }}">
                            </figure>
                            @else
                            <figure class="image">
                                <img loading="lazy" src="{{ asset('images/placeholder/blog-placeholder.jpg') }}" alt="{{ $post->title }}">
                            </figure>
                            @endif
                            <div class="overlay-box">
                                <a href="{{ route('page.blogs-details', $post->slug) }}">
                                    <i class="fa fa-link"></i>
                                </a>
                            </div>
                        </div>
                        <div class="caption-box">
                            <div class="inner">
                                <h3>
                                    <a href="{{ route('page.blogs-details', $post->slug) }}">
                                        {{ \Illuminate\Support\Str::limit($post->title, 60) }}
                                    </a>
                                </h3>
                                <ul class="info">
                                    <li>{{ $post->published_date ? $post->published_date->format('d M Y') : 'Not published' }},</li>
                                    <li>{{ $post->author->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- No Posts Message -->
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <p>No blog posts available yet. Check back soon!</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($blogPosts->hasPages())
            <div class="styled-pagination">
                <ul class="clearfix">
                    {{-- Previous Page Link --}}
                    @if($blogPosts->onFirstPage())
                    <li class="prev-post disabled"><a href="#"><span class="fa fa-long-arrow-left"></span> Prev</a></li>
                    @else
                    <li class="prev-post"><a href="{{ $blogPosts->previousPageUrl() }}"><span class="fa fa-long-arrow-left"></span> Prev</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach($blogPosts->getUrlRange(1, $blogPosts->lastPage()) as $page => $url)
                        @if($page == $blogPosts->currentPage())
                        <li class="active"><a href="#">{{ $page }}</a></li>
                        @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($blogPosts->hasMorePages())
                    <li class="next-post"><a href="{{ $blogPosts->nextPageUrl() }}"> Next <span class="fa fa-long-arrow-right"></span> </a></li>
                    @else
                    <li class="next-post disabled"><a href="#"> Next <span class="fa fa-long-arrow-right"></span> </a></li>
                    @endif
                </ul>
            </div>
            @endif
        </div>
    </section>
    <!--End Blog Section -->
</x-frontend-layout>

