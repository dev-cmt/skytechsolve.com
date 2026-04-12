<x-frontend-layout :title="$team->name . ' - Professional Profile'" :breadcrumbs="$breadcrumbs" :seotags="$seotags">
    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('frontend/images/pages/bg-title.jpg')}});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ $team->name }}</h1>
                    <span class="title">{{ $team->position ?? 'Professional Expert' }}</span>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('page.teams') }}">Our Team</a></li>
                    <li>{{ $team->name }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Team Details Section -->
    <section class="team-details-section">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Image Column -->
                <div class="image-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="image-box">
                            <figure class="image"><img loading="lazy" src="{{ asset($team->image) }}" alt="{{ $team->name }}"></figure>
                            <ul class="social-links-two">
                                @if($team->facebook)
                                    <li><a href="{{ $team->facebook }}"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if($team->twitter)
                                    <li><a href="{{ $team->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                @endif
                                @if($team->linkedin)
                                    <li><a href="{{ $team->linkedin }}"><i class="fa fa-linkedin"></i></a></li>
                                @endif
                                @if($team->instagram)
                                    <li><a href="{{ $team->instagram }}"><i class="fa fa-instagram"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInRight">
                        <h2>{{ $team->name }}</h2>
                        <span class="designation">{{ $team->position ?? 'Team Member' }}</span>
                        
                        <div class="text">
                            @if($team->bio)
                                {!! nl2br(e($team->bio)) !!}
                            @else
                                <p>This professional is an integral part of our team, bringing years of expertise to every project. We are dedicated to delivering excellence in every aspect of our work.</p>
                            @endif
                        </div>

                        <div class="contact-info">
                            <h3>Contact Info</h3>
                            <ul class="info-list">
                                <li>
                                    <span class="icon fa fa-building"></span>
                                    <strong>Company:</strong> Sky Tech Solve
                                </li>
                                @if($team->linkedin)
                                <li>
                                    <span class="icon fa fa-linkedin"></span>
                                    <strong>LinkedIn:</strong> <a href="{{ $team->linkedin }}">View Profile</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        
                        <div class="btn-box">
                            <a href="{{ route('page.contact-us') }}" class="theme-btn btn-style-one">Get In Touch</a>
                            <a href="{{ route('page.teams') }}" class="theme-btn btn-style-two" style="margin-left: 20px;">View All Team</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Team Details Section -->

    @push('css')
    <style>
        /*--------------------------------------------------------------
            # Team Details Section
        --------------------------------------------------------------*/
        .team-details-section {
            position: relative;
            padding: 90px 0 100px;
            background-color: #ffffff;
        }

        .team-details-section .image-box {
            position: relative;
            padding: 10px;
            background: #f7f7f7;
            border-radius: 8px;
        }

        .team-details-section .image-box .image {
            position: relative;
            margin-bottom: 0;
            border-radius: 5px;
            overflow: hidden;
        }

        .team-details-section .image-box img {
            width: 100%;
            display: block;
        }

        .social-links-two {
            display: flex;
            justify-content: center;
            padding: 20px 0 10px;
            gap: 15px;
        }

        .social-links-two li a {
            width: 45px;
            height: 45px;
            background: #f1f1f1;
            color: #333333;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .social-links-two li a:hover {
            background: #ED5933;
            color: #ffffff;
            transform: translateY(-3px);
        }

        .team-details-section .content-column h2 {
            font-size: 36px;
            color: #111111;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .team-details-section .content-column .designation {
            display: block;
            font-size: 16px;
            color: #ED5933;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .team-details-section .content-column .text {
            font-size: 16px;
            line-height: 1.8;
            color: #666666;
            margin-bottom: 35px;
        }

        .contact-info {
            margin-bottom: 40px;
        }

        .contact-info h3 {
            font-size: 24px;
            color: #111111;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .info-list li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 15px;
            color: #666666;
        }

        .info-list li .icon {
            position: absolute;
            left: 0;
            top: 4px;
            color: #ED5933;
            font-size: 16px;
        }

        .info-list li strong {
            color: #111111;
            margin-right: 5px;
        }

        .info-list li a {
            color: #666666;
            transition: 0.3s;
        }

        .info-list li a:hover {
            color: #ED5933;
        }

        .team-details-section .btn-box {
            display: flex;
            align-items: center;
        }

        @media (max-width: 767px) {
            .team-details-section .btn-box {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            .team-details-section .btn-box .theme-btn {
                margin-left: 0 !important;
                width: 100%;
                text-align: center;
            }
        }
    </style>
    @endpush

</x-frontend-layout>
