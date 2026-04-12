<x-backend-layout title="Hero Sliders Management">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Hero Sliders Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hero Sliders</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Hero Sliders List
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createSliderModal">
                        <i class="ri-add-line me-1 fw-semibold align-middle"></i>Add New Slider
                    </button>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Order</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Subtitle</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->order }}</td>
                                    <td>
                                        @if($slider->image)
                                            <img src="{{ asset($slider->image) }}" alt="Slider Image" class="img-thumbnail" width="100">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $slider->title ?? '-' }}</td>
                                    <td>{{ $slider->subtitle ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $slider->status == 1 ? 'success' : 'danger' }}-transparent">
                                            {{ $slider->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <button type="button" class="btn btn-sm btn-warning-light btn-icon edit-slider"
                                                data-id="{{ $slider->id }}"
                                                data-title="{{ $slider->title }}"
                                                data-subtitle="{{ $slider->subtitle }}"
                                                data-link_text="{{ $slider->link_text }}"
                                                data-link_url="{{ $slider->link_url }}"
                                                data-status="{{ $slider->status }}"
                                                data-order="{{ $slider->order }}"
                                                data-image="{{ $slider->image }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editSliderModal">
                                                <i class="ri-pencil-line"></i>
                                            </button>
                                            <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-light btn-icon" onclick="return confirm('Are you sure you want to delete this slider?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No sliders found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Slider Modal -->
    <div class="modal fade" id="createSliderModal" tabindex="-1" aria-labelledby="createSliderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="createSliderModalLabel">Create New Slider</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Slider Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="image" name="image" required>
                                    <small class="text-muted">Recommended Size: 1920x800px</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Main Heading">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle (Text under heading)</label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Sub Heading">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="link_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="link_text" name="link_text" placeholder="e.g. Check Art">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="link_url" class="form-label">Button URL</label>
                                    <input type="text" class="form-control" id="link_url" name="link_url" placeholder="e.g. /about-us">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Slider Modal -->
    <div class="modal fade" id="editSliderModal" tabindex="-1" aria-labelledby="editSliderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editSliderModalLabel">Edit Slider</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sliders.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label">Slider Image</label>
                                    <input type="file" class="form-control" id="edit_image" name="image">
                                    <small class="text-muted">Recommended Size: 1920x800px</small>
                                    <div id="current_image" class="mt-2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="edit_title" name="title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="edit_subtitle" name="subtitle">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_link_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="edit_link_text" name="link_text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_link_url" class="form-label">Button URL</label>
                                    <input type="text" class="form-control" id="edit_link_url" name="link_url">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control" id="edit_order" name="order">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_status" class="form-label">Status</label>
                                    <select class="form-select" id="edit_status" name="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).on('click', '.edit-slider', function() {
            const id = $(this).data('id');
            const title = $(this).data('title');
            const subtitle = $(this).data('subtitle');
            const link_text = $(this).data('link_text');
            const link_url = $(this).data('link_url');
            const order = $(this).data('order');
            const status = $(this).data('status');
            const image = $(this).data('image');

            $('#edit_id').val(id);
            $('#edit_title').val(title);
            $('#edit_subtitle').val(subtitle);
            $('#edit_link_text').val(link_text);
            $('#edit_link_url').val(link_url);
            $('#edit_order').val(order);
            $('#edit_status').val(status);

            if (image) {
                $('#current_image').html(`<small>Current Image:</small><br>
                    <img src="{{ asset('') }}${image}" width="150" class="img-thumbnail mt-1">`);
            } else {
                $('#current_image').html('<span class="badge bg-secondary">No Image</span>');
            }
        });
    </script>
    @endpush

</x-backend-layout>
