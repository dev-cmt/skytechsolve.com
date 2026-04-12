<x-frontend-layout title="{{ $post->title ?? 'Blog Detail' }} " :breadcrumbs="$breadcrumbs" :seotags="$seotags">
<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('frontend/images/pages/bg-title.jpg') }});">
    <div class="auto-container">
        <div class="inner-container clearfix">
            <div class="title-box">
                <h1>{{ $post->title }}</h1>
                <span class="title">{{ $post->category->category_name ?? '' }}</span>
            </div>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Blog Detail</li>
            </ul>
        </div>
    </div>
</section>
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">

            <!-- Content Side -->
            <div class="content-side col-lg-8 col-md-12 col-sm-12">
                <div class="blog-detail">
                    <div class="news-block-two">
                        <div class="inner-box">
                            <div class="image-box">
                                @if($post->main_image)
                                    <figure class="image"><img loading="lazy" src="{{ asset($post->main_image->path) }}" alt="{{ $post->title }}"></figure>
                                @endif
                            </div>
                            <div class="caption-box">
                                <div class="inner">
                                    <h3>{{ $post->title }}</h3>
                                    <ul class="info">
                                        <li>{{ $post->published_date?->format('d M Y') }}</li>
                                        <li><a href="#">{{ $post->author->name ?? 'Admin' }}</a></li>
                                        <li><a href="#">{{ $post->comments->count() ?? 0 }} Comments</a></li>
                                    </ul>
                                    <p>{!! $post->content !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    @if($post->tags)
                    <div class="tags clearfix">
                        <span class="title">Tags:</span>
                        <ul>
                            @foreach($post->tags as $tag)
                                <li><a href="{{ route('page.blogs-tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Share Option -->
                    <div class="share-option">
                        <span class="title">Share This:</span>
                        <ul class="social-icon-colored clearfix">
                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google Plus</a></li>
                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest-p"></i>Pinterest</a></li>
                            <li class="mail"><a href="#"><i class="fa fa-envelope"></i>Mail to Friends</a></li>
                        </ul>
                    </div>

                    <!-- Comments -->
                    <div class="comments-area">
                        <div class="group-title"><h2>Comments ({{ $post->comments->count() ?? 0 }})</h2></div>

                        @foreach($post->comments as $comment)
                        <div class="comment-box {{ $comment->parent_id ? 'reply-comment' : '' }}">
                            <div class="comment">
                                <div class="author-thumb">
                                    <img loading="lazy" src="{{ asset($comment->user->avatar ?? 'default-avatar.png') }}" alt="{{ $comment->user->name ?? 'User' }}">
                                </div>
                                <div class="comment-info">
                                    <div class="name">{{ $comment->user->name ?? 'Anonymous' }}</div>
                                    <div class="date">{{ $comment->created_at->format('d M Y') }}</div>
                                </div>
                                <div class="text">{{ $comment->content }}</div>
                                <a href="#" class="reply-btn">Reply</a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Comment Form -->
                    <div class="comment-form">
                        <div class="group-title"><h2>Leave a Comment</h2></div>
                        <form method="post" action="{{ route('page.blogs-comments.store', $post->id) }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" placeholder="Mail Address" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <textarea name="content" placeholder="Your Comments" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button class="theme-btn btn-style-one" type="submit">Post Comment</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <!-- Sidebar Side -->
            <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                <aside class="sidebar default-sidebar">

                    <!-- Search Box -->
                    <div class="sidebar-widget search-box">
                        <form method="GET" action="{{ route('page.blogs.search') }}">
                            <div class="form-group">
                                <input type="search" name="query" placeholder="Search....." required>
                                <button type="submit"><span class="icon fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div class="sidebar-widget categories">
                        <div class="sidebar-title"><h3>Categories</h3></div>
                        <ul class="cat-list">
                            @foreach($categories as $category)
                                <li class="{{ $post->category->slug == $category->slug ? 'active' : '' }}">
                                    <a href="{{ route('page.blogs.category', $category->slug) }}">
                                        {{ $category->category_name }} <span>{{ $category->blog_posts_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    <!-- Recent Posts -->
                    <div class="sidebar-widget latest-news">
                        <div class="sidebar-title"><h3>Recent Post</h3></div>
                        <div class="widget-content">
                            @foreach($recentPosts as $recent)
                            <article class="post">
                                <div class="post-thumb">
                                    <a href="{{ route('page.blogs-details', $recent->slug) }}">
                                        <img loading="lazy" src="{{ asset($recent->main_image->path ?? 'default.png') }}" alt="{{ $recent->title }}">
                                    </a>
                                </div>
                                <h3><a href="{{ route('page.blogs-details', $recent->slug) }}">
                                    {{ \Illuminate\Support\Str::limit($recent->title, 50, '...') }}
                                </a></h3>
                                <div class="post-info">by {{ $recent->author->name ?? 'Admin' }}</div>
                            </article>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="sidebar-widget tags">
                        <div class="sidebar-title"><h3>Keywords</h3></div>
                        <ul class="tag-list clearfix">
                            @foreach($allTags as $tag)
                                <li><a href="{{ route('page.blogs-tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                </aside>
            </div>

        </div>
    </div>
</div>
</x-frontend-layout>
