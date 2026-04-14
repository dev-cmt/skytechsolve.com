<x-backend-layout title="Sale Details">
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Sale Details</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sale Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Sale from {{ $sale->name ?? 'Unknown' }}</div>
                    <div><span class="badge bg-info">{{ ucfirst($sale->status) }}</span></div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <p class="fw-semibold mb-2">Subject:</p>
                        <p class="text-muted">{{ $sale->subject ?? '-' }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="fw-semibold mb-2">Note:</p>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($sale->message ?? '')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Product:</p>
                            <p class="text-muted mb-0">{{ optional($sale->product)->title ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Product ID:</p>
                            <p class="text-muted mb-0">{{ $sale->product_id ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Product Slug:</p>
                            <p class="text-muted mb-0">{{ optional($sale->product)->slug ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Plan:</p>
                            <p class="text-muted mb-0">{{ optional($sale->plan)->name ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Plan ID:</p>
                            <p class="text-muted mb-0">{{ $sale->plan_id ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Plan Price:</p>
                            <p class="text-muted mb-0">{{ optional($sale->plan)->price ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Email:</p>
                            <p class="text-muted mb-0">{{ $sale->email ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Phone:</p>
                            <p class="text-muted mb-0">{{ $sale->phone ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Created:</p>
                            <p class="text-muted mb-0">{{ $sale->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Source:</p>
                            <p class="text-muted mb-0">{{ $sale->source ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">IP Address:</p>
                            <p class="text-muted mb-0">{{ $sale->customer_ip ?? '-' }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <p class="fw-semibold mb-2">Contact ID:</p>
                            <p class="text-muted mb-0">{{ $sale->contact_id ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary-light">Back to List</a>
                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger-light" onclick="return confirm('Are you sure you want to delete this sale?')">Delete Sale</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card custom-card">
                <div class="card-header"><div class="card-title">Summary</div></div>
                <div class="card-body">
                    <p class="fs-14 fw-semibold mb-1">Status</p>
                    <div class="mb-3">
                        <form id="statusForm" class="d-flex gap-2">
                            @csrf
                            <select name="status" id="statusSelect" class="form-control form-control-sm" style="flex: 1;">
                                @foreach($statuses as $key => $label)
                                    <option value="{{ $key }}" {{ $sale->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <button type="button" id="updateStatusBtn" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </div>
                    <p class="fs-14 fw-semibold mb-1">Customer</p>
                    <p class="fs-12 text-muted mb-0">{{ $sale->name ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-backend-layout>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateBtn = document.getElementById('updateStatusBtn');
        const statusSelect = document.getElementById('statusSelect');
        const saleId = {{ $sale->id }};

        if (updateBtn) {
            updateBtn.addEventListener('click', function () {
                const newStatus = statusSelect.value;
                updateBtn.disabled = true;
                updateBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i>Updating...';

                fetch(`/sales/${saleId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateBtn.disabled = false;
                        updateBtn.innerHTML = 'Update';
                        showNotification('Status updated successfully!', 'success');
                    } else {
                        updateBtn.disabled = false;
                        updateBtn.innerHTML = 'Update';
                        showNotification('Failed to update status', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    updateBtn.disabled = false;
                    updateBtn.innerHTML = 'Update';
                    showNotification('An error occurred', 'error');
                });
            });
        }

        function showNotification(message, type) {
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
            alertDiv.setAttribute('role', 'alert');
            alertDiv.style.top = '20px';
            alertDiv.style.right = '20px';
            alertDiv.style.zIndex = '9999';
            alertDiv.style.minWidth = '300px';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;

            document.body.appendChild(alertDiv);
            setTimeout(() => alertDiv.remove(), 4000);
        }
    });
</script>
@endpush
