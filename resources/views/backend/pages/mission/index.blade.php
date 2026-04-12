<x-backend-layout title="Mission Management">
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Mission Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mission</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @php
                        $missionItems = is_array($mission->mission_items) ? $mission->mission_items : json_decode($mission->mission_items, true) ?? [];
                    @endphp

                    <form action="{{ route('mission.update') }}" method="POST" enctype="multipart/form-data" id="missionForm">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Mission Image</label>
                                <input type="file" class="form-control" name="image_path">
                                @if($mission->image_path)
                                    <div class="mt-2">
                                        <img src="{{ asset($mission->image_path) }}" width="120" class="rounded border">
                                        <p class="small text-muted mb-0">Current Image</p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="active" {{ $mission->status == 1 || $mission->status === true ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $mission->status === 0 || $mission->status === false ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">Mission Items</h5>
                            <button type="button" class="btn btn-sm btn-primary" id="addMissionItem">
                                <i class="ri-add-line me-1"></i> Add Item
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle" id="missionItemsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 20%">Icon
                                            <a class="badge bg-success" href="https://dev-cmt.github.io/fontawesome.com" target="_blank">click</a>
                                        </th>
                                        <th style="width: 20%">Title</th>
                                        <th>Description</th>
                                        <th style="width: 10%">Order</th>
                                        <th style="width: 15%">Status</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($missionItems as $index => $item)
                                        <tr class="mission-item">
                                            <td>{{ $index+1 }}</td>
                                            <td>
                                                <input type="text" class="form-control" name="mission_items[{{ $index }}][icon_class]" value="{{ $item['icon_class'] ?? '' }}" required>
                                                <small class="text-muted">e.g. fa-solid fa-star</small>
                                            </td>
                                            <td><input type="text" class="form-control" name="mission_items[{{ $index }}][title]" value="{{ $item['title'] ?? '' }}" required></td>
                                            <td><textarea class="form-control" rows="1" name="mission_items[{{ $index }}][description]" required>{{ $item['description'] ?? '' }}</textarea></td>
                                            <td><input type="number" class="form-control" name="mission_items[{{ $index }}][order]" value="{{ $item['order'] ?? $index+1 }}" required></td>
                                            <td>
                                                <select class="form-select" name="mission_items[{{ $index }}][status]" required>
                                                    <option value="active" {{ $item['status'] == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ $item['status'] == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger remove-item">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center">No mission items yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Mission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).ready(function() {
            let itemCount = {{ count($missionItems) }};

            // Add new row
            $('#addMissionItem').click(function() {
                const index = itemCount++;
                const row = `
                    <tr class="mission-item">
                        <td>${index+1}</td>
                        <td>
                            <input type="text" class="form-control" name="mission_items[${index}][icon_class]" value="fa-solid fa-" required>
                            <small class="text-muted">e.g. fa-solid fa-star</small>
                        </td>
                        <td><input type="text" class="form-control" name="mission_items[${index}][title]" required></td>
                        <td><textarea class="form-control" rows="1" name="mission_items[${index}][description]" required></textarea></td>
                        <td><input type="number" class="form-control" name="mission_items[${index}][order]" value="${index+1}" required></td>
                        <td>
                            <select class="form-select" name="mission_items[${index}][status]" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </td>
                        <td><button type="button" class="btn btn-sm btn-danger remove-item"><i class="ri-delete-bin-line"></i></button></td>
                    </tr>`;
                $('#missionItemsTable tbody').append(row);
            });

            // Remove row
            $(document).on('click', '.remove-item', function() {
                if($('#missionItemsTable tbody .mission-item').length > 1){
                    $(this).closest('tr').remove();
                } else {
                    alert("You must keep at least one mission item.");
                }
            });
        });
    </script>
    @endpush

</x-backend-layout>