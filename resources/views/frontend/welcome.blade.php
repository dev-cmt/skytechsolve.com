<x-frontend-layout title="Home Page" :breadcrumbs="$breadcrumbs" :seotags="$seotags">
    @if($settings->is_slider)
        <!-- Banner Section -->
        @include('frontend.partials.slider')
        <!-- End Banner Section -->
    @else
        <!-- Hero Section -->
        @include('frontend.partials.hero')
        <!-- End Hero Section -->
    @endif

    <!-- About Section -->
    <section class="about-section" style="background-image: url({{asset('frontend/images/pages/bg-about-us.jpg') }});">
        <div class="auto-container">
            <div class="row no-gutters">
                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="title-box wow fadeInLeft" data-wow-delay='1200ms'>
                            <h2>ABOUT <br> US</h2>
                        </div>
                        <div class="image-box">
                            <figure class="alphabet-img wow fadeInRight">
                                <img loading="lazy" src="{{asset('frontend')}}/images/pages/about-us-1.png" alt="">
                            </figure>
                            <figure class="image wow fadeInRight" data-wow-delay='600ms'>
                                <img loading="lazy" src="{{asset('frontend')}}/images/pages/about-us-2.jpg" alt="">
                            </figure>
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="content-box">
                            <div class="title">
                                <h2>{{ $story->title ?? 'Our Company' }}</h2>
                            </div>
                            <div class="text">{!! $story->content !!}</div>
                            <div class="link-box">
                                <a href="{{ route('page.about-us') }}" class="theme-btn btn-style-one">About Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section -->

    <!-- Services Section -->
    @if ($services->isNotEmpty())
        <section class="services-section">
            <div class="upper-box" style="background-image: url({{asset('frontend')}}/images/pages/bg-service.jpg);">
                <div class="auto-container">
                    <div class="sec-title text-center light">
                        <span class="float-text">Service</span>
                        <h2>Our Service</h2>
                    </div>
                </div>
            </div>

            <div class="services-box">
                <div class="auto-container">
                    <div class="services-carousel owl-carousel owl-theme">
                        @foreach($services as $service)
                            <!-- Service Block -->
                            <div class="service-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="{{ route('page.services-details', $service->slug) }}">
                                                <img loading="lazy"
                                                    src="{{ asset($service->media->where('is_main', 1)->first()?->path) }}"
                                                    alt="{{ $service->title }}">
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="lower-content">
                                        <h3>
                                            <a href="{{ route('page.services-details', $service->slug) }}">
                                                {{ $service->title }}
                                            </a>
                                        </h3>
                                        <div class="text">{{ Str::limit($service->description, 100) }}</div>
                                        <div class="link-box">
                                            <a href="{{ route('page.services-details', $service->slug) }}">
                                                Learn More <i class="fa fa-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--End Services Section -->

    <!-- Products Section -->
    @if (!empty($products) && $products->isNotEmpty())
        <section class="services-section-three">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <span class="float-text">Products</span>
                    <h2>Our Digital Products</h2>
                </div>

                <div class="row clearfix">
                    @foreach($products as $product)
                        <div class="service-block-three col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box wow fadeInUp">
                                @php
                                    $productImages = $product->media->where('is_main', 1)->first();
                                @endphp
                                @if($productImages)
                                <div class="image-box">
                                    <figure class="image">
                                        <a href="{{ route('page.products') }}">
                                            <img loading="lazy" src="{{ asset($productImages->path) }}" alt="{{ $product->title }}">
                                        </a>
                                    </figure>
                                </div>
                                @endif
                                <div class="lower-content">
                                    <div class="icon-box"><span class="{{ $product->icon ?? 'bx bx-package' }}"></span></div>
                                    <h3><a href="{{ route('page.products') }}">{{ $product->title }}</a></h3>
                                    <div class="text">{{ $product->subtitle }}</div>
                                    @if($product->price)
                                        <div class="price-box">From <span>{{ $product->price }}</span></div>
                                    @endif
                                    <div class="link-box">
                                        <a href="{{ route('page.products') }}">View Plans <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--End Products Section -->

    <!-- Achievement Section -->
    @if ($achievements->isNotEmpty())
        <section class="fun-fact-section">
            <div class="outer-box"
                style="background: linear-gradient(rgb(0 0 0 / 80%), rgb(0 0 0 / 80%)), url({{ asset('frontend/images/pages/bg-achievement.jpg') }}); background-size: cover; background-position: center;">
                <div class="auto-container">
                    <div class="fact-counter">
                        <div class="row">
                            @foreach($achievements as $index => $achievement)
                                <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp"
                                    data-wow-delay="{{ $index * 400 }}ms">
                                    <div class="count-box">
                                        <div class="count">
                                            <span class="count-text" data-speed="5000"
                                                data-stop="{{ $achievement->count ?? 0 }}">0</span>
                                            {{ $achievement->suffix ?? '' }}
                                        </div>
                                        <h4 class="counter-title">{!! nl2br($achievement->title) !!}</h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End Achievement Section -->

    <!-- Project Section -->
    @if ($projects->isNotEmpty())
        <section class="projects-section">
            <div class="auto-container">
                <div class="sec-title text-right">
                    <span class="float-text">Project</span>
                    <h2>Our Project</h2>
                </div>
            </div>

            <div class="inner-container">
                <div class="projects-carousel owl-carousel owl-theme">
                    @foreach($projects as $project)
                        <div class="project-block">
                            <div class="image-box">
                                @php
                                    $defaultImage = $project->media->where('is_main', true)->first();
                                    $imagePath = $defaultImage ? asset($defaultImage->path) : asset('images/placeholder.jpg');
                                @endphp
                                <figure class="image">
                                    <img loading="lazy" src="{{ $imagePath }}" alt="{{ $project->title }}"
                                        style="aspect-ratio:1/1">
                                </figure>
                                <div class="overlay-box">
                                    <h4>
                                        <a href="{{ route('page.projects-details', $project->slug) }}">
                                            {{ $project->title }}
                                        </a>
                                    </h4>
                                    <div class="btn-box">
                                        <a href="{{ $imagePath }}" class="lightbox-image" data-fancybox="gallery">
                                            <i class="fa fa-search"></i>
                                        </a>
                                        <a href="{{ route('page.projects-details', $project->slug) }}">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    </div>
                                    <span class="tag">{{ $project->category->category_name ?? 'Uncategorized' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--End Project Section -->


    <!-- Team Section -->
    @if ($teams->isNotEmpty())
        <section class="team-section">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <span class="title">Our Team</span>
                    <h2>Perfect Expert</h2>
                </div>

                <div class="row clearfix">
                    @foreach($teams as $team)
                        <!-- Team Block -->
                        <div class="team-block col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image-box">
                                    <div class="image">
                                        <a href="#">
                                            <img loading="lazy" src="{{ asset($team->image) }}" alt="{{ $team->name }}">
                                        </a>
                                    </div>
                                    <ul class="social-links">
                                        @if($team->facebook)
                                            <li><a href="{{ $team->facebook }}"><i class="fa fa-facebook"></i></a></li>
                                        @endif
                                        @if($team->twitter)
                                            <li><a href="{{ $team->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                        @endif
                                        @if($team->instagram)
                                            <li><a href="{{ $team->instagram }}"><i class="fa fa-instagram"></i></a></li>
                                        @endif
                                        @if($team->linkedin)
                                            <li><a href="{{ $team->linkedin }}"><i class="fa fa-linkedin"></i></a></li>
                                        @endif
                                    </ul>
                                    <h3 class="name">
                                        <a href="#">{{ $team->name }}</a>
                                    </h3>
                                </div>
                                <span class="designation">{{ $team->position ?? 'Team Member' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--End Team Section-->


    <!-- Testimonial Section -->
    @if ($testimonials->isNotEmpty())
        <section class="testimonial-section">
            <div class="outer-container clearfix">
                <!-- Title Column -->
                <div class="title-column clearfix">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="float-text">Testimonial</span>
                            <h2>{{ data_get($page->content, 'testimonial.title', 'What Client Says') }}</h2>
                        </div>
                        <div class="text">
                            {{ data_get($page->content, 'testimonial.sub_title', 'Our clients trust us for our expertise and honesty. We deliver smart software solutions that help businesses grow, with a focus on quality, transparency, and long-term success.') }}
                        </div>
                    </div>
                </div>

                <!-- Testimonial Column -->
                <div class="testimonial-column clearfix"
                    style="background-image: url({{ asset('frontend/images/pages/bg-testimonial.jpg') }});">
                    <div class="inner-column">
                        <div class="testimonial-carousel owl-carousel owl-theme">
                            @foreach($testimonials as $testimonial)
                                <div class="testimonial-block">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <img loading="lazy" src="{{ asset($testimonial->image ?? 'images/profile.jpg') }}"
                                                alt="{{ $testimonial->client_name }}">
                                        </div>
                                        <div class="text">{{ $testimonial->content }}</div>
                                        <div class="info-box">
                                            <h4 class="name">{{ $testimonial->client_name }}</h4>
                                            @if($testimonial->position || $testimonial->company)
                                                <span class="designation">
                                                    {{ $testimonial->position }}{{ $testimonial->position && $testimonial->company ? ', ' : '' }}{{ $testimonial->company }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End Testimonial Section -->


    <!-- News Section -->
    @if ($blogPosts->isNotEmpty())
        <section class="news-section">
            <div class="auto-container">
                <div class="sec-title">
                    <span class="float-text">Blogs</span>
                    <h2>News & Articles</h2>
                </div>
                <div class="row">
                    @forelse($blogPosts as $post)
                        <!-- News Block -->
                        <div class="news-block col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image-box">
                                    @if($post->main_image)
                                        <figure class="image">
                                            <img loading="lazy" src="{{ asset($post->main_image->path) }}" alt="{{ $post->title }}">
                                        </figure>
                                    @else
                                        <figure class="image">
                                            <img loading="lazy" src="{{ asset('images/placeholder/blog-placeholder.jpg') }}"
                                                alt="{{ $post->title }}">
                                        </figure>
                                    @endif
                                    <div class="overlay-box">
                                        <a href="{{ route('page.blogs-details', $post->slug) }}">
                                            <i class="fa fa-link"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="caption-box">
                                    <h3>
                                        <a href="{{ route('page.blogs-details', $post->slug) }}" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;" title="{{ $post->title }}">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <ul class="info">
                                        <li>{{ $post->published_date ? $post->published_date->format('d M Y') : 'Not published' }},
                                        </li>
                                        <li>{{ $post->author->name }}</li>
                                    </ul>
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
            </div>
        </section>
    @endif
    <!--End News Section -->

    <!--Clients Section-->
    @if ($clients->isNotEmpty())
        <section class="clients-section">
            <div class="inner-container">
                <div class="sponsors-outer">
                    <!--Sponsors Carousel-->
                    <ul class="sponsors-carousel owl-carousel owl-theme">
                        @foreach($clients as $client)
                            <li class="slide-item">
                                <figure class="image-box">
                                    <a href="{{ $client->url ?: '#' }}">
                                        <img loading="lazy" src="{{ asset($client->logo) }}" alt="{{ $client->name }}">
                                    </a>
                                </figure>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    @endif
    <!--End Clients Section-->

</x-frontend-layout>
