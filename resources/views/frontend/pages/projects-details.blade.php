<x-frontend-layout title="{{ $project->title ?? 'Project Detail' }}" :breadcrumbs="$breadcrumbs" :seotags="$seotags">
    <!--Page Title-->
    <section class="page-title" style="background-image:url({{ asset('frontend/images/pages/bg-title.jpg') }});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1 class="mb-0">{{ $project->title ?? 'Project Detail' }}</h1>
                </div>
                <ul class="bread-crumb clearfix pt-0">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>{{ $project->title ?? 'Project Detail' }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->
    <!--Project Detail Section-->
    <section class="project-details-section">
        <div class="project-detail">
            <div class="auto-container">
                <!-- Upper Box -->
                <div class="upper-box mb-3">
                    <!-- Custom Image Gallery -->
                    <div class="custom-project-gallery">
                        @if(isset($project->media) && count($project->media) > 0)
                            <!-- Hidden Fancybox Gallery -->
                            <div style="display: none;">
                                @foreach($project->media as $index => $media)
                                    <a href="{{ asset($media->path) }}" data-fancybox="project-gallery"
                                        class="hidden-fancybox-link" data-index="{{ $index }}"></a>
                                @endforeach
                            </div>

                            <!-- Main Stage -->
                            <div class="gallery-main-stage mb-3">
                                <img id="mainGalleryImage" src="{{ asset($project->media[0]->path) }}"
                                    alt="Project Main Image">

                                <button class="gallery-zoom-btn" id="galleryZoomBtn" title="View Full Screen"><i
                                        class="fa fa-expand"></i></button>
                                <button class="gallery-nav-btn prev-btn" id="galleryPrevBtn"><i
                                        class="fa fa-angle-left"></i></button>
                                <button class="gallery-nav-btn next-btn" id="galleryNextBtn"><i
                                        class="fa fa-angle-right"></i></button>
                            </div>

                            <!-- Thumbnails -->
                            <div class="gallery-thumbnails-wrapper">
                                <div class="gallery-thumbnails" id="galleryThumbnails">
                                    @foreach($project->media as $index => $media)
                                        <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"
                                            data-src="{{ asset($media->path) }}">
                                            <img src="{{ asset($media->path) }}" alt="Thumbnail {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!--Lower Content-->
                <div class="lower-content">
                    <div class="row g-5">
                        <!--Content Column-->
                        <div class="col-lg-8 mb-5 mb-lg-0 pe-lg-4">
                            <h2>Project Overview</h2>
                            <div class="text-secondary fs-5" style="line-height: 1.8;">
                                {!! $project->description ?? '<p>No description available.</p>' !!}
                            </div>
                        </div>

                        <!--Info Column-->
                        <div class="col-lg-4">
                            <div class="wow fadeInRight">
                                <div class="card shadow border-0 rounded-4 mb-5">
                                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                                        <h4 class="fw-bold mb-0"><i class="fa fa-info-circle text-theme me-2"></i>
                                            Project Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="border-bottom px-0 py-2 d-flex justify-content-between align-items-center">
                                                <span class="text-muted"><i
                                                        class="fa fa-user me-2 border rounded-circle p-2 bg-theme-light text-theme"></i>
                                                    Client</span>
                                                <span
                                                    class="fw-semibold text-dark text-end">{{ $project->client_name ?? 'N/A' }}</span>
                                            </li>
                                            <li
                                                class="border-bottom px-0 py-2 d-flex justify-content-between align-items-center">
                                                <span class="text-muted"><i
                                                        class="fa fa-map-marker me-2 border rounded-circle p-2 bg-theme-light text-theme"></i>
                                                    Location</span>
                                                <span
                                                    class="fw-semibold text-dark text-end">{{ $project->location ?? 'N/A' }}</span>
                                            </li>
                                            <li class="border-bottom px-0 py-2">
                                                <div class="text-muted mb-2"><i
                                                        class="fa fa-code me-2 border rounded-circle p-2 bg-theme-light text-theme"></i>
                                                    Tech Stack</div>
                                                <div class="d-flex flex-wrap gap-1 mt-2">
                                                    @if($project->tech_stack)
                                                        @foreach(explode(',', $project->tech_stack) as $tech)
                                                            <span
                                                                class="badge bg-theme text-white rounded-pill fw-normal shadow-sm mx-1">{{ trim($tech) }}</span>
                                                        @endforeach
                                                    @else
                                                        <span class="badge bg-secondary rounded-pill fw-normal">N/A</span>
                                                    @endif
                                                </div>
                                            </li>
                                            <li
                                                class="border-bottom px-0 py-2 d-flex justify-content-between align-items-center">
                                                <span class="text-muted"><i
                                                        class="fa fa-calendar me-2 border rounded-circle p-2 bg-theme-light text-theme"></i>
                                                    Year</span>
                                                <span
                                                    class="fw-semibold text-dark text-end">{{ $project->launch_year ?? 'N/A' }}</span>
                                            </li>
                                            <li
                                                class="border-bottom px-0 py-2 d-flex justify-content-between align-items-center">
                                                <span class="text-muted"><i
                                                        class="fa fa-briefcase me-2 border rounded-circle p-2 bg-theme-light text-theme"></i>
                                                    Budget</span>
                                                <span
                                                    class="fw-semibold text-dark text-end">{{ $project->project_budget ? '$' . number_format($project->project_budget, 2) : 'N/A' }}</span>
                                            </li>
                                            <li
                                                class="border-bottom px-0 py-2 d-flex justify-content-between align-items-center border-0">
                                                <span class="text-muted"><i
                                                        class="fa fa-external-link me-2 border rounded-circle p-2 bg-theme-light text-theme"></i>
                                                    Demo</span>
                                                @if($project->live_link)
                                                    <a href="{{ $project->live_link }}" target="_blank"
                                                        class="btn btn-sm btn-outline-theme rounded-pill px-3 shadow-sm">View
                                                        Site <i class="fa fa-arrow-right ms-1"></i></a>
                                                @else
                                                    <span class="fw-semibold text-dark text-end">N/A</span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!--Help Box-->
                                <div class="help-box"
                                    style="background-image:url({{ asset('frontend/images/pages/bg-service-details.jpg') }})">
                                    <div class="inner">
                                        <span class="title">Quick Contact</span>
                                        <h2>Get Solution</h2>
                                        <div class="text">Contact us at the Interior office nearest to you or submit a
                                            business
                                            inquiry online.</div>
                                        <a class="theme-btn btn-style-three"
                                            href="{{route('page.contact-us')}}">Contact</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Portfolio Details-->

    @push('css')
        <style>
            .custom-project-gallery {
                width: 100%;
                position: relative
            }

            .gallery-main-stage {
                width: 100%;
                height: 600px;
                overflow: hidden;
                position: relative;
                background: #f8f9fa;
                box-shadow: 0 10px 30px rgba(0, 0, 0, .18)
            }

            .gallery-main-stage img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
                transition: opacity .4s ease-in-out
            }

            .gallery-main-stage img.fade-out {
                opacity: .3
            }

            .gallery-nav-btn {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: #222;
                border: none;
                width: 45px;
                height: 45px;
                font-size: 20px;
                color: #fff;
                cursor: pointer;
                transition: all .3s ease;
                z-index: 10;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 15px rgba(0, 0, 0, .1)
            }

            .gallery-nav-btn:hover {
                background: #ff5e14;
                color: #fff;
                transform: translateY(-50%) scale(1.1)
            }

            .gallery-nav-btn.prev-btn {
                left: 15px
            }

            .gallery-nav-btn.next-btn {
                right: 15px
            }

            .gallery-zoom-btn {
                position: absolute;
                top: 20px;
                right: 20px;
                background: rgba(0, 0, 0, .6);
                border: none;
                width: 45px;
                height: 45px;
                border-radius: 5px;
                font-size: 18px;
                color: #fff;
                cursor: pointer;
                transition: all .3s ease;
                z-index: 10;
                display: flex;
                align-items: center;
                justify-content: center
            }

            .gallery-zoom-btn:hover {
                background: #ff5e14;
                transform: scale(1.1)
            }

            .gallery-thumbnails-wrapper {
                width: 100%;
                overflow: hidden;
                padding: 10px 0;
                margin-top: 10px;
                background-color: #e9e9e9;
            }

            .gallery-thumbnails {
                display: flex;
                gap: 15px;
                overflow-x: auto;
                scrollbar-width: none;
                -ms-overflow-style: none;
                scroll-behavior: smooth
            }

            .gallery-thumbnails::-webkit-scrollbar {
                display: none
            }

            .thumbnail-item {
                min-width: 120px;
                height: 90px;
                margin-top: 2px;
                overflow: hidden;
                cursor: pointer;
                border: 3px solid transparent;
                opacity: .6;
                transition: all .3s ease
            }

            .thumbnail-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                pointer-events: none
            }

            .thumbnail-item:hover {
                opacity: .9;
                transform: translateY(-2px)
            }

            .thumbnail-item.active {
                opacity: 1;
                border-color: #ff5e14;
                box-shadow: 0 4px 15px rgba(255, 94, 20, .2)
            }

            /* Minimal CSS extensions to Bootstrap */
            .object-fit-cover {
                object-fit: cover;
                object-position: center;
            }

            .transition-opacity {
                transition: opacity 0.4s ease-in-out;
            }

            .opacity-30 {
                opacity: 0.3 !important;
            }

            .opacity-60 {
                opacity: 0.6;
            }

            .hover-opacity-100:hover {
                opacity: 1;
            }

            .btn-glass {
                background: rgba(255, 255, 255, 0.9);
            }

            .btn-glass:hover {
                background: #ff5e14;
                color: white !important;
            }

            .thumbnail-scroll::-webkit-scrollbar {
                display: none;
            }

            .thumb-active {
                opacity: 1 !important;
                border: 2px solid #ff5e14 !important;
                box-shadow: 0 4px 15px rgba(255, 94, 20, 0.2);
            }

            /* Theme Color Variables override */
            .text-theme {
                color: #ff5e14 !important;
            }

            .bg-theme {
                background-color: #ff5e14 !important;
            }

            .bg-theme-light {
                background-color: rgba(255, 94, 20, 0.1) !important;
            }

            .btn-outline-theme {
                color: #ff5e14;
                border-color: #ff5e14;
            }

            .btn-outline-theme:hover {
                background-color: #ff5e14;
                color: #fff;
            }

            @media (max-width: 991px) {
                .gallery-stage {
                    height: 450px !important;
                }
            }

            @media (max-width: 575px) {
                .gallery-stage {
                    height: 350px !important;
                }

                .thumbnail-item {
                    height: 75px !important;
                }

                .btn-glass {
                    width: 35px !important;
                    height: 35px !important;
                }
            }

            @media (max-width:991px) {
                .gallery-main-stage {
                    height: 450px
                }
            }

            @media (max-width:575px) {
                .gallery-main-stage {
                    height: 350px
                }

                .thumbnail-item {
                    min-width: 100px;
                    height: 75px
                }

                .gallery-nav-btn {
                    width: 35px;
                    height: 35px;
                    font-size: 16px
                }
            }
        </style>
    @endpush

    @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const mainImage = document.getElementById("mainGalleryImage");
                const thumbnails = document.querySelectorAll(".thumbnail-item");
                const hiddenLinks = document.querySelectorAll(".hidden-fancybox-link");
                const prevBtn = document.getElementById("galleryPrevBtn");
                const nextBtn = document.getElementById("galleryNextBtn");
                const zoomBtn = document.getElementById("galleryZoomBtn");
                const thumbnailsContainer = document.getElementById("galleryThumbnails");

                if (!mainImage || thumbnails.length === 0) return;

                let currentIndex = 0;
                const totalImages = thumbnails.length;

                function updateGallery(index) {
                    if (index < 0) index = totalImages - 1;
                    if (index >= totalImages) index = 0;
                    currentIndex = index;

                    const newSrc = thumbnails[currentIndex].getAttribute("data-src");

                    // Smooth fade transition
                    mainImage.classList.add("fade-out");
                    setTimeout(() => {
                        mainImage.src = newSrc;
                        mainImage.classList.remove("fade-out");
                    }, 200);

                    // Update thumbnail active state
                    thumbnails.forEach(t => t.classList.remove("active"));
                    const activeThumb = thumbnails[currentIndex];
                    activeThumb.classList.add("active");

                    // Auto scroll thumbnails horizontally to keep active in view
                    const scrollLeft = activeThumb.offsetLeft - (thumbnailsContainer.clientWidth / 2) + (activeThumb.clientWidth / 2);
                    thumbnailsContainer.scrollTo({ left: scrollLeft, behavior: 'smooth' });
                }

                thumbnails.forEach((thumb, index) => {
                    thumb.addEventListener("click", () => updateGallery(index));
                });

                if (prevBtn) prevBtn.addEventListener("click", () => updateGallery(currentIndex - 1));
                if (nextBtn) nextBtn.addEventListener("click", () => updateGallery(currentIndex + 1));
                if (zoomBtn) {
                    zoomBtn.addEventListener("click", () => {
                        if (hiddenLinks[currentIndex]) {
                            hiddenLinks[currentIndex].click();
                        }
                    });
                }
            });
        </script>
    @endpush
</x-frontend-layout>