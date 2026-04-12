<x-backend-layout title="Achievements Management">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Achievements Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Achievements</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Achievements List
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createAchievementModal">
                        <i class="ri-add-line me-1 fw-semibold align-middle"></i>Add New Achievement
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
                                    <th scope="col">Title</th>
                                    <th scope="col">Count</th>
                                    <th scope="col">Suffix</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($achievements as $key => $achievement)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $achievement->title }}</td>
                                    <td>{{ $achievement->count }}</td>
                                    <td>{{ $achievement->suffix ?? '' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $achievement->status == 'active' ? 'success' : 'danger' }}-transparent">
                                            {{ ucfirst($achievement->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <button type="button" class="btn btn-sm btn-warning-light btn-icon edit-achievement"
                                                data-id="{{ $achievement->id }}"
                                                data-title="{{ $achievement->title }}"
                                                data-count="{{ $achievement->count }}"
                                                data-suffix="{{ $achievement->suffix }}"
                                                data-status="{{ $achievement->status }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editAchievementModal">
                                                <i class="ri-pencil-line"></i>
                                            </button>
                                            <form action="{{ route('achievements.destroy', $achievement->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-light btn-icon" onclick="return confirm('Are you sure you want to delete this achievement?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No achievements found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $achievements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Achievement Modal -->
    <div class="modal fade" id="createAchievementModal" tabindex="-1" aria-labelledby="createAchievementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="createAchievementModalLabel">Create New Achievement</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('achievements.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="count" class="form-label">Count <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="count" name="count" required>
                        </div>
                        <div class="mb-3">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="suffix" name="suffix" placeholder="e.g., K, +">
                            <small class="form-text text-muted">Optional suffix like K for thousands, + symbol, etc.</small>
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
                        <button type="submit" class="btn btn-primary">Create Achievement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Achievement Modal -->
    <div class="modal fade" id="editAchievementModal" tabindex="-1" aria-labelledby="editAchievementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editAchievementModalLabel">Edit Achievement</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('achievements.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_count" class="form-label">Count <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="edit_count" name="count" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="edit_suffix" name="suffix">
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
                        <button type="submit" class="btn btn-primary">Update Achievement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        // Handle edit button click
        $(document).on('click', '.edit-achievement', function() {
            const id = $(this).data('id');
            const title = $(this).data('title');
            const count = $(this).data('count');
            const suffix = $(this).data('suffix');
            const status = $(this).data('status');

            $('#edit_id').val(id);
            $('#edit_title').val(title);
            $('#edit_count').val(count);
            $('#edit_suffix').val(suffix);
            $('#edit_status').val(status);
        });
    </script>
    @endpush
</x-backend-layout>
