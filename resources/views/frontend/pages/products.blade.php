<x-frontend-layout title="Our Products" :breadcrumbs="$breadcrumbs" :seotags="$seotags">

    @push('css')
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <style>
            /* =============================================
                       PRODUCTS PAGE – PREMIUM DESIGN
                    ============================================= */

            /* Page Title Override */
            .page-title {
                position: relative;
                overflow: hidden;
            }

            /* ---- Filter Bar ---- */
            .products-filter-bar {
                background: #fff;
                border-bottom: 1px solid #f0f0f0;
                position: sticky;
                top: 72px;
                z-index: 100;
                box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
            }

            .filter-inner {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 16px 0;
                flex-wrap: wrap;
            }

            .filter-btn {
                padding: 8px 22px;
                border-radius: 50px;
                border: 1.5px solid #e5e5e5;
                background: transparent;
                color: #555;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.25s ease;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .filter-btn:hover,
            .filter-btn.active {
                background: #845adf;
                border-color: #845adf;
                color: #fff;
                box-shadow: 0 4px 15px rgba(132, 90, 223, 0.35);
            }

            /* ---- Products Grid Section ---- */
            .products-section {
                background: linear-gradient(180deg, #f8f5ff 0%, #fdfdfd 100%);
                padding: 80px 0 100px;
            }

            .sec-title-pill {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: #f0e9ff;
                color: #845adf;
                padding: 6px 18px;
                border-radius: 50px;
                font-size: 12px;
                font-weight: 700;
                letter-spacing: 1px;
                text-transform: uppercase;
                margin-bottom: 16px;
            }

            .products-section .sec-title h2 {
                font-size: 38px;
                font-weight: 800;
                color: #1a1a2e;
            }

            .products-section .sec-title p {
                font-size: 16px;
                color: #777;
                max-width: 560px;
                margin: 0 auto;
            }

            /* ---- Product Card ---- */
            .product-card-wrap {
                margin-bottom: 40px;
            }

            .product-card {
                background: #fff;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.07);
                border: 1px solid #f0ecff;
                transition: transform 0.4s ease, box-shadow 0.4s ease;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .product-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 60px rgba(132, 90, 223, 0.18);
                border-color: #c9b3ff;
            }

            /* Image */
            .product-card__image {
                position: relative;
                overflow: hidden;
                aspect-ratio: 16/10;
            }

            .product-card__image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.6s ease;
            }

            .product-card:hover .product-card__image img {
                transform: scale(1.08);
            }

            /* Badge */
            .product-card__badge {
                position: absolute;
                top: 14px;
                left: 14px;
                background: linear-gradient(135deg, #845adf, #a97cf8);
                color: #fff;
                padding: 4px 14px;
                border-radius: 50px;
                font-size: 11px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                box-shadow: 0 4px 12px rgba(132, 90, 223, 0.4);
            }

            /* Plans count badge */
            .product-card__plans-badge {
                position: absolute;
                top: 14px;
                right: 14px;
                background: rgba(255, 255, 255, 0.95);
                color: #845adf;
                padding: 4px 12px;
                border-radius: 50px;
                font-size: 11px;
                font-weight: 700;
                display: flex;
                align-items: center;
                gap: 5px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            /* Overlay */
            .product-card__overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(180deg, transparent 40%, rgba(26, 26, 46, 0.85) 100%);
                display: flex;
                align-items: flex-end;
                justify-content: center;
                padding-bottom: 24px;
                opacity: 0;
                transition: opacity 0.35s ease;
            }

            .product-card:hover .product-card__overlay {
                opacity: 1;
            }

            .product-card__overlay-btn {
                padding: 10px 28px;
                border-radius: 50px;
                font-size: 13px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border: none;
                cursor: pointer;
                transition: all 0.25s ease;
                text-decoration: none;
            }

            .overlay-btn--detail {
                background: #fff;
                color: #845adf;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            }

            .overlay-btn--detail:hover {
                background: #845adf;
                color: #fff;
            }

            .overlay-btn--buy {
                background: linear-gradient(135deg, #845adf, #a97cf8);
                color: #fff;
                box-shadow: 0 4px 20px rgba(132, 90, 223, 0.5);
            }

            .overlay-btn--buy:hover {
                background: #fff;
                color: #845adf;
            }

            /* Body */
            .product-card__body {
                padding: 30px 24px 24px;
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            .product-card__icon {
                width: 58px;
                height: 58px;
                border-radius: 16px;
                background: linear-gradient(135deg, #845adf 0%, #a97cf8 100%);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 26px;
                margin: -50px auto 16px;
                position: relative;
                box-shadow: 0 8px 25px rgba(132, 90, 223, 0.35);
                border: 3px solid #fff;
                flex-shrink: 0;
            }

            .product-card__price-tag {
                text-align: center;
                font-size: 13px;
                font-weight: 700;
                color: #845adf;
                margin-bottom: 8px;
            }

            .product-card__title {
                text-align: center;
                font-size: 20px;
                font-weight: 800;
                color: #1a1a2e;
                margin-bottom: 8px;
                line-height: 1.3;
            }

            .product-card__subtitle {
                text-align: center;
                font-size: 14px;
                color: #777;
                line-height: 1.65;
                flex: 1;
                margin-bottom: 20px;
            }

            /* Action Footer */
            .product-card__footer {
                border-top: 1px solid #f5f0ff;
                padding-top: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }

            .btn-detail {
                display: inline-flex;
                align-items: center;
                gap: 7px;
                padding: 10px 24px;
                border-radius: 50px;
                font-size: 13px;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.3s ease;
                border: 2px solid #845adf;
                color: #845adf;
                background: transparent;
            }

            .btn-detail:hover {
                background: #845adf;
                color: #fff;
                box-shadow: 0 6px 20px rgba(132, 90, 223, 0.35);
            }

            .btn-buy {
                display: inline-flex;
                align-items: center;
                gap: 7px;
                padding: 10px 24px;
                border-radius: 50px;
                font-size: 13px;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.3s ease;
                background: linear-gradient(135deg, #845adf, #a97cf8);
                color: #fff;
                border: 2px solid transparent;
                box-shadow: 0 4px 18px rgba(132, 90, 223, 0.3);
            }

            .btn-buy:hover {
                background: #1a1a2e;
                color: #fff;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            }

            .btn-buy i,
            .btn-detail i {
                font-size: 14px;
            }

            /* Empty State */
            .products-empty {
                text-align: center;
                padding: 80px 20px;
            }

            .products-empty .empty-icon {
                font-size: 80px;
                color: #d4c6f7;
                margin-bottom: 20px;
            }

            .products-empty h3 {
                font-size: 22px;
                color: #555;
                margin-bottom: 10px;
            }

            .products-empty p {
                color: #999;
            }

            /* =============================================
                       PRICING PLANS SECTION
                    ============================================= */
            .pricing-section {
                padding: 100px 0;
                position: relative;
            }

            .pricing-section:nth-child(odd) {
                background: #f8f5ff;
            }

            .pricing-section:nth-child(even) {
                background: #fff;
            }

            .pricing-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, #845adf, #a97cf8, #845adf);
            }

            .pricing-header {
                text-align: center;
                margin-bottom: 60px;
            }

            .pricing-header .back-link {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                color: #845adf;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                margin-bottom: 24px;
                transition: gap 0.2s;
            }

            .pricing-header .back-link:hover {
                gap: 10px;
            }

            .pricing-header h2 {
                font-size: 36px;
                font-weight: 800;
                color: #1a1a2e;
                margin-bottom: 12px;
            }

            .pricing-header .pricing-desc {
                font-size: 16px;
                color: #777;
                max-width: 600px;
                margin: 0 auto;
            }

            /* Pricing Card */
            .pricing-card {
                background: #fff;
                border-radius: 20px;
                padding: 40px 30px 36px;
                border: 2px solid #f0ecff;
                position: relative;
                transition: all 0.35s ease;
                margin-bottom: 30px;
                height: calc(100% - 30px);
                display: flex;
                flex-direction: column;
            }

            .pricing-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 60px rgba(132, 90, 223, 0.15);
                border-color: #c9b3ff;
            }

            .pricing-card.is-popular {
                background: linear-gradient(160deg, #1a1a2e 0%, #2d1b69 100%);
                border-color: #845adf;
                color: #fff;
                transform: scale(1.04);
                box-shadow: 0 30px 80px rgba(132, 90, 223, 0.4);
            }

            .pricing-card.is-popular:hover {
                transform: scale(1.04) translateY(-8px);
            }

            .popular-ribbon {
                position: absolute;
                top: -1px;
                right: 24px;
                background: linear-gradient(135deg, #f7b731, #fd9644);
                color: #fff;
                font-size: 11px;
                font-weight: 800;
                padding: 6px 18px 10px;
                border-radius: 0 0 16px 16px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .pricing-card__name {
                font-size: 13px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                color: #845adf;
                margin-bottom: 16px;
            }

            .pricing-card.is-popular .pricing-card__name {
                color: #c9b3ff;
            }

            .pricing-card__price {
                display: flex;
                align-items: flex-end;
                gap: 4px;
                margin-bottom: 8px;
            }

            .pricing-card__price .currency {
                font-size: 22px;
                font-weight: 700;
                color: #1a1a2e;
                line-height: 1;
                margin-bottom: 10px;
            }

            .pricing-card.is-popular .pricing-card__price .currency {
                color: #fff;
            }

            .pricing-card__price .amount {
                font-size: 52px;
                font-weight: 900;
                color: #1a1a2e;
                line-height: 1;
            }

            .pricing-card.is-popular .pricing-card__price .amount {
                color: #fff;
            }

            .pricing-card__duration {
                font-size: 14px;
                color: #999;
                margin-bottom: 28px;
            }

            .pricing-card.is-popular .pricing-card__duration {
                color: #a08fbf;
            }

            .pricing-card__divider {
                height: 1px;
                background: #f0ecff;
                margin-bottom: 24px;
            }

            .pricing-card.is-popular .pricing-card__divider {
                background: rgba(255, 255, 255, 0.1);
            }

            .pricing-card__features {
                list-style: none;
                padding: 0;
                margin: 0 0 32px;
                flex: 1;
            }

            .pricing-card__features li {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                padding: 8px 0;
                font-size: 14px;
                color: #555;
                border-bottom: 1px dashed #f5f0ff;
            }

            .pricing-card.is-popular .pricing-card__features li {
                color: #ccc;
                border-bottom-color: rgba(255, 255, 255, 0.07);
            }

            .pricing-card__features li:last-child {
                border-bottom: none;
            }

            .pricing-card__features li .feat-icon {
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background: #f0e9ff;
                color: #845adf;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 10px;
                flex-shrink: 0;
                margin-top: 1px;
            }

            .pricing-card.is-popular .pricing-card__features li .feat-icon {
                background: rgba(132, 90, 223, 0.3);
                color: #c9b3ff;
            }

            .pricing-card__cta {
                display: block;
                text-align: center;
                padding: 14px 28px;
                border-radius: 50px;
                font-size: 14px;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.3s ease;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .cta-default {
                background: #f0e9ff;
                color: #845adf;
                border: 2px solid #f0e9ff;
            }

            .cta-default:hover {
                background: #845adf;
                color: #fff;
                border-color: #845adf;
                box-shadow: 0 6px 20px rgba(132, 90, 223, 0.4);
            }

            .cta-popular {
                background: linear-gradient(135deg, #845adf, #a97cf8);
                color: #fff;
                border: 2px solid transparent;
                box-shadow: 0 6px 25px rgba(132, 90, 223, 0.5);
            }

            .cta-popular:hover {
                background: #fff;
                color: #845adf;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            }

            /* Pricing Section Title ID anchor offset */
            .pricing-anchor {
                display: block;
                position: relative;
                top: -80px;
                visibility: hidden;
            }

            /* =============================================
                       CTA BANNER between sections
                    ============================================= */
            .products-cta-banner {
                background: linear-gradient(135deg, #1a1a2e 0%, #2d1b69 50%, #845adf 100%);
                padding: 70px 0;
                text-align: center;
            }

            .products-cta-banner h2 {
                font-size: 34px;
                font-weight: 800;
                color: #fff;
                margin-bottom: 14px;
            }

            .products-cta-banner p {
                font-size: 16px;
                color: rgba(255, 255, 255, 0.7);
                max-width: 520px;
                margin: 0 auto 30px;
            }

            .products-cta-banner .btn-cta {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 14px 36px;
                border-radius: 50px;
                background: #fff;
                color: #845adf;
                font-size: 15px;
                font-weight: 800;
                text-decoration: none;
                transition: all 0.3s ease;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            }

            .products-cta-banner .btn-cta:hover {
                background: linear-gradient(135deg, #845adf, #a97cf8);
                color: #fff;
                transform: translateY(-3px);
            }

            @media (max-width: 768px) {
                .pricing-card.is-popular {
                    transform: scale(1);
                }

                .pricing-card.is-popular:hover {
                    transform: translateY(-8px);
                }

                .products-section .sec-title h2 {
                    font-size: 28px;
                }

                .pricing-header h2 {
                    font-size: 26px;
                }
            }
        </style>
    @endpush

    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('frontend/images/pages/bg-title.jpg')}});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ $page && isset($page->content['header']['title']) ? $page->content['header']['title'] : 'Our Products' }}
                    </h1>
                    <span
                        class="title">{{ $page && isset($page->content['header']['subtitle']) ? $page->content['header']['subtitle'] : 'Powerful Tools & Software Solutions' }}</span>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Products</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Products Grid Section -->
    <section class="products-section">
        <div class="auto-container">

            <!-- Section Header -->
            <div class="sec-title centered" style="margin-bottom: 55px;">
                <div class="sec-title-pill"><i class="bx bx-package"></i> All Products</div>
                <h2>Explore Our Digital Products</h2>
                <p>Choose from our suite of premium tools and software crafted for growth, efficiency, and scale.</p>
            </div>

            <!-- Product Grid -->
            <div class="row">
                @forelse($products as $product)
                    @php
                        $hasPricePlans = $product->pricePlans->count() > 0;
                        $defaultMedia = $product->media->where('is_main', 1)->first();
                        $displayImage = $defaultMedia
                            ? asset($defaultMedia->path)
                            : ($product->image ? asset($product->image) : asset('frontend/images/resource/news-1.jpg'));
                        $plansCount = $product->pricePlans->count();
                    @endphp

                    <div class="col-lg-4 col-md-6 col-sm-12 product-card-wrap wow fadeInUp"
                        data-type="{{ $product->type }}">
                        <div class="product-card">

                            <!-- Image -->
                            <div class="product-card__image">
                                <img src="{{ $displayImage }}" alt="{{ $product->title }}" loading="lazy">

                                @if($product->type)
                                    <span class="product-card__badge">{{ $product->type }}</span>
                                @endif

                                @if($hasPricePlans)
                                    <span class="product-card__plans-badge">
                                        <i class="bx bx-layer"></i>
                                        {{ $plansCount }} {{ Str::plural('Plan', $plansCount) }}
                                    </span>
                                @endif

                                <!-- Hover Overlay -->
                                <div class="product-card__overlay">
                                    @if($hasPricePlans)
                                        <a href="{{ route('page.products-details', $product->slug) }}"
                                            class="product-card__overlay-btn overlay-btn--detail">
                                            <i class="fa fa-list-alt"></i> View Plans
                                        </a>
                                    @else
                                        <a href="{{ $product->buy_link ?? '#' }}"
                                            class="product-card__overlay-btn overlay-btn--buy" target="_blank" rel="noopener">
                                            <i class="fa fa-shopping-cart"></i> Buy Now
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="product-card__body">
                                <div class="product-card__icon">
                                    <span class="{{ $product->icon ?? 'bx bx-package' }}"></span>
                                </div>

                                @if($product->price)
                                    <div class="product-card__price-tag">
                                        {{ $hasPricePlans ? 'Plans from' : 'Price' }}: {{ $product->price }}
                                    </div>
                                @endif

                                <h3 class="product-card__title">{{ $product->title }}</h3>
                                <p class="product-card__subtitle">{{ Str::limit($product->subtitle, 90) }}</p>

                                <!-- Footer Buttons -->
                                <div class="product-card__footer">
                                    @if($hasPricePlans)
                                        <a href="{{ route('page.products-details', $product->slug) }}" class="btn-detail">
                                            <i class="bx bx-info-circle"></i> Details
                                        </a>
                                    @else
                                        <a href="{{ $product->buy_link ?? '#' }}" class="btn-buy" target="_blank"
                                            rel="noopener">
                                            <i class="bx bx-cart"></i> Buy Now
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="products-empty">
                            <div class="empty-icon"><i class="bx bx-package"></i></div>
                            <h3>No Products Available Yet</h3>
                            <p>Stay tuned! Our innovative products are coming soon.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- End Products Grid Section -->

    <!-- CTA Banner -->
    @if($products->isNotEmpty())
        <section class="products-cta-banner">
            <div class="auto-container">
                <h2>Not Sure Which Plan to Choose?</h2>
                <p>Our experts are here to guide you to the perfect solution for your business needs.</p>
                <a href="{{ route('page.contact-us') }}" class="btn-cta">
                    <i class="bx bx-support"></i> Talk to an Expert
                </a>
            </div>
        </section>
    @endif

</x-frontend-layout>