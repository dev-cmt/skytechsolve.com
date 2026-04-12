<x-frontend-layout title="{{ $service->seo->title ?? $service->title }}" :breadcrumbs="$breadcrumbs"
    :seotags="$seotags">
    <!--Page Title-->
    <section class="page-title" style="background-image:url({{ asset('frontend/images/pages/bg-title.jpg') }});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1 class="mb-0">{{ $service->title }}</h1>
                </div>
                <ul class="bread-crumb clearfix pt-0">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>{{ $service->title }}</li>
                </ul>
            </div>
        </div>
    </section>

    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Sidebar-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar services-sidebar">

                        <!-- All Services List -->
                        <div class="sidebar-widget sidebar-blog-category">
                            <ul class="blog-cat">
                                @foreach($allServices as $s)
                                    <li class="{{ $s->slug === $service->slug ? 'active' : '' }}">
                                        <a
                                            href="{{ route('page.services-details', $s->slug) }}">{{ strtoupper($s->title) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Dynamic Brochures (Attachments) -->
                        @if($service->media->where('type', 'document')->count())
                            <div class="sidebar-widget brochure-widget">
                                <h3 class="sidebar-title">Download Brochures</h3>
                                @foreach($service->media->where('type', 'document') as $file)
                                    <div class="brochure-box">
                                        <div class="inner">
                                            @php
                                                $ext = pathinfo($file->path, PATHINFO_EXTENSION);
                                            @endphp
                                            <span class="icon fa fa-file-{{ $ext }}-o"></span>
                                            <div class="text">{{ $file->name }}</div>
                                        </div>
                                        <a href="{{ asset($file->path) }}" class="overlay-link" target="_blank"></a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Quick Contact -->
                        <div class="help-box"
                            style="background-image:url({{ asset('frontend/images/pages/bg-service-details.jpg') }})">
                            <div class="inner">
                                <span class="title">Quick Contact</span>
                                <h2>Get Solution</h2>
                                <div class="text">Contact us at the Interior office nearest to you or submit a business
                                    inquiry online.</div>
                                <a class="theme-btn btn-style-three" href="{{route('page.contact-us')}}">Contact</a>
                            </div>
                        </div>
                        <div class="image mt-4">
                            <img loading="lazy" src="{{ asset('images/banner-logo.jpg') }}" alt="company banner">
                        </div>
                    </aside>
                </div>

                <!--Main Content-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="service-detail">
                        <div class="inner-box">
                            <!-- Images Carousel -->
                            @if($service->media->count())
                                <div class="image-box">
                                    <div class="single-item-carousel owl-carousel owl-theme">
                                        @foreach($service->media->where('type', 'image') as $img)
                                            <figure class="image">
                                                <img loading="lazy" src="{{ asset($img->path) }}"
                                                    alt="{{ $img->alt_text ?? $service->title }}">
                                            </figure>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <h2>{{ $service->title }}</h2>
                            <div class="text">
                                {!! $service->description !!}

                                <!-- Key Features -->
                                @if($service->features->count())
                                    <div class="two-column">
                                        <h3>Our Key Features</h3>
                                        <div class="column">
                                            <ul class="row">
                                                @foreach($service->features as $feature)
                                                    <li class="col-lg-6 col-md-6 col-sm-12">{{ $feature->feature_name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <!-- Message For CEO -->
                        <blockquote>
                            {{ $settings->description ?? 'CEO Message' }}<cite>{{ $settings->company_name ?? 'CEO' }}</cite>
                        </blockquote>

                        <!-- Product Info Tabs (Example content; replace or loop from DB if needed) -->
                        <div class="product-info-tabs">
                            <div class="prod-tabs tabs-box">
                                <ul class="tab-btns tab-buttons clearfix">
                                    <li data-tab="#precautions" class="tab-btn active-btn">Precautions</li>
                                    <li data-tab="#intelligence" class="tab-btn">Intelligence</li>
                                    <li data-tab="#specializations" class="tab-btn">Specializations</li>
                                </ul>
                                <div class="tabs-content">
                                    <div class="tab active-tab" id="precautions">
                                        <div class="content">
                                            {!! $service->seo?->meta_keywords ?? 'Add your precautions content here' !!}
                                        </div>
                                    </div>
                                    <div class="tab" id="intelligence">
                                        <div class="content">
                                            <p>Add your intelligence content here</p>
                                        </div>
                                    </div>
                                    <div class="tab" id="specializations">
                                        <div class="content">
                                            <p>Add your specializations content here</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>