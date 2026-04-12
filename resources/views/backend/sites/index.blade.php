<x-backend-layout title="Site Monitoring">
    @push('css')
        <!-- Datatables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    @endpush

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Site Monitoring</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sites</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <div class="card-title">Monitored Websites</div>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createSiteModal">Add Site</button>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="responsiveDataTable" class="table table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>URL</th>
                                    <th>Status</th>
                                    <th>Response Time</th>
                                    <th>Last Checked</th>
                                    <th>Alert Email</th>
                                    <th>Notified</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sites as $key => $site)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $site->name }}</td>
                                        <td><a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a></td>
                                        <td>
                                            @if($site->is_up)
                                                <span class="badge bg-success">UP</span>
                                            @else
                                                <span class="badge bg-danger">DOWN</span>
                                            @endif
                                        </td>
                                        <td>{{ $site->response_time_ms ? $site->response_time_ms . ' ms' : '-' }}</td>
                                        <td>{{ $site->last_checked_at ? $site->last_checked_at->diffForHumans() : 'Never' }}</td>
                                        <td>{{ $site->alert_email ?? 'User Default' }}</td>
                                        <td>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input toggle-notified" type="checkbox" data-id="{{ $site->id }}" {{ $site->is_down_notified ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                <button type="button"
                                                    class="btn btn-sm btn-warning-light btn-icon edit-site"
                                                    data-id="{{ $site->id }}"
                                                    data-name="{{ $site->name }}"
                                                    data-url="{{ $site->url }}"
                                                    data-alert_email="{{ $site->alert_email }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editSiteModal">
                                                    <i class="ri-pencil-line"></i>
                                                </button>
                                                <form action="{{ route('sites.destroy', $site->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger-light btn-icon"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No sites found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Site Modal -->
    <div class="modal fade" id="createSiteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add Website to Monitor</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('sites.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g., My Portfolio" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL</label>
                            <input type="url" name="url" class="form-control" placeholder="https://example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alert Email (Optional)</label>
                            <input type="email" name="alert_email" class="form-control" placeholder="Leave empty for default">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Site</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Site Modal -->
    <div class="modal fade" id="editSiteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Monitored Website</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('sites.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="edit_site_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" id="edit_site_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL</label>
                            <input type="url" name="url" id="edit_site_url" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alert Email (Optional)</label>
                            <input type="email" name="alert_email" id="edit_site_alert_email" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Site</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <!-- Datatables Cdn -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="{{ asset('backend/js/datatables.js') }}"></script>
        <script>
            $(document).on('click', '.edit-site', function() {
                $('#edit_site_id').val($(this).data('id'));
                $('#edit_site_name').val($(this).data('name'));
                $('#edit_site_url').val($(this).data('url'));
                $('#edit_site_alert_email').val($(this).data('alert_email'));
            });

            $(document).on('change', '.toggle-notified', function() {
                let id = $(this).data('id');
                let status = $(this).prop('checked') ? 1 : 0;
                
                $.ajax({
                    url: '{{ route("sites.toggle.notified") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        is_down_notified: status
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Notification status updated successfully');
                        }
                    },
                    error: function() {
                        alert('Something went wrong!');
                    }
                });
            });
        </script>
    @endpush
</x-backend-layout>
