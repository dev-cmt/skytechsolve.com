<x-frontend-layout title="Project Videos" :breadcrumbs="$breadcrumbs" :seotags="$seotags">
    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('frontend/images/pages/bg-title.jpg')}});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ data_get($page->content, 'header.title', 'Project Videos') }}</h1>
                    <span class="title">{{ data_get($page->content, 'header.subtitle', 'The Interior speak for themselves') }}</span>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Project Videos</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Start Video Section -->
    <section class="project-video-section py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Video 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/aqz-KE-bpKQ" title="YouTube video" allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Interior Design Project 1</h5>
                            <p class="card-text">A beautiful modern interior living space design.</p>
                        </div>
                    </div>
                </div>
                <!-- Video 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/ScMzIvxBSi4" title="YouTube video" allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Interior Design Project 2</h5>
                            <p class="card-text">Modern bedroom with minimalistic style and natural light.</p>
                        </div>
                    </div>
                </div>
                <!-- Video 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/TcMBFSGVi1c" title="YouTube video" allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Interior Design Project 3</h5>
                            <p class="card-text">Creative workspace with functional layout and natural colors.</p>
                        </div>
                    </div>
                </div>
                <!-- Add more videos as needed -->
            </div>
        </div>
    </section>
    <!-- End Video Section -->
</x-frontend-layout>

@push('styles')
<style>
    .project-video-section .card {
        border: none;
        transition: transform 0.3s ease;
    }
    .project-video-section .card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
