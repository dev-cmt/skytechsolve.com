<x-backend-layout title="Edit Product">
    @push('css')
        <link rel="stylesheet" href="{{asset('backend/libs/summernote/summernote-lite.min.css')}}" />
        <style>
            .image-container {
                position: relative;
                border: 1px solid rgba(0,0,0,0.05);
                border-radius: 8px;
                overflow: hidden;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                cursor: pointer;
                background: #f8f9fa;
            }

            .image-container:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            }

            .default-image {
                border: 2px solid #845adf;
                box-shadow: 0 0 15px rgba(132, 90, 223, 0.3);
                background: rgba(132, 90, 223, 0.02);
            }

            .img-thumbnail {
                width: 100%;
                aspect-ratio: 1/1;
                object-fit: cover;
                border: none;
                padding: 0;
            }

            .default-badge {
                position: absolute;
                top: 8px;
                right: 8px;
                background: #845adf;
                color: #fff;
                padding: 4px 8px;
                border-radius: 6px;
                font-size: 10px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                z-index: 2;
                display: none;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }

            .image-container.new .default-badge {
                display: block;
                background: #23b7e5; /* Cyan for new */
            }

            .default-image .default-badge {
                display: block;
            }

            .remove-new, .delete-image {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: rgba(230, 70, 70, 0.9);
                color: white;
                border: none;
                height: 28px;
                font-size: 14px;
                transition: 0.2s;
                opacity: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10;
            }

            .image-container:hover .remove-new,
            .image-container:hover .delete-image {
                opacity: 1;
            }

            .add-image-btn {
                border: 2px dashed #ced4da;
                background: transparent;
                min-height: 120px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: #adb5bd;
                transition: 0.3s;
                border-radius: 8px;
                cursor: pointer;
            }

            .add-image-btn:hover {
                border-color: #845adf;
                color: #845adf;
                background: rgba(132, 90, 223, 0.05);
            }

            .plan-card {
                position: relative;
                background: #fff;
                border: 1px solid #e9ecef;
                border-radius: 12px;
                padding: 20px;
                margin-bottom: 20px;
                transition: 0.3s;
                box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            }

            .plan-card:hover {
                border-color: #845adf;
                box-shadow: 0 8px 16px rgba(132, 90, 223, 0.08);
            }

            .plan-card .remove-plan {
                position: absolute;
                top: -10px;
                right: -10px;
                width: 28px;
                height: 28px;
                border-radius: 50%;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                z-index: 100;
            }

            .plan-header {
                font-weight: 700;
                color: #495057;
                margin-bottom: 15px;
                padding-bottom: 10px;
                border-bottom: 1px solid #f8f9fa;
                display: flex;
                align-items: center;
            }

            .plan-header i {
                margin-right: 8px;
                color: #845adf;
            }

            .form-check-input[type="radio"] {
                display: none;
            }

            .selected-count {
                background: #845adf;
                color: white;
                padding: 2px 6px;
                border-radius: 4px;
                font-size: 10px;
                font-weight: 700;
            }
        </style>
        </style>
    @endpush

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Edit Product: {{ $product->title }}</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <!-- Basic Information -->
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">Product Information</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Product Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title', $product->title) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label">Product Type (e.g. SEO Tool, API)</label>
                                <input type="text" class="form-control" id="type" name="type"
                                    value="{{ old('type', $product->type) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle / Short Catchphrase</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle"
                                value="{{ old('subtitle', $product->subtitle) }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control summernote"
                                rows="5">{!! old('description', $product->description) !!}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Price Plans Integration -->
                <div class="card custom-card mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Price Plans</div>
                        <button type="button" class="btn btn-sm btn-success" id="add-plan">
                            <i class="ri-add-line me-1"></i> Add Plan
                        </button>
                    </div>
                    <div class="card-body" id="plans-container">
                        @foreach($product->pricePlans as $index => $plan)
                            <div class="plan-card">
                                <input type="hidden" name="plans[{{ $index }}][id]" value="{{ $plan->id }}">
                                <button type="button" class="btn btn-danger remove-plan">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                                <div class="plan-header">
                                    <i class="ri-price-tag-3-line"></i> Plan #{{ $index + 1 }}
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Plan Name</label>
                                        <input type="text" name="plans[{{ $index }}][name]" value="{{ $plan->name }}"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" name="plans[{{ $index }}][price]" value="{{ $plan->price }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Duration</label>
                                        <input type="text" name="plans[{{ $index }}][duration]"
                                            value="{{ $plan->duration }}" class="form-control" placeholder="Month">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Features (One per line)</label>
                                        <textarea name="plans[{{ $index }}][features]" class="form-control"
                                            rows="3">{{ $plan->features }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox"
                                                name="plans[{{ $index }}][is_popular]" value="1" {{ $plan->is_popular ? 'checked' : '' }}>
                                            <label class="form-check-label fs-12 fw-semibold">Mark as Popular</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Display Order</label>
                                        <input type="number" name="plans[{{ $index }}][sort_order]"
                                            value="{{ $plan->sort_order }}" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Status</label>
                                        <select name="plans[{{ $index }}][status]" class="form-select">
                                            <option value="1" {{ $plan->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $plan->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-center py-4 empty-plans-message"
                            style="{{ $product->pricePlans->count() > 0 ? 'display:none' : '' }}">
                            <p class="text-muted mb-0">No pricing plans added yet. Click "Add Plan" to create one.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Media -->
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">Media</div>
                    </div>
                    <div class="card-body">
                        <label for="images" class="form-label">Product Images</label>
                        <div class="row g-3 mt-2" id="images-container">
                            <!-- Add New Image -->
                            <div class="col-md-3 col-sm-4 col-6 mb-3" id="add-btn-wrapper">
                                <label for="images" class="add-image-btn w-100 h-100 position-relative">
                                    <i class="ri-image-add-line fs-2 mb-1"></i>
                                    <span class="fs-12 fw-semibold">Add Images</span>
                                    <span class="selected-count position-absolute top-0 end-0 m-1"></span>
                                    <input type="file" id="images" name="media[]" multiple accept="image/*" class="d-none">
                                </label>
                            </div>

                            <!-- Existing images -->
                            @foreach($product->media as $media)
                                <div class="col-md-3 col-sm-4 col-6 mb-3 text-center image-wrapper">
                                    <div class="image-container {{ $media->is_main ? 'default-image' : '' }}">
                                        <img src="{{ asset($media->path) }}" class="img-thumbnail">
                                        <div class="default-badge">Main</div>
                                        <input class="form-check-input" type="radio" name="is_main"
                                            value="{{ $media->id }}" {{ $media->is_main ? 'checked' : '' }}>
                                        <button type="button" class="delete-image" data-id="{{ $media->id }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- External Links & Pricing -->
                <div class="card custom-card mt-3">
                    <div class="card-header">
                        <div class="card-title">Order & Links</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="price" class="form-label">Display Price (Summary)</label>
                            <input type="text" class="form-control" id="price" name="price"
                                value="{{ old('price', $product->price) }}" placeholder="e.g. Starts from $49">
                        </div>
                        <div class="mb-3">
                            <label for="buy_link" class="form-label">External Buy/Demo Link</label>
                            <input type="url" class="form-control" id="buy_link" name="buy_link"
                                value="{{ old('buy_link', $product->buy_link) }}" placeholder="https://...">
                        </div>
                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order"
                                value="{{ old('sort_order', $product->sort_order) }}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card custom-card mt-3">
                    <div class="card-body text-center">
                        <button type="submit" class="btn btn-primary w-100">Update Product</button>
                        <a href="{{ route('products.index') }}" class="btn btn-light w-100 mt-2">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete-media-container"></div>
    </form>

    <!-- Plan Template -->
    <template id="plan-template">
        <div class="plan-card">
            <button type="button" class="btn btn-danger remove-plan">
                <i class="ri-delete-bin-line"></i>
            </button>
            <div class="plan-header">
                <i class="ri-price-tag-3-line"></i> Plan #<span class="plan-num">INDEX</span>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Plan Name</label>
                    <input type="text" name="plans[INDEX][name]" class="form-control"
                        placeholder="e.g. Basic Plan" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Price</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="text" name="plans[INDEX][price]" class="form-control" placeholder="29">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Duration</label>
                    <input type="text" name="plans[INDEX][duration]" class="form-control"
                        placeholder="Month">
                </div>
                <div class="col-md-12">
                    <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Features (One per line)</label>
                    <textarea name="plans[INDEX][features]" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-4">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="plans[INDEX][is_popular]" value="1">
                        <label class="form-check-label fs-12 fw-semibold">Mark as Popular</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Display Order</label>
                    <input type="number" name="plans[INDEX][sort_order]" class="form-control" value="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label fs-12 fw-bold text-uppercase opacity-75">Status</label>
                    <select name="plans[INDEX][status]" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </template>

    @push('js')
        <script src="{{asset('backend/libs/summernote/summernote-lite.min.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('.summernote').summernote({ height: 200 });

                let planIndex = {{ $product->pricePlans->count() }};
                const $container = $('#plans-container');

                $(document).on('click', '#add-plan', function (e) {
                    e.preventDefault();
                    $('.empty-plans-message').hide();

                    let source = $('#plan-template').html();
                    if (!source && document.getElementById('plan-template')) {
                        source = document.getElementById('plan-template').innerHTML;
                    }

                    if (source) {
                        let html = source.replace(/INDEX/g, planIndex);
                        let $html = $(html);
                        $html.find('.plan-num').text(planIndex + 1);
                        $container.append($html);
                        planIndex++;
                    }
                });

                $(document).on('click', '.remove-plan', function () {
                    $(this).closest('.plan-card').remove();
                    if ($container.find('.plan-card').length === 0) {
                        $('.empty-plans-message').show();
                    }
                });

                // Default Image Selection
                $(document).on('click', '.image-container', function () {
                    if ($(this).hasClass('add-new')) return;

                    $('.image-container').removeClass('default-image');
                    $(this).addClass('default-image');
                    $(this).find('input[type="radio"]').prop('checked', true);
                });

                // Image Deletion (UI Only, real delete on form submit)
                $(document).on('click', '.delete-image', function (e) {
                    e.stopPropagation();
                    const mediaId = $(this).data('id');
                    if (mediaId) {
                        $('#delete-media-container').append(`<input type="hidden" name="delete_media[]" value="${mediaId}">`);
                        $(this).closest('.image-wrapper').remove();
                    }
                });

                // Handle file input selection count and previews
                $('#images').on('change', function () {
                    const files = Array.from(this.files);
                    const $labelContainer = $(this).closest('.add-image-btn');
                    const $imgContainer = $('#images-container');
                    
                    // Clear previous new image previews since file input is replaced
                    $imgContainer.find('.image-wrapper.new-preview').remove();

                    $labelContainer.find('.selected-count').text(files.length ? files.length + ' selected' : '');

                    files.forEach(file => {
                        const reader = new FileReader();
                        reader.onload = e => {
                            const $div = $(`
                                <div class="col-md-3 col-sm-4 col-6 mb-3 text-center image-wrapper new-preview">
                                    <div class="image-container new">
                                        <img src="${e.target.result}" class="img-thumbnail">
                                        <div class="default-badge">New</div>
                                        <input type="radio" name="is_main" class="form-check-input" value="new_${Date.now()}_${Math.random().toString(36).substr(2, 9)}">
                                        <button type="button" class="remove-new"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                </div>
                            `).appendTo($imgContainer);

                            // Set default click handler for new images
                            $div.find('.image-container').on('click', function(e) {
                                if($(e.target).closest('.remove-new').length) return;
                                $imgContainer.find('.image-container').removeClass('default-image');
                                $(this).addClass('default-image').find('input[type="radio"]').prop('checked', true);
                            });

                            // Remove new image preview
                            $div.find('.remove-new').on('click', () => {
                                $div.remove();
                                if ($imgContainer.find('.default-image').length === 0) {
                                    const $first = $imgContainer.find('.image-container:not(.add-btn)').first();
                                    if ($first.length) {
                                        $first.addClass('default-image').find('input[type="radio"]').prop('checked', true);
                                    }
                                }
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                });
            });
        </script>
    @endpush
</x-backend-layout>