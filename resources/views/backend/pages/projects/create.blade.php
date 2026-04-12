<x-backend-layout title="Add New Project">
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
    @endpush
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Add New Project</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <!-- Basic Details -->
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">Basic Information</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Project Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control summernote" rows="5">{!! old('description') !!}</textarea>
                                @error('description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Info -->
                <div class="card custom-card mt-3">
                    <div class="card-header">
                        <div class="card-title">Project Information</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="client_name" class="form-label">Client Name</label>
                                <input type="text" class="form-control" id="client_name" name="client_name" value="{{ old('client_name') }}">
                                @error('client_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="location" class="form-label">Client Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                                @error('location')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="tech_stack" class="form-label">Tech Stack (e.g. PHP, Laravel, MySQL)</label>
                                <input type="text" class="form-control" id="tech_stack" name="tech_stack" value="{{ old('tech_stack') }}">
                                @error('tech_stack')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="launch_year" class="form-label">Launch Year</label>
                                <input type="number" class="form-control" id="launch_year" name="launch_year" value="{{ old('launch_year') }}">
                                @error('launch_year')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="project_budget" class="form-label">Project Budget</label>
                                <input type="text" class="form-control" id="project_budget" name="project_budget" value="{{ old('project_budget') }}">
                                @error('project_budget')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="live_link" class="form-label">Live Link / Demo URL</label>
                                <input type="text" class="form-control" id="live_link" name="live_link" value="{{ old('live_link') }}">
                                @error('live_link')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <!-- SEO -->
                <div class="card custom-card mt-3">
                    <div class="card-header">
                        <div class="card-title">SEO Information</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                            @error('meta_title')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="Separate keywords with commas">
                                @error('meta_keywords')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="meta_image" class="form-label">Meta Image</label>
                                <input type="file" class="form-control" id="meta_image" name="meta_image" accept="image/*">
                                @error('meta_image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
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
                        <!-- Add Image Card -->
                        <label for="images" class="form-label">Project Images</label>
                        <div class="row g-3 mt-2" id="images-container">
                            <div class="col-md-3 col-sm-4 col-6 mb-3" id="add-btn-wrapper">
                                <label for="images" class="add-image-btn w-100 h-100 position-relative">
                                    <i class="ri-image-add-line fs-2 mb-1"></i>
                                    <span class="fs-12 fw-semibold">Add Images</span>
                                    <span class="selected-count position-absolute top-0 end-0 m-1"></span>
                                    <input type="file" id="images" name="media[]" multiple accept="image/*" class="d-none">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <div class="card custom-card mt-3">
                    <div class="card-header">
                        <div class="card-title">Settings</div>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Actions -->
                <div class="card custom-card mt-3">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100">Save Project</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary w-100 mt-2">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('js')
        <script src="{{asset('backend/libs/summernote/summernote-lite.min.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('.summernote').summernote({
                    height: 150,
                });
                
                // Generate slug from title
                $('#title').on('keyup', function() {
                    const title = $(this).val();
                    if (title) {
                        $('#slug').val(title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, ''));
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                const $container = $('#images-container');

                // Default Image Selection
                $(document).on('click', '.image-container', function () {
                    if ($(this).hasClass('add-new')) return;

                    $('.image-container').removeClass('default-image');
                    $(this).addClass('default-image');
                    $(this).find('input[type="radio"]').prop('checked', true);
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
                            const isFirst = $imgContainer.find('.image-wrapper').length === 0;
                            const $div = $(`
                                <div class="col-md-3 col-sm-4 col-6 mb-3 text-center image-wrapper new-preview">
                                    <div class="image-container new ${isFirst ? 'default-image' : ''}">
                                        <img src="${e.target.result}" class="img-thumbnail">
                                        <div class="default-badge">Main</div>
                                        <input type="radio" name="is_main" class="form-check-input" value="new_${Date.now()}_${Math.random().toString(36).substr(2, 9)}" ${isFirst ? 'checked' : ''}>
                                        <button type="button" class="remove-new"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                </div>
                            `).appendTo($imgContainer);

                            // Set default click handler
                            $div.find('.image-container').on('click', function(e) {
                                if($(e.target).closest('.remove-new').length) return;
                                $imgContainer.find('.image-container').removeClass('default-image');
                                $(this).addClass('default-image').find('input[type="radio"]').prop('checked', true);
                            });

                            // Remove new image
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