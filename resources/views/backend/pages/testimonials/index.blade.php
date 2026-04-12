<x-backend-layout title="Testimonials Management">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Testimonials Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Testimonials List
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createTestimonialModal">
                        <i class="ri-add-line me-1 fw-semibold align-middle"></i>Add New Testimonial
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
                                    <th scope="col">SL</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($testimonials as $key => $testimonial)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $testimonial->client_name }}</td>
                                    <td>{{ $testimonial->position }}</td>
                                    <td>{{ $testimonial->company }}</td>
                                    <td>
                                        @if($testimonial->image)
                                            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->client_name }}" class="img-thumbnail" width="50">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $testimonial->status == true ? 'success' : 'danger' }}-transparent">
                                            {{ $testimonial->status == true ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <button type="button" class="btn btn-sm btn-warning-light btn-icon edit-testimonial"
                                                data-id="{{ $testimonial->id }}"
                                                data-client_name="{{ $testimonial->client_name }}"
                                                data-position="{{ $testimonial->position }}"
                                                data-company="{{ $testimonial->company }}"
                                                data-content="{{ $testimonial->content }}"
                                                data-status="{{ $testimonial->status }}"
                                                data-image="{{ $testimonial->image }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editTestimonialModal">
                                                <i class="ri-pencil-line"></i>
                                            </button>
                                            <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-light btn-icon" onclick="return confirm('Are you sure you want to delete this testimonial?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No testimonials found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $testimonials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Testimonial Modal -->
    <div class="modal fade" id="createTestimonialModal" tabindex="-1" aria-labelledby="createTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="createTestimonialModalLabel">Create New Testimonial</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="client_name" class="form-label">Client Name</label>
                                    <input type="text" class="form-control" id="client_name" name="client_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input type="text" class="form-control" id="position" name="position" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company" class="form-label">Company</label>
                                    <input type="text" class="form-control" id="company" name="company" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Client Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    <small class="text-muted">Recommended Size: 120x120px</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Testimonial Content</label>
                            <textarea class="form-control" id="content" name="content" rows="4" maxlength="165" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Testimonial</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Testimonial Modal -->
    <div class="modal fade" id="editTestimonialModal" tabindex="-1" aria-labelledby="editTestimonialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editTestimonialModalLabel">Edit Testimonial</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('testimonials.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_client_name" class="form-label">Client Name</label>
                                    <input type="text" class="form-control" id="edit_client_name" name="client_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_position" class="form-label">Position</label>
                                    <input type="text" class="form-control" id="edit_position" name="position" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_company" class="form-label">Company</label>
                                    <input type="text" class="form-control" id="edit_company" name="company" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label">Client Image</label>
                                    <input type="file" class="form-control" id="edit_image" name="image">
                                    <small class="text-muted">Recommended Size: 120x120px</small>
                                    <div id="current_image" class="mt-2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_content" class="form-label">Testimonial Content</label>
                            <textarea class="form-control" id="edit_content" name="content" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Testimonial</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        // Handle edit button click
        $(document).on('click', '.edit-testimonial', function() {
            const id = $(this).data('id');
            const client_name = $(this).data('client_name');
            const position = $(this).data('position');
            const company = $(this).data('company');
            const content = $(this).data('content');
            const status = $(this).data('status');
            const image = $(this).data('image');

            $('#edit_id').val(id);
            $('#edit_client_name').val(client_name);
            $('#edit_position').val(position);
            $('#edit_company').val(company);
            $('#edit_content').val(content);
            $('#edit_status').val(status);

            // Display current image if available
            if (image) {
                $('#current_image').html(`<small>Current Image:</small><br>
                    <img src="{{ asset('') }}${image}" width="50" class="img-thumbnail mt-1">`);
            } else {
                $('#current_image').html('<span class="badge bg-secondary">No Image</span>');
            }

        });
    </script>
    @endpush

</x-backend-layout>