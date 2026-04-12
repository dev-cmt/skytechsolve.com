@php
    $bgImage = asset('frontend/images/sliders/bg_hero.jpg');
    $mainTitle = data_get($page->content, 'slider.title', 'TEAMWORK MAKES THE DREAM WORK');
    $subTitle = data_get($page->content, 'slider.sub_title', 'WELCOME');
    $buttonText = data_get($page->content, 'slider.button_text', 'Explore');
    $buttonUrl = data_get($page->content, 'slider.button_url', '#');
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/intro-effect.css') }}">
@endpush

<style>
    /*--------------------------------------------------------------
        # Hero Section
    --------------------------------------------------------------*/
    .hero-section {
        width: 100%;
        height: 100vh;
        background-image: url({{ $bgImage }});
        background-color: rgba(17, 17, 17, 0.8);
        overflow: hidden;
        position: relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-section .hero-container {
        width: 100%;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hero-section .intro-wrapper {
        position: relative;
        z-index: 2;
    }

    #particles-js {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    @media (max-width: 768px) {
        .hero-section {
            height: auto;
            min-height: 80vh;
            padding: 100px 0;
            background-image: none;
            background: #DBDBDB;
        }
    }
</style>

<section class="hero-section">
    <div id="particles-js"></div>
    <div class="hero-container">
        <div class="intro-wrapper">
            <div class="intro-logo mb-4">
                <img loading="lazy" src="{{ asset($settings->logo_dark ?? 'images/logo_dark.png') }}" alt="Hero Logo"
                    style="max-height: 80px;">
            </div>

            <div class="intro-cover">
                <h1 class="intro-title">{!! nl2br(e($mainTitle)) !!}</h1>
            </div>

            <div class="intro-text">
                <span class="animate__animated animate__fadeInUp">
                    <h4>{{ $subTitle }}</h4>
                </span>
            </div>

            @if ($buttonText && $buttonUrl)
                <div class="mt-4">
                    <a href="{{ $buttonUrl }}"
                        class="theme-btn btn-style-one animate__animated animate__fadeInUp">{{ $buttonText }}</a>
                </div>
            @endif
        </div>
    </div>
</section>

@push('js')
    <script src="{{ asset('frontend/js/intro-effect.js') }}"></script>
    <script src="{{ asset('frontend/js/particles.min.js') }}"></script>
    <script src="{{ asset('frontend/js/particles-config.js') }}"></script>
@endpush