<section class="banner-section">
    <div class="banner-carousel owl-carousel owl-theme">
        @forelse($sliders as $slider)
        <div class="slide-item" style="background-image: url({{ asset($slider->image) }});">
            <div class="auto-container">
                <div class="content-box">
                    <h2>{!! nl2br(e($slider->title)) !!}</h2>
                    <div class="text">{{ $slider->subtitle }}</div>
                    @if($slider->link_text && $slider->link_url)
                    <div class="link-box">
                        <a href="{{ $slider->link_url }}" class="theme-btn btn-style-one">{{ $slider->link_text }}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="slide-item" style="background-image: url({{ asset('frontend/images/sliders/slider-1.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <h2>Architecture is a <br> Visual Art.</h2>
                    <div class="text">The buildings speak for themselves</div>
                    <div class="link-box">
                        <a href="#" class="theme-btn btn-style-one">Check Art</a>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <div class="bottom-box">
        <div class="auto-container clearfix">
            <ul class="contact-info">
                <li><span>Phone :</span> <a href="tel:{{ $settings->phone ?? '+8801577298633' }}">{{ $settings->phone ?? '+8801577298633' }}</a></li>
                <li><span>EMAIL :</span> <a href="mailto:{{ $settings->email ?? 'skytechsolve@gmail.com' }}">{{ $settings->email ?? 'skytechsolve@gmail.com' }} </a></li>
            </ul>
        </div>
    </div>
</section>