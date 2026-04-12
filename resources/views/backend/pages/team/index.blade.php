<x-backend-layout title="Team Management">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Team Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Team</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Team List</div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createTeamModal">
                        <i class="ri-add-line me-1 fw-semibold align-middle"></i>Add New Member
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Social Links</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teams as $key => $team)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>
                                        @if($team->image)
                                            <img src="{{ asset($team->image) }}" class="img-thumbnail" width="50">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $team->name }}</td>
                                    <td>{{ $team->position }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @if($team->facebook)
                                                <a href="{{ $team->facebook }}" target="_blank" class="btn btn-sm btn-primary-light btn-icon">
                                                    <i class="ri-facebook-fill"></i>
                                                </a>
                                            @endif
                                            @if($team->twitter)
                                                <a href="{{ $team->twitter }}" target="_blank" class="btn btn-sm btn-info-light btn-icon">
                                                    <i class="ri-twitter-fill"></i>
                                                </a>
                                            @endif
                                            @if($team->instagram)
                                                <a href="{{ $team->instagram }}" target="_blank" class="btn btn-sm btn-danger-light btn-icon">
                                                    <i class="ri-instagram-fill"></i>
                                                </a>
                                            @endif
                                            @if($team->linkedin)
                                                <a href="{{ $team->linkedin }}" target="_blank" class="btn btn-sm btn-primary-light btn-icon">
                                                    <i class="ri-linkedin-fill"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $team->status == true ? 'success' : 'danger' }}-transparent">
                                            {{ $team->status == true ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <button type="button" class="btn btn-sm btn-warning-light btn-icon edit-team"
                                                data-id="{{ $team->id }}"
                                                data-name="{{ $team->name }}"
                                                data-position="{{ $team->position }}"
                                                data-bio="{{ $team->bio }}"
                                                data-facebook="{{ $team->facebook }}"
                                                data-twitter="{{ $team->twitter }}"
                                                data-instagram="{{ $team->instagram }}"
                                                data-linkedin="{{ $team->linkedin }}"
                                                data-status="{{ $team->status }}"
                                                data-image="{{ $team->image }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editTeamModal">
                                                <i class="ri-pencil-line"></i>
                                            </button>
                                            <form action="{{ route('team.destroy', $team->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-light btn-icon" onclick="return confirm('Are you sure you want to delete this team member?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center">No team members found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $teams->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Team Modal -->
    <div class="modal fade" id="createTeamModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Create New Team Member</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Position</label>
                                <input type="text" class="form-control" name="position" required>
                            </div>
                            {{-- <div class="col-md-6">
                                <label class="form-label">Bio</label>
                                <input type="text" id="bio" name="bio" class="form-control">
                            </div> --}}
                            <div class="col-md-6">
                                <label class="form-label">Profile Image</label>
                                <input type="file" class="form-control" name="image">
                                <small class="text-muted">Recommended Size: 320x480px</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Facebook URL</label>
                                <input type="url" class="form-control" name="facebook" placeholder="https://facebook.com/username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Twitter URL</label>
                                <input type="url" class="form-control" name="twitter" placeholder="https://twitter.com/username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Instagram URL</label>
                                <input type="url" class="form-control" name="instagram" placeholder="https://instagram.com/username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">LinkedIn URL</label>
                                <input type="url" class="form-control" name="linkedin" placeholder="https://linkedin.com/in/username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Team Modal -->
    <div class="modal fade" id="editTeamModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Team Member</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('team.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" id="edit_name" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Position</label>
                                <input type="text" id="edit_position" name="position" class="form-control" required>
                            </div>
                            {{-- <div class="col-md-6">
                                <label class="form-label">Bio</label>
                                <input type="text" id="edit_bio" name="bio" class="form-control">
                            </div> --}}
                            <div class="col-md-6">
                                <label class="form-label">Profile Image</label>
                                <input type="file" id="edit_image" name="image" class="form-control">
                                <small class="text-muted">Recommended Size: 320x480px</small>
                                <div id="currentImage" class="mt-2"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Facebook URL</label>
                                <input type="url" id="edit_facebook" name="facebook" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Twitter URL</label>
                                <input type="url" id="edit_twitter" name="twitter" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Instagram URL</label>
                                <input type="url" id="edit_instagram" name="instagram" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">LinkedIn URL</label>
                                <input type="url" id="edit_linkedin" name="linkedin" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select id="edit_status" name="status" class="form-select" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).on('click', '.edit-team', function() {
            $('#edit_id').val($(this).data('id'));
            $('#edit_name').val($(this).data('name'));
            $('#edit_position').val($(this).data('position'));
            $('#edit_bio').val($(this).data('bio'));
            $('#edit_facebook').val($(this).data('facebook'));
            $('#edit_twitter').val($(this).data('twitter'));
            $('#edit_instagram').val($(this).data('instagram'));
            $('#edit_linkedin').val($(this).data('linkedin'));
            $('#edit_status').val($(this).data('status'));

            const image = $(this).data('image');
            if (image) {
                $('#currentImage').html(`<small>Current Image:</small><br><img src="{{ asset('') }}${image}" width="60" class="img-thumbnail mt-1">`);
            } else {
                $('#currentImage').html('<span class="badge bg-secondary">No Image</span>');
            }
        });
    </script>
    @endpush

</x-backend-layout>