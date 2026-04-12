<x-frontend-layout title="Our Team" :breadcrumbs="$breadcrumbs" :seotags="$seotags">
    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('frontend/images/pages/bg-title.jpg')}});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ data_get($page->content, 'header.title', 'Meet Our Team') }}</h1>
                    <span class="title">{{ data_get($page->content, 'header.subtitle', 'The Experts Behind Our Success') }}</span>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Our Team</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Team Section -->
    @if ($teams->isNotEmpty())
    <section class="team-section">
        <div class="auto-container">
            <div class="row clearfix">
                @foreach($teams as $team)
                    <!-- Team Block -->
                    <div class="team-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image">
                                    <a href="{{ route('page.teams-details', $team->slug) }}">
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
    @else
    <section class="team-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="title">Our Team</span>
                <h2>No Team Members Found</h2>
            </div>
        </div>
    </section>
    @endif
    <!--End Team Section-->

    <!-- Call to Action Section -->
    <section class="cta-section-v2" style="background-image: url({{ asset('frontend/images/pages/bg-process.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <h2>Join Our Passionate Team</h2>
                <p>We are always looking for talented individuals to create amazing spaces together.</p>
                <div class="btn-box">
                    <a href="{{ route('page.contact-us') }}" class="theme-btn btn-style-one">Contact Us</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call to Action Section -->

    @push('css')
    <style>
        /*--------------------------------------------------------------
            # CTA Section V2
        --------------------------------------------------------------*/
        .cta-section-v2 {
            position: relative;
            padding: 80px 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            text-align: center;
            color: #ffffff;
        }

        .cta-section-v2:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .cta-section-v2 .auto-container {
            position: relative;
            z-index: 1;
        }

        .cta-section-v2 h2 {
            font-size: 36px;
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .cta-section-v2 p {
            font-size: 18px;
            margin-bottom: 30px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 767px) {
            .cta-section-v2 h2 {
                font-size: 28px;
            }
        }
    </style>
    @endpush
</x-frontend-layout>



