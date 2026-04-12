@php
    $recentPosts = \App\Models\BlogPost::where('status', 'published')
        ->latest('published_date')
        ->take(2)
        ->get();

    $recentProjects = \App\Models\Project::active()
        ->with('media')
        ->latest()
        ->take(6)
        ->get();
@endphp
<!-- Main Footer -->
<footer class="main-footer {{ request()->is('/') ? '' : 'alternate' }}" style="background-image: url({{asset('frontend')}}/images/pages/bg-ooter.jpg);">
    <div class="auto-container">
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="row">
                <!--Big Column-->
                <div class="big-column col-xl-7 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <!--Footer Column-->
                        <div class="footer-column col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget about-widget">
                                <div class="footer-logo">
                                    <figure>
                                        <a href="{{ url('/') }}">
                                            <img loading="lazy" src="{{asset($settings->logo_light ?? 'images/logo.png')}}" style="height: 80px; width: auto;" alt="">
                                        </a>
                                    </figure>
                                </div>
                                {{-- <div class="widget-content">
                                    <div class="text">
                                        {!! $settings->description ?? '' !!}
                                    </div>
                                </div> --}}
                                <div class="widget-content">
                                    <div class="footer-contact-info">
                                        <div class="contact-item">
                                            <div class="icon-box"><i class="fa fa-map-marker"></i></div>
                                            <div class="text-box">
                                                <span class="label">Location</span>
                                                <span>{{ $settings->address ?? 'Address' }}</span>
                                            </div>
                                        </div>
                                        <div class="contact-item">
                                            <div class="icon-box"><i class="fa fa-phone"></i></div>
                                            <div class="text-box">
                                                <span class="label">Phone</span>
                                                <a href="tel:{{ $settings->phone }}">{{ $settings->phone ?? 'Phone' }}</a>
                                            </div>
                                        </div>
                                        <div class="contact-item">
                                            <div class="icon-box"><i class="fa fa-envelope"></i></div>
                                            <div class="text-box">
                                                <span class="label">Email</span>
                                                <a href="mailto:{{ $settings->email }}">{{ $settings->email ?? 'Email' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="footer-column col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget recent-posts">
                                <h2 class="widget-title">Recent Posts</h2>
                                <!--Footer Column-->
                                <div class="widget-content">
                                    @foreach($recentPosts as $post)
                                    <div class="post">
                                        <div class="thumb">
                                            <a href="{{ route('page.blogs-details', $post->slug) }}">
                                                <img loading="lazy" src="{{ asset($post->main_image->path ?? 'frontend/images/resource/news-1.jpg') }}" alt="{{ $post->title }}">
                                            </a>
                                        </div>
                                        <h4><a href="{{ route('page.blogs-details', $post->slug) }}">{{ Str::limit($post->title, 40) }}</a></h4>
                                        <ul class="info">
                                            <li>{{ $post->published_date ? $post->published_date->format('d M') : $post->created_at->format('d M') }}</li>
                                            <li>{{ $post->comments_count ?? 0 }} Comments</li>
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Big Column-->
                <div class="big-column col-xl-5 col-lg-12 col-md-12 col-sm-12">
                    <div class="row clearfix">
                        <div class="footer-column col-xl-5 col-lg-6 col-md-6 col-sm-12">
                                <div class="footer-widget links-widget">
                                <h2 class="widget-title">Useful links</h2>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="{{ route('page.about-us') }}">About</a></li>
                                        <li><a href="{{ route('page.services') }}">Services</a></li>
                                        <li><a href="{{ route('page.projects') }}">Projects</a></li>
                                        <li><a href="{{ route('page.blogs') }}">News</a></li>
                                        <li><a href="{{ route('page.contact-us') }}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="footer-column col-xl-7 col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget gallery-widget">
                                <h2 class="widget-title">Recent Works</h2>
                                <div class="widget-content">
                                    <div class="outer clearfix">
                                        @foreach($recentProjects as $project)
                                            @php
                                                $projectImage = ($project->media->where('is_main', 1)->first()?->path) ?? 'frontend/images/resource/news-1.jpg';
                                            @endphp
                                            <figure class="image">
                                                <a href="{{ asset($projectImage) }}" class="lightbox-image" title="{{ $project->title }}">
                                                    <img loading="lazy" src="{{ asset($projectImage) }}" alt="{{ $project->title }}">
                                                </a>
                                            </figure>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Footer Bottom-->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="social-links">
                    <ul class="social-icon-two">
                        <li><a href="{{$settings->facebook ?? '#'}}"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{$settings->twitter ?? '#'}}"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="{{$settings->instagram ?? '#'}}"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="{{$settings->linkedin ?? '#'}}"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="{{$settings->youtube ?? '#'}}"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>

                <div class="copyright-text">
                    {!! $settings->copyright_text ?? '' !!}
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Main Footer -->
