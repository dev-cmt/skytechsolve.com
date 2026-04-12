<x-frontend-layout title="Projects" :breadcrumbs="$breadcrumbs" :seotags="$seotags">
    <!--Page Title-->
    <section class="page-title" style="background-image:url({{ asset('frontend/images/pages/bg-title.jpg') }});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ data_get($page->content, 'header.title', 'Projects') }}</h1>
                    <span
                        class="title">{{ data_get($page->content, 'header.subtitle', 'The Interior speak for themselves') }}</span>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Projects</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Projects Section -->
    <section class="projects-section alternate">
        <div class="auto-container">
            <div class="mixitup-gallery">

                <!-- Filter Tabs (Dynamic Categories) -->
                <div class="filters text-center clearfix">
                    <ul class="filter-tabs filter-btns clearfix">
                        <li class="active filter" data-filter="all">All</li>
                        @foreach($projects->pluck('category.category_name')->unique() as $cat)
                            <li class="filter" data-filter=".{{ Str::slug($cat) }}">{{ strtoupper($cat) }}</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Project Blocks -->
                <div class="filter-list row">
                    @foreach($projects as $project)
                        @php
                            $defaultMedia = $project->media->where('is_main', true)->first();
                            $imagePath = $defaultMedia ? asset($defaultMedia->path) : asset('images/placeholder.jpg');
                        @endphp

                        <div
                            class="project-block all mix {{ Str::slug($project->category->category_name ?? '') }} col-lg-4 col-md-6 col-sm-12">
                            <div class="image-box">
                                <figure class="image">
                                    <img loading="lazy" src="{{ $imagePath }}" alt="{{ $project->title }}">
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

            <!-- Pagination -->
            <div class="styled-pagination">
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
    <!--End Projects Section -->


    <!-- Contact Section -->
    <section class="contact-section">
        <div class="inner-container">
            <div class="sec-title">
                <span class="float-text">informaer</span>
                <h2>Contact Us</h2>
            </div>

            <div class="row">
                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <h4>Need Support</h4>
                        <ul class="contact-info">
                            <li>{{ $settings->address }}</li>
                            <li>
                                @if($settings->phone)
                                    {{ $settings->phone }}
                                @endif
                                @if($settings->phone2)
                                    <br> {{ $settings->phone2 }}
                                @endif
                            </li>
                            <li>
                                @if($settings->email)
                                    {{ $settings->email }}
                                @endif
                                @if($settings->email2)
                                    <br> {{ $settings->email2 }}
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="form-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- Contact Form -->
                        <div class="contact-form">
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

                            <form action="{{ route('page.contact-us.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}"
                                            required>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="text" name="phone" placeholder="Phone" required="">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="text" name="subject" placeholder="Subject"
                                            value="{{ old('subject') }}">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                            required="">
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <textarea name="message" placeholder="Massage"
                                            required>{{ old('message') }}</textarea>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <button class="theme-btn btn-style-three" type="submit"
                                            name="submit-form">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Contact Section -->
</x-frontend-layout>