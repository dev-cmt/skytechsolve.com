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

        /* Pricing Plans Grid — PREMIER LOOK */
        .plans-grid {
            margin-top: 60px;
            padding: 60px 0;
            background: #f8f9fa;
            border-radius: 20px;
            margin-bottom: 40px;
        }
        .plans-grid .sec-title h2 {
            font-size: 32px;
            margin-bottom: 40px;
        }
        
        .plan-card {
            background: #fff;
            border: 1px solid #eee;
            padding: 50px 35px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            position: relative;
            z-index: 1;
        }
        .plan-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(237, 89, 51, 0.05) 0%, rgba(255, 255, 255, 0) 100%);
            border-radius: 20px;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        .plan-card:hover {
            border-color: #ED5933;
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(237, 89, 51, 0.1);
        }
        .plan-card:hover::before { opacity: 1; }

        .plan-card.is-popular {
            background: #222;
            color: #fff;
            border-color: #222;
            transform: scale(1.05);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        .plan-card.is-popular:hover {
            transform: scale(1.05) translateY(-5px);
        }
        
        .popular-label {
            position: absolute;
            top: 25px;
            right: -10px;
            background: #ED5933;
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            padding: 6px 15px;
            border-radius: 4px;
            text-transform: uppercase;
            box-shadow: 0 5px 15px rgba(237, 89, 51, 0.3);
        }
        
        .plan-card h4 { 
            font-size: 22px; 
            font-weight: 800; 
            margin-bottom: 25px; 
            text-transform: capitalize;
        }
        .plan-price { 
            font-size: 48px; 
            font-weight: 900; 
            color: #ED5933; 
            margin-bottom: 5px; 
            display: block;
        }
        .plan-duration { 
            font-size: 14px; 
            color: #888; 
            margin-bottom: 30px; 
            font-weight: 500;
        }
        .is-popular .plan-duration { color: #aaa; }

        .plan-features {
            list-style: none;
            padding: 0;
            margin: 0 0 40px;
            text-align: left;
        }
        .plan-features li {
            padding: 12px 0;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #555;
            transition: all 0.3s ease;
        }
        .is-popular .plan-features li { color: #ddd; }
        .plan-features li i { 
            color: #ED5933; 
            font-size: 14px; 
            background: rgba(237, 89, 51, 0.1);
            width: 24px; height: 24px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
        }
        .is-popular .plan-features li i { background: rgba(237, 89, 51, 0.2); }

        .plan-btn {
            width: 100%;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.3s ease;
            cursor: pointer;
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

        @media (max-width: 767px) {
            .product-detail .features-list { grid-template-columns: 1fr; }
            .product-detail h2 { font-size: 28px; }
            .plan-card { padding: 40px 20px; margin-bottom: 20px; }
        }
    </style>
    @endpush

    @php
        $displayImage   = ($product->media->where('is_main', 1)->first())
            ? asset($product->media->where('is_main', 1)->first()->path)
            : asset('frontend/images/resource/news-1.jpg');
        $productFeatures = $product->description
            ? array_filter(array_map('trim', explode("\n", strip_tags($product->description))))
            : [];
    @endphp

    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Main Content -->
                <div class="col-lg-10 col-md-12 col-sm-12 mx-auto">
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
                                            {!! Str::words(strip_tags($product->description), 50) !!}
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
                                        <div class="sec-title"><h2>Product Description</h2></div>
                                        <div class="text">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(count($productFeatures) > 0)
                            <div class="features-box full-width-features">
                                <h3>Core Features & Benefits</h3>
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
                                        <h2>Available Pricing Plans</h2>
                                        <p>Choose the perfect tier for your business growth</p>
                                    </div>
                                    <div class="row clearfix justify-content-center px-lg-5">
                                        @foreach($product->pricePlans as $plan)
                                            @php $planFeats = array_filter(array_map('trim', explode("\n", $plan->features ?: ''))); @endphp
                                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
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
                                                            <li><i class="fa fa-check"></i> {{ $pf }}</li>
                                                        @endforeach
                                                    </ul>

                                                    <button type="button" 
                                                            class="theme-btn {{ $plan->is_popular ? 'btn-style-one' : 'btn-style-three' }} plan-btn"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#purchaseModal"
                                                            data-plan="{{ $plan->name }}">
                                                        Select Plan
                                                    </button>
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

    <!-- Purchase Enquiry Modal (Placed at Root Level for max compatibility) -->
    <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                
                <!-- Success Message Overlay -->
                <div class="success-overlay" id="successOverlay">
                    <div class="success-icon"><i class="bx bxs-check-circle"></i></div>
                    <h3 class="mb-3">Enquiry Sent!</h3>
                    <p class="text-muted mb-4" id="successMessage">Thank you for your interest. We'll be in touch very soon.</p>
                    <button type="button" class="theme-btn btn-style-one" data-bs-dismiss="modal">Close</button>
                </div>

                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseModalLabel">
                        <i class="bx bx-shopping-bag me-2"></i> Purchase Enquiry: {{ $product->title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="purchaseEnquiryForm" class="enquiry-form-premium" action="{{ route('page.products.purchase', $product->slug) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Full Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Email Address *</label>
                                <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="+1 234 567 890">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Selected Plan</label>
                                @if($hasPricePlans)
                                    <select name="plan" id="modalPlanSelect" class="form-control">
                                        <option value="">Choose a Plan</option>
                                        @foreach($product->pricePlans as $plan)
                                            <option value="{{ $plan->name }}">{{ $plan->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" name="plan" value="{{ $product->title }}" class="form-control" readonly>
                                @endif
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Additional Requirements</label>
                                <textarea name="message" class="form-control" placeholder="Tell us about your specific needs..."></textarea>
                            </div>
                            <div class="col-md-12 text-center pt-3">
                                <button type="submit" class="theme-btn btn-style-five w-100 py-3" id="submitBtn">
                                    <span>Submit Enquiry</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Debug check for Bootstrap
            if (typeof bootstrap === 'undefined') {
                console.warn('Bootstrap JS is not loaded. Modal functionality might fail.');
            }

            const purchaseModal = document.getElementById('purchaseModal');
            const planSelect = document.getElementById('modalPlanSelect');
            const enquiryForm = document.getElementById('purchaseEnquiryForm');
            const submitBtn = document.getElementById('submitBtn');
            const successOverlay = document.getElementById('successOverlay');
            const successMessage = document.getElementById('successMessage');

            if (!purchaseModal) return;

            // Handle Modal Open - Population
            purchaseModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const planName = button.getAttribute('data-plan');
                
                if (planSelect && planName) {
                    planSelect.value = planName;
                }
                
                // Reset form and overlay
                enquiryForm.reset();
                enquiryForm.style.visibility = 'visible';
                successOverlay.classList.remove('is-visible');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Submit Enquiry</span>';
            });

            // Handle AJAX Submission
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
                        submitBtn.innerHTML = '<span>Submit Enquiry</span>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please check your connection.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span>Submit Enquiry</span>';
                });
            });
        });
    </script>
    @endpush

</x-frontend-layout>
