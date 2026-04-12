<x-backend-layout title="Edit Service">
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
        <h1 class="page-title fw-semibold fs-18 mb-0">Edit Service: {{ $service->title }}</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <!-- Basic Information -->
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">Basic Information</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Service Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $service->title) }}" required>
                            @error('title')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $service->slug) }}">
                            @error('slug')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control summernote" rows="5">{!! old('description', $service->description) !!}</textarea>
                            @error('description')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
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
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $service->seo->meta_title ?? '') }}">
                            @error('meta_title')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $service->seo->meta_description ?? '') }}</textarea>
                            @error('meta_description')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $service->seo->meta_keywords ?? '') }}" placeholder="Separate keywords with commas">
                            @error('meta_keywords')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="meta_image" class="form-label">Meta Image</label>
                            <input type="file" class="form-control" id="meta_image" name="meta_image" accept="image/*">
                            @if(!empty($service->seo->og_image))
                                <div class="mt-2">
                                    <img src="{{ asset($service->seo->og_image) }}" alt="Meta Image" class="img-thumbnail" style="max-height: 60px; width:auto">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_meta_image" id="remove_meta_image" value="1">
                                        <label class="form-check-label" for="remove_meta_image">
                                            Remove meta image
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @error('meta_image')
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

                        <label class="form-label">Service Images</label>
                        <div class="row g-3 mt-2" id="images-container">
                            <!-- Add New Image Card -->
                            <div class="col-md-3 col-sm-4 col-6 mb-3" id="add-btn-wrapper">
                                <label for="images" class="add-image-btn w-100 h-100 position-relative">
                                    <i class="ri-image-add-line fs-2 mb-1"></i>
                                    <span class="fs-12 fw-semibold">Add Images</span>
                                    <span class="selected-count position-absolute top-0 end-0 m-1"></span>
                                    <input type="file" id="images" name="media[]" multiple accept="image/*" class="d-none">
                                </label>
                            </div>

                            <!-- Existing Images -->
                            @foreach($service->media as $media)
                                <div class="col-md-3 col-sm-4 col-6 mb-3 text-center image-wrapper">
                                    <div class="image-container {{ $media->is_main ? 'default-image' : '' }}">
                                        <img src="{{ asset($media->path) }}" class="img-thumbnail">
                                        <div class="default-badge">Main</div>
                                        <input type="radio" name="is_main" class="form-check-input" value="{{ $media->id }}" {{ $media->is_main ? 'checked' : '' }}>
                                        <button type="button" class="delete-image" data-id="{{ $media->id }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Attachments -->
                        <div class="mb-3">
                            <label class="form-label">Attachments</label>
                            <div id="attachments-list">
                                @foreach($service->attachments as $attachment)
                                    <div class="d-flex align-items-center justify-content-center gap-2 py-1 attachment-row">
                                        <input type="text" name="existing_attachment_names[{{ $attachment->id }}]" 
                                            class="form-control" 
                                            value="{{ $attachment->name }}" 
                                            placeholder="Attachment name">

                                        <div class="form-text">
                                            <a href="{{ asset($attachment->path) }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </div>

                                        <!-- Direct file input styled as button -->
                                        <label class="btn btn-sm btn-outline-primary mb-0">
                                            <i class="ri-upload-cloud-line"></i>
                                            <input type="file" name="existing_attachment_files[{{ $attachment->id }}]" class="d-none" accept=".pdf,.doc,.docx,.jpg,.png">
                                        </label>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="delete_attachments[]" value="{{ $attachment->id }}" id="delete_attachment_{{ $attachment->id }}">
                                            <label class="form-check-label" for="delete_attachment_{{ $attachment->id }}">Delete</label>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-primary mt-2" id="add-attachment">
                                <i class="ri-add-line me-1"></i> Add New Attachment
                            </button>
                        </div>

                        <!-- Template for attachment row (hidden) -->
                        <template id="attachment-template">
                            <div class="d-flex align-items-center gap-2 py-1">
                                <input type="text" name="new_attachment_names[]" class="form-control" placeholder="Attachment name">
                                <input type="file" name="new_attachment_files[]" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png">
                                <button type="button" class="btn btn-icon btn-sm btn-danger-light remove-attachment">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Features -->
                <div class="card custom-card mt-3">
                    <div class="card-header">
                        <div class="card-title">Features</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="features">Select Features</label>
                            @if($features->count() > 0)
                                <select class="form-control" name="features[]" id="features" multiple>
                                    @foreach($features as $feature)
                                        <option value="{{ $feature->id }}" {{ in_array($feature->id, $service->features->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $feature->feature_name }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <p class="text-muted">No features available. <a href="{{ route('features.index') }}">Create one first</a>.</p>
                            @endif
                            @error('features')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
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
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}">
                            @error('sort_order')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" {{ old('status', $service->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $service->status) == 0 ? 'selected' : '' }}>Inactive</option>
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
                        <button type="submit" class="btn btn-primary w-100">Update Service</button>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary w-100 mt-2">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete-media-container"></div>
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

                if (document.getElementById('features')) {
                    new Choices('#features', {
                        removeItemButton: true,
                    });
                }
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

        <script>
            // Add attachment functionality
            $(function(){
                $('#add-attachment').on('click', function(){
                    const $row = $($('#attachment-template').html());
                    $('#attachments-list').append($row);

                    // Remove row
                    $row.find('.remove-attachment').on('click', function(){
                        $row.remove();
                    });
                });
            });
        </script>
    @endpush
</x-backend-layout>