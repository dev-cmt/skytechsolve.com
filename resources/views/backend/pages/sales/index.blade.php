<x-backend-layout title="Sales List">
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Sales List</h1>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Plan</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Source</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->iteration + $sales->firstItem() - 1 }}</td>
                                        <td>{{ $sale->name ?? '-' }}</td>
                                        <td>
                                            <div class="fw-semibold">{{ optional($sale->product)->title ?? '-' }}</div>
                                            <small class="text-muted">#{{ $sale->product_id ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ optional($sale->plan)->name ?? '-' }}</div>
                                            <small class="text-muted">{{ optional($sale->plan)->price ? 'Price: ' . optional($sale->plan)->price : 'No plan price' }}</small>
                                        </td>
                                        <td>{{ $sale->phone ?? '-' }}</td>
                                        <td>{{ $sale->email ?? '-' }}</td>
                                        <td>{{ $sale->source ?? '-' }}</td>
                                        <td>
                                            <form action="{{ route('sales.update-status', $sale->id) }}" method="POST" class="status-form">
                                                @csrf
                                                <select name="status" class="form-control form-control-sm status-change" style="width: 140px;">
                                                    @foreach($statuses as $key => $label)
                                                        <option value="{{ $key }}" {{ $sale->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td>{{ $sale->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-info">View</a>
                                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">No sales found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusChanges = document.querySelectorAll('.status-change');

            statusChanges.forEach(select => {
                select.addEventListener('change', function () {
                    const form = this.closest('.status-form');
                    if (form) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    @endpush
</x-backend-layout>
