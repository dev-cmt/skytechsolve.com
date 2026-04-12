<x-frontend-layout title="Service" :breadcrumbs="$breadcrumbs" :seotags="$seotags">
    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('frontend/images/pages/bg-title.jpg')}});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ data_get($page->content, 'header.title', 'Services') }}</h1>
                    <span
                        class="title">{{ data_get($page->content, 'header.subtitle', 'The Interior speak for themselves') }}</span>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Services</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    @if (!empty($services) && $services->isNotEmpty())
        <!-- Specialize Section -->
        <section class="specialize-section">
            <div class="auto-container">
                <div class="sec-title">
                    <span class="float-text">Services</span>
                    <h2>Our Specialization</h2>
                </div>

                <div class="services-carousel-two owl-carousel owl-theme">
                    @foreach($services as $service)
                        <div class="service-block-two">
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

                                <div class="caption-box">
                                    <h3>
                                        <a href="{{ route('page.services-details', $service->slug) }}">
                                            {{ strtoupper($service->title) }}
                                        </a>
                                    </h3>

                                    <div class="link-box">
                                        <a href="{{ route('page.services-details', $service->slug) }}">
                                            Read More <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Specialize Section -->
    @endif


    <!-- Offer Section -->
    <section class="offer-section" style="background-image: url({{asset('frontend/images/pages/bg-offer.jpg')}});">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <span
                            class="title">{{ data_get($page->content, 'services_offer.title', 'Special Offer') }}</span>
                        <h2><span>{{ data_get($page->content, 'services_offer.header', 'How to save money on repairs') }}</span>
                        </h2>
                        <span class="discount">{{ data_get($page->content, 'services_offer.discount', '50%') }}</span>
                        <div class="text">
                            {!! nl2br(e(data_get($page->content, 'services_offer.description', "Fill out the form to download a book with 10 tips\non how to save your money"))) !!}
                        </div>
                    </div>
                </div>

                <div class="form-column order-last col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="discount-form">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <!--Comment Form-->
                            <form method="post" action="{{ route('page.contact-us.store') }}">
                                @csrf
                                <input type="hidden" name="subject"
                                    value="{{ data_get($page->content, 'services_offer.title', 'Special Offer') }}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="name" placeholder="Name" required>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <input type="email" name="email" placeholder="Email" required>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="phone" placeholder="Phone" required>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="message" placeholder="Massage"></textarea>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                                        <button class="theme-btn btn-style-one" type="submit" name="submit-form">send
                                            Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Offer Section -->

    <!-- Specialize Section -->
    <section class="specialize-section-two alternate">
        <div class="auto-container">
            <div class="row">
                <!-- Title Column -->
                <div class="title-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="float-text">Services</span>
                            <h2>{{ data_get($page->content, 'services_content.header', 'Our Specialization') }}</h2>
                        </div>

                        <div class="text-box">
                            <h4>{{ data_get($page->content, 'services_content.title', 'Title This Section') }}</h4>
                            {!! data_get($page->content, 'services_content.description', 'Description This Section') !!}
                        </div>
                        <div class="link-box">
                            <a href="#">Read More <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Carousel Column -->
                <div class="carousel-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="carousel-outer">
                            <ul class="image-carousel owl-carousel owl-theme">

                                <li><a href="{{asset('frontend/images/pages')}}/special-4.jpg" class="lightbox-image"
                                        title="Image Caption Here"><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-4.jpg" alt=""></a></li>

                                <li><a href="{{asset('frontend/images/pages')}}/special-2.jpg" class="lightbox-image"
                                        title="Image Caption Here"><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-2.jpg" alt=""></a></li>

                                <li><a href="{{asset('frontend/images/pages')}}/special-3.jpg" class="lightbox-image"
                                        title="Image Caption Here"><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-3.jpg" alt=""></a></li>

                                <li><a href="{{asset('frontend/images/pages')}}/special-1.jpg" class="lightbox-image"
                                        title="Image Caption Here"><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-1.jpg" alt=""></a></li>

                                <li><a href="{{asset('frontend/images/pages')}}/special-4.jpg" class="lightbox-image"
                                        title="Image Caption Here"><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-4.jpg" alt=""></a></li>

                                <li><a href="{{asset('frontend/images/pages')}}/special-2.jpg" class="lightbox-image"
                                        title="Image Caption Here"><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-2.jpg" alt=""></a></li>

                                <li><a href="{{asset('frontend/images/pages')}}/special-3.jpg" class="lightbox-image"
                                        title="Image Caption Here"><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-3.jpg" alt=""></a></li>

                                <li><a href="{{asset('frontend/images/pages')}}/special-1.jpg" class="lightbox-image"
                                        title="Image Caption Here"><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-1.jpg" alt=""></a></li>

                            </ul>

                            <ul class="thumbs-carousel owl-carousel owl-theme">
                                <li class="thumb-box">
                                    <figure><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-thumb-3.jpg" alt="">
                                    </figure>
                                    <div class="overlay"><span class="icon fa fa-arrows-alt"></span></div>
                                </li>
                                <li class="thumb-box">
                                    <figure><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-thumb-1.jpg" alt="">
                                    </figure>
                                    <div class="overlay"><span class="icon fa fa-arrows-alt"></span></div>
                                </li>
                                <li class="thumb-box">
                                    <figure><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-thumb-2.jpg" alt="">
                                    </figure>
                                    <div class="overlay"><span class="icon fa fa-arrows-alt"></span></div>
                                </li>
                                <li class="thumb-box">
                                    <figure><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-thumb-4.jpg" alt="">
                                    </figure>
                                    <div class="overlay"><span class="icon fa fa-search"></span></div>
                                </li>
                                <li class="thumb-box">
                                    <figure><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-thumb-3.jpg" alt="">
                                    </figure>
                                    <div class="overlay"><span class="icon fa fa-arrows-alt"></span></div>
                                </li>
                                <li class="thumb-box">
                                    <figure><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-thumb-1.jpg" alt="">
                                    </figure>
                                    <div class="overlay"><span class="icon fa fa-arrows-alt"></span></div>
                                </li>
                                <li class="thumb-box">
                                    <figure><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-thumb-2.jpg" alt="">
                                    </figure>
                                    <div class="overlay"><span class="icon fa fa-arrows-alt"></span></div>
                                </li>
                                <li class="thumb-box">
                                    <figure><img loading="lazy"
                                            src="{{asset('frontend/images/pages')}}/special-thumb-4.jpg" alt="">
                                    </figure>
                                    <div class="overlay"><span class="icon fa fa-arrows-alt"></span></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Specialize Section -->
</x-frontend-layout>