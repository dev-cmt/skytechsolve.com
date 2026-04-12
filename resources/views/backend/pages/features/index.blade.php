<x-backend-layout title="Features Management">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Features Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Features</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Features List
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createFeatureModal">
                        <i class="ri-add-line me-1 fw-semibold align-middle"></i>Add New Feature
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
                                    <th scope="col">Feature Name</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($features as $key => $feature)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $feature->feature_name }}</td>
                                    <td>
                                        <i class="{{ $feature->icon_class }} me-2"></i>
                                        {{ $feature->icon_class }}
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $feature->status == 'active' ? 'success' : 'danger' }}-transparent">
                                            {{ ucfirst($feature->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <button type="button" class="btn btn-sm btn-warning-light btn-icon edit-feature"
                                                data-id="{{ $feature->id }}"
                                                data-feature_name="{{ $feature->feature_name }}"
                                                data-icon_class="{{ $feature->icon_class }}"
                                                data-status="{{ $feature->status }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editFeatureModal">
                                                <i class="ri-pencil-line"></i>
                                            </button>
                                            <form action="{{ route('features.destroy', $feature->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-light btn-icon" onclick="return confirm('Are you sure you want to delete this feature?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No features found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $features->links('backend.pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Feature Modal -->
    <div class="modal fade" id="createFeatureModal" tabindex="-1" aria-labelledby="createFeatureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="createFeatureModalLabel">Create New Feature</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('features.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="feature_name" class="form-label">Feature Name</label>
                            <input type="text" class="form-control" id="feature_name" name="feature_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="icon_class" class="form-label">Icon Class</label>
                            <input type="text" class="form-control" id="icon_class" name="icon_class" placeholder="e.g., fas fa-swimming-pool">
                            <small class="form-text text-muted">Use FontAwesome or other icon library classes</small>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Feature</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Feature Modal -->
    <div class="modal fade" id="editFeatureModal" tabindex="-1" aria-labelledby="editFeatureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editFeatureModalLabel">Edit Feature</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('features.update') }}"method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="edit_feature_name" class="form-label">Feature Name</label>
                            <input type="text" class="form-control" id="edit_feature_name" name="feature_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_icon_class" class="form-label">Icon Class</label>
                            <input type="text" class="form-control" id="edit_icon_class" name="icon_class">
                            <small class="form-text text-muted">Use FontAwesome or other icon library classes</small>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Feature</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        // Handle edit button click
        $(document).on('click', '.edit-feature', function() {

            const id = $(this).data('id');
            const feature_name = $(this).data('feature_name');
            const icon_class = $(this).data('icon_class');
            const status = $(this).data('status');

            $('#edit_id').val(id);
            $('#edit_feature_name').val(feature_name);
            $('#edit_icon_class').val(icon_class);
            $('#edit_status').val(status);
        });
    </script>
    @endpush

</x-backend-layout>