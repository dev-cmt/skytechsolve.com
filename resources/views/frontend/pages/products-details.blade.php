<x-frontend-layout :title="$product->title . ' — Product Details'" :breadcrumbs="$breadcrumbs" :seotags="$seotags">

    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('frontend/images/pages/bg-title.jpg')}});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ $product->title }}</h1>
                    <span class="title">{{ $product->subtitle ?: 'Premium Digital Solution' }}</span>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{route('page.products')}}">Products</a></li>
                    <li>{{ Str::limit($product->title, 20) }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    @push('css')
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        /* =============================================
           PRODUCT DETAIL — PREMIUM REDESIGN
        ============================================= */

        :root {
            --product-accent: #ed5933;
            --product-accent-dark: #a02000;
            --product-accent-soft: #ffe8e0;
        }

        /* Override breadcrumb hover */
        .bread-crumb li a:hover { color: #ED5933 !important; }

        /* Sidebar Widgets Matching Site Style */
        .sidebar-widget .sidebar-title {
            font-size: 20px;
            font-weight: 700;
            color: #222;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ED5933;
            display: inline-block;
        }

        /* Product Gallery */
        .product-detail .image-box {
            margin-bottom: 30px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0,0,0,0.1);
            position: relative;
        }
        .product-detail .image-box::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0) 60%, rgba(0,0,0,0.4) 100%);
            pointer-events: none;
        }
        .product-detail .image-box img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.8s ease;
        }
        .product-detail .image-box:hover img { transform: scale(1.05); }

        /* Main Info */
        .product-detail h2 {
            font-size: 36px;
            font-weight: 800;
            color: #222;
            margin-bottom: 15px;
            letter-spacing: -0.5px;
        }
        .product-detail .type-tag {
            display: inline-block;
            background: rgba(237, 89, 51, 0.1);
            color: #ED5933;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 5px 15px;
            border-radius: 30px;
            margin-bottom: 15px;
        }

        .product-meta-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 25px;
            margin-bottom: 30px;
            padding: 20px 0;
            border-top: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
        }
        .meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #555;
        }
        .meta-item i { color: #ED5933; font-size: 20px; }
        .meta-item strong { color: #222; font-weight: 700; }

        /* Description */
        .product-detail .text {
            font-size: 16px;
            line-height: 1.8;
            color: #666;
            margin-bottom: 40px;
        }

        .description-box {
            background: #fff;
            border: 1px solid #efe3de;
            border-radius: 12px;
            padding: 30px 28px;
        }

        .section-block-title {
            font-size: 24px;
            font-weight: 800;
            color: #212529;
            margin-bottom: 18px;
            position: relative;
            padding-left: 16px;
        }

        .section-block-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: var(--product-accent);
            border-radius: 3px;
        }

        .description-box .text {
            margin-bottom: 0;
        }

        /* Feature List */
        .product-detail .features-box {
            margin: 40px 0;
            padding: 40px;
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        }
        .product-detail .features-box h3 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 30px;
            position: relative;
            padding-left: 20px;
        }
        .product-detail .features-box h3::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 4px; height: 20px;
            background: #ED5933;
            border-radius: 2px;
        }
        .product-detail .features-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            color: #444;
            padding: 12px 18px;
            background: #f9f9f9;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .feature-item:hover {
            background: #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }
        .feature-item i {
            color: #ED5933;
            font-size: 16px;
        }

        /* Pricing Plans Grid — Reference Styled */
        .plans-grid {
            margin-top: 60px;
            padding: 52px 28px;
            background: #f7f8fb;
            border: 1px solid #eceef5;
            border-radius: 10px;
            margin-bottom: 40px;
            width: 100%;
        }

        .plans-grid .sec-title {
            margin-bottom: 26px;
        }

        .plans-grid .sec-title h2 {
            font-size: 42px;
            margin-bottom: 8px;
            letter-spacing: -0.8px;
            color: #505463;
            font-weight: 600;
        }

        .plans-grid .sec-title p {
            margin-bottom: 0;
            color: #8a8f9f;
            font-size: 19px;
        }

        .plans-grid__row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
        }

        .plans-grid__item {
            min-width: 0;
            --tone: #6f7386;
        }

        .plans-grid__item:nth-child(2n) { --tone: #2ebf91; }
        .plans-grid__item:nth-child(3n) { --tone: #eb4f8a; }
        .plans-grid__item:nth-child(4n) { --tone: #5e6ad2; }
        .plans-grid__item .plan-card.is-popular { --tone: #2ebf91; }

        .plan-card {
            background: #fff;
            border: 1px solid #e8eaf2;
            padding: 30px 24px 24px;
            border-radius: 6px;
            text-align: center;
            transition: all 0.25s ease;
            height: 100%;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .plan-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--tone);
        }

        .plan-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 22px rgba(32, 46, 84, 0.08);
            border-color: #dfe3ee;
        }

        .plan-card.is-popular {
            border-color: #d5f1e7;
            box-shadow: 0 12px 24px rgba(46, 191, 145, 0.16);
        }

        .popular-label {
            position: absolute;
            top: 12px;
            right: -34px;
            width: 126px;
            background: #2ebf91;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            padding: 4px 0;
            text-transform: uppercase;
            transform: rotate(45deg);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
            z-index: 2;
        }

        .plan-card h4 {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 16px;
            text-transform: capitalize;
            color: #7a8091;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .plan-price {
            font-size: 54px;
            font-weight: 600;
            color: #454b5d;
            margin-bottom: 4px;
            display: block;
            line-height: 1.05;
        }

        .plan-duration {
            font-size: 15px;
            color: #9ba1b2;
            margin-bottom: 18px;
            font-weight: 600;
        }

        .plan-features {
            list-style: none;
            padding: 0;
            margin: 0 0 24px;
            text-align: left;
            flex: 1;
        }

        .plan-features li {
            padding: 7px 0;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #7f8494;
            transition: all 0.3s ease;
            border-bottom: 0;
        }

        .plan-features li i {
            color: #6f7386;
            font-size: 12px;
            background: transparent;
            width: 16px;
            height: 16px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 0;
        }

        .plans-grid__item .plan-card.is-popular .plan-features li i {
            color: #2ebf91;
        }

        .plan-features li.is-unchecked {
            color: #a9afbc;
            text-decoration: line-through;
            text-decoration-thickness: 1px;
        }

        .plan-features li.is-unchecked i {
            color: #d06b6b;
        }

        .plan-btn {
            width: 100%;
            padding: 11px 18px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-top: auto;
            border: 0;
            color: #fff;
            background: var(--tone);
            box-shadow: none;
        }

        .plan-btn:hover {
            filter: brightness(0.95);
            transform: translateY(-1px);
        }

        .plans-grid__item .plan-card.is-popular .plan-btn {
            background: #2ebf91;
        }

        /* Modal Premium Styling */
        .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,0.2);
        }
        .modal-header {
            background: #222;
            color: #fff;
            padding: 30px;
            border: none;
        }
        .modal-header .btn-close { filter: invert(1); opacity: 0.8; }
        .modal-body { padding: 40px; }

        .enquiry-form-premium .form-group { margin-bottom: 25px; }
        .enquiry-form-premium label {
            font-size: 14px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }
        .enquiry-form-premium .form-control {
            height: 55px;
            border: 2px solid #f0f0f0;
            border-radius: 10px;
            padding-left: 20px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        .enquiry-form-premium .form-control:focus {
            border-color: #ED5933;
            box-shadow: 0 0 10px rgba(237, 89, 51, 0.1);
        }
        .enquiry-form-premium textarea.form-control { height: 120px; padding-top: 15px; }

        /* Success Message Overlay */
        .success-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            z-index: 10;
            padding: 40px;
            visibility: hidden;
            opacity: 0;
            transition: all 0.5s ease;
        }
        .success-overlay.is-visible { visibility: visible; opacity: 1; }
        .success-icon {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
            transform: scale(0.5);
            transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .success-overlay.is-visible .success-icon { transform: scale(1); }

        /* Custom Modal Styling */
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1050;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .custom-modal-overlay.show {
            display: flex;
            opacity: 1;
        }

        .custom-modal {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 700px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            z-index: 1060;
            position: relative;
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(40px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .custom-modal-header {
            background: #222;
            color: #fff;
            padding: 25px 30px;
            border-radius: 16px 16px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
        }

        .custom-modal-header h5 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .custom-modal-close {
            background: none;
            border: none;
            color: #fff;
            font-size: 28px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.2s ease;
        }

        .custom-modal-close:hover {
            opacity: 0.7;
        }

        .custom-modal-body {
            padding: 35px 30px;
        }

        @media (max-width: 768px) {
            .custom-modal {
                width: 95%;
                max-height: 85vh;
            }
            .custom-modal-header {
                padding: 20px 20px;
            }
            .custom-modal-body {
                padding: 25px 20px;
            }
            .custom-modal-header h5 {
                font-size: 18px;
            }
        }

        @media (max-width: 1199px) {
            .plans-grid {
                padding: 38px 26px;
            }

            .plans-grid .sec-title h2 {
                font-size: 36px;
            }
        }

        @media (max-width: 991px) {
            .plans-grid .sec-title h2 {
                font-size: 32px;
            }
            .plans-grid__row {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767px) {
            .product-detail .features-list { grid-template-columns: 1fr; }
            .product-detail h2 { font-size: 28px; }
            .plans-grid { padding: 28px 16px; }
            .plans-grid .sec-title h2 { font-size: 30px; }
            .plans-grid .sec-title p { font-size: 16px; }
            .plans-grid__row { grid-template-columns: 1fr; }
            .plan-card { padding: 28px 18px; }
            .plan-price { font-size: 46px; }
            .description-box { padding: 24px 18px; }
            .section-block-title { font-size: 21px; }
        }

        /* Theme consistency overrides */
        .sidebar-widget .sidebar-title,
        .meta-item i,
        .feature-item i,
        .plan-price {
            color: var(--product-accent);
        }

        .product-detail .type-tag {
            background: var(--product-accent-soft);
            color: var(--product-accent);
        }

        .product-detail .features-box h3::before {
            background: var(--product-accent);
        }

        .plan-card:hover {
            border-color: #dfe3ee;
            box-shadow: 0 10px 22px rgba(32, 46, 84, 0.08);
        }

        .enquiry-form-premium .form-control:focus {
            border-color: var(--product-accent);
            box-shadow: 0 0 10px rgba(237, 89, 51, 0.16);
        }

        .related-products {
            margin-top: 60px;
            padding-top: 40px;
            border-top: 1px solid #f0e1dc;
        }

        .related-products h3 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 24px;
        }

        .related-card {
            background: #fff;
            border: 1px solid #f5d6cd;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            height: 100%;
        }

        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 35px rgba(237, 89, 51, 0.14);
            border-color: #efb8a8;
        }

        .related-card img {
            width: 100%;
            height: 190px;
            object-fit: cover;
        }

        .related-card .inner {
            padding: 18px;
        }

        .related-card h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .related-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 14px;
        }

        .related-card a {
            color: var(--product-accent);
            font-weight: 700;
            text-decoration: none;
        }

        .related-card a:hover {
            color: var(--product-accent-dark);
        }
    </style>
    @endpush

    @php
        $hasPricePlans = $product->pricePlans && $product->pricePlans->isNotEmpty();
        $displayImage   = ($product->media->where('is_main', 1)->first())
            ? asset($product->media->where('is_main', 1)->first()->path)
            : asset('frontend/images/resource/news-1.jpg');

        $productFeatures = collect();

        // Prefer checked features from active price plans for this section.
        if ($hasPricePlans) {
            $productFeatures = $product->pricePlans
                ->where('status', 1)
                ->flatMap(function ($plan) {
                    return collect(preg_split('/\r\n|\r|\n/', $plan->features ?? ''))
                        ->map(fn($line) => trim($line))
                        ->filter()
                        ->map(function ($line) {
                            $included = true;
                            $text = $line;

                            if (preg_match('/^\[\s*\]\s*/', $line)) {
                                $included = false;
                                $text = trim(preg_replace('/^\[\s*\]\s*/', '', $line));
                            } elseif (preg_match('/^\[(x|X)\]\s*/', $line)) {
                                $included = true;
                                $text = trim(preg_replace('/^\[(x|X)\]\s*/', '', $line));
                            } elseif (preg_match('/^-\s+/', $line)) {
                                $included = false;
                                $text = trim(preg_replace('/^-\s+/', '', $line));
                            } elseif (preg_match('/^\+\s+/', $line)) {
                                $included = true;
                                $text = trim(preg_replace('/^\+\s+/', '', $line));
                            }

                            return ['included' => $included, 'text' => $text];
                        })
                        ->filter(fn($item) => $item['included'] && !empty($item['text']))
                        ->pluck('text');
                })
                ->map(fn($t) => trim($t))
                ->filter(fn($t) => mb_strlen($t) > 2)
                ->unique()
                ->values();
        }

        // Fallback: extract list items from description if no checked plan features found.
        if ($productFeatures->isEmpty() && !empty($product->description)) {
            preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $product->description, $liMatches);
            if (!empty($liMatches[1])) {
                $productFeatures = collect($liMatches[1])
                    ->map(fn($li) => trim(strip_tags($li)))
                    ->filter(fn($t) => mb_strlen($t) > 2)
                    ->unique()
                    ->values();
            }
        }
    @endphp

    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Main Content -->
                <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                    <div class="product-detail">
                        <div class="inner-box">

                            <div class="row clearfix mb-5">
                                <!-- Product Image -->
                                <div class="col-lg-6 col-md-12 mb-4">
                                    <figure class="image-box">
                                        <img src="{{ $displayImage }}" alt="{{ $product->title }}">
                                    </figure>
                                </div>
                                <!-- Product Basic Info -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="ps-lg-4">
                                        @if($product->type)
                                            <span class="type-tag">{{ $product->type }}</span>
                                        @endif
                                        <h2>{{ $product->title }}</h2>

                                        <div class="product-meta-row mt-4">
                                            <div class="meta-item"><i class="bx bx-package"></i> Solution: <strong>{{ $product->type ?: 'Digital' }}</strong></div>
                                            @if($product->price)
                                                <div class="meta-item"><i class="bx bx-purchase-tag"></i> Starting: <strong>{{ $product->price }}</strong></div>
                                            @endif
                                            <div class="meta-item"><i class="bx bx-check-shield"></i> <strong>Verified Asset</strong></div>
                                        </div>

                                        <div class="text mt-4">
                                            {{ Str::words(strip_tags($product->subtitle), 50) }}
                                        </div>

                                        <div class="mt-4">
                                            <a href="#plans-section" class="theme-btn btn-style-one py-3 px-5">View Pricing Plans</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-12">
                                    <div class="description-box mb-5">
                                        <h3 class="section-block-title">Product Description</h3>
                                        <div class="text">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($productFeatures->isNotEmpty())
                            <div class="features-box full-width-features">
                                <h3 class="section-block-title">Core Features & Benefits</h3>
                                <div class="features-list">
                                    @foreach($productFeatures as $feat)
                                        <div class="feature-item">
                                            <i class="fa fa-check-circle"></i>
                                            <span>{{ $feat }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Pricing Plans Grid -->
                            @if($hasPricePlans)
                                <div class="plans-grid" id="plans-section">
                                    <div class="sec-title text-center">
                                        <h2>Choose a plan</h2>
                                        <p>Give your team the features they need to succeed.</p>
                                    </div>
                                    <div class="plans-grid__row">
                                        @foreach($product->pricePlans as $plan)
                                            @php
                                                $planFeats = collect(preg_split('/\r\n|\r|\n/', $plan->features ?? ''))
                                                    ->map(fn($line) => trim($line))
                                                    ->filter()
                                                    ->map(function ($line) {
                                                        $included = true;
                                                        $text = $line;

                                                        if (preg_match('/^\[\s*\]\s*/', $line)) {
                                                            $included = false;
                                                            $text = trim(preg_replace('/^\[\s*\]\s*/', '', $line));
                                                        } elseif (preg_match('/^\[(x|X)\]\s*/', $line)) {
                                                            $included = true;
                                                            $text = trim(preg_replace('/^\[(x|X)\]\s*/', '', $line));
                                                        } elseif (preg_match('/^-\s+/', $line)) {
                                                            $included = false;
                                                            $text = trim(preg_replace('/^-\s+/', '', $line));
                                                        } elseif (preg_match('/^\+\s+/', $line)) {
                                                            $included = true;
                                                            $text = trim(preg_replace('/^\+\s+/', '', $line));
                                                        }

                                                        return ['included' => $included, 'text' => $text];
                                                    });
                                            @endphp
                                            <div class="plans-grid__item">
                                                <div class="plan-card {{ $plan->is_popular ? 'is-popular' : '' }}">
                                                    @if($plan->is_popular)
                                                        <div class="popular-label">Most Popular</div>
                                                    @endif
                                                    <h4>{{ $plan->name }}</h4>
                                                    <div class="plan-price">{{ $plan->price ?: 'Contact' }}</div>
                                                    @if($plan->duration)
                                                        <div class="plan-duration">per {{ $plan->duration }}</div>
                                                    @endif

                                                    <ul class="plan-features">
                                                        @foreach($planFeats as $pf)
                                                            <li class="{{ $pf['included'] ? '' : 'is-unchecked' }}">
                                                                <i class="fa {{ $pf['included'] ? 'fa-check' : 'fa-times' }}"></i>
                                                                {{ $pf['text'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                    <button type="button"
                                                            class="theme-btn {{ $plan->is_popular ? 'btn-style-one' : 'btn-style-three' }} plan-btn open-purchase-modal"
                                                            data-plan-id="{{ $plan->id }}"
                                                            data-plan-name="{{ $plan->name }}"
                                                            data-plan-price="{{ $plan->price }}">
                                                        Get Product
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($relatedProducts->isNotEmpty())
                                <div class="related-products">
                                    <h3>Related Products</h3>
                                    <div class="row">
                                        @foreach($relatedProducts as $related)
                                            @php
                                                $relatedImage = ($related->media->where('is_main', 1)->first())
                                                    ? asset($related->media->where('is_main', 1)->first()->path)
                                                    : asset('frontend/images/resource/news-1.jpg');
                                            @endphp
                                            <div class="col-lg-4 col-md-6 mb-4">
                                                <div class="related-card">
                                                    <img src="{{ $relatedImage }}" alt="{{ $related->title }}" loading="lazy">
                                                    <div class="inner">
                                                        <h4>{{ $related->title }}</h4>
                                                        <p>{{ Str::limit($related->subtitle ?: strip_tags($related->description), 80) }}</p>
                                                        <a href="{{ route('page.products-details', $related->slug) }}">View Details <i class="fa fa-arrow-right ms-1"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Custom Purchase Enquiry Modal -->
    <div class="custom-modal-overlay" id="purchaseModalOverlay">
        <div class="custom-modal">
            <!-- Success Message Overlay -->
            <div class="success-overlay" id="successOverlay">
                <div class="success-icon"><i class="bx bxs-check-circle"></i></div>
                <h3 class="mb-3">Enquiry Sent!</h3>
                <p class="text-muted mb-4" id="successMessage">Thank you for your interest. We'll be in touch very soon.</p>
                <button type="button" class="theme-btn btn-style-one close-purchase-modal">Close</button>
            </div>

            <div class="custom-modal-header">
                <h5>
                    <i class="bx bx-shopping-bag"></i> Purchase Enquiry: {{ $product->title }}
                </h5>
                <button type="button" class="custom-modal-close close-purchase-modal" aria-label="Close">
                    ×
                </button>
            </div>
            <div class="custom-modal-body">
                <form id="purchaseEnquiryForm" class="enquiry-form-premium" action="{{ route('page.products.purchase', $product->slug) }}" method="POST">
                    @csrf
                    <input type="hidden" name="source" value="product_pricing_modal">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="plan_id" id="modalPlanId" value="">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Full Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+1 234 567 890">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email Address *</label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Selected Plan</label>
                            @if($hasPricePlans)
                                <select id="modalPlanSelect" class="form-control">
                                    <option value="">Choose a Plan</option>
                                    @foreach($product->pricePlans as $plan)
                                        <option value="{{ $plan->id }}" data-plan-name="{{ $plan->name }}" data-plan-price="{{ $plan->price }}">{{ $plan->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" value="{{ $product->title }}" class="form-control" readonly>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Note</label>
                            <textarea name="note" class="form-control" placeholder="Tell us about your specific needs..."></textarea>
                        </div>
                        <div class="col-md-12 text-center pt-3">
                            <button type="submit" class="theme-btn btn-style-five w-100 py-3" id="submitBtn">
                                <span>Get Product</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalOverlay = document.getElementById('purchaseModalOverlay');
            const planSelect = document.getElementById('modalPlanSelect');
            const planIdInput = document.getElementById('modalPlanId');
            const enquiryForm = document.getElementById('purchaseEnquiryForm');
            const submitBtn = document.getElementById('submitBtn');
            const successOverlay = document.getElementById('successOverlay');
            const successMessage = document.getElementById('successMessage');

            if (!modalOverlay) return;

            // Open modal
            function openModal(planId = null, planName = null, planPrice = null) {
                enquiryForm.reset();
                enquiryForm.style.visibility = 'visible';
                successOverlay.classList.remove('is-visible');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Get Product</span>';

                if (planIdInput) planIdInput.value = planId || '';
                if (planSelect && planId) planSelect.value = planId;

                modalOverlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            // Close modal
            function closeModal() {
                modalOverlay.classList.remove('show');
                document.body.style.overflow = '';
            }

            // Handle button clicks
            document.querySelectorAll('.open-purchase-modal').forEach(btn => {
                btn.addEventListener('click', function () {
                    const planId = this.getAttribute('data-plan-id');
                    const planName = this.getAttribute('data-plan-name');
                    const planPrice = this.getAttribute('data-plan-price');
                    openModal(planId, planName, planPrice);
                });
            });

            // Close button clicks
            document.querySelectorAll('.close-purchase-modal').forEach(btn => {
                btn.addEventListener('click', closeModal);
            });

            // Close on overlay click
            modalOverlay.addEventListener('click', function (e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            // Close on Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && modalOverlay.classList.contains('show')) {
                    closeModal();
                }
            });

            // Handle plan select change
            if (planSelect) {
                planSelect.addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    if (planIdInput) planIdInput.value = this.value || '';
                });
            }

            // Handle form submission
            enquiryForm.addEventListener('submit', function (e) {
                e.preventDefault();

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i> Sending...';

                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        successMessage.innerText = data.message;
                        enquiryForm.style.visibility = 'hidden';
                        successOverlay.classList.add('is-visible');
                    } else {
                        alert('Something went wrong. Please try again.');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<span>Get Product</span>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please check your connection.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span>Get Product</span>';
                });
            });
        });
    </script>
    @endpush

</x-frontend-layout>
