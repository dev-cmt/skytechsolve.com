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
                                    <th>Invoice #</th>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->invoice_no ?? '-' }}</td>
                                        <td>{{ $sale->name ?? '-' }}</td>
                                        <td>
                                            <div class="fw-semibold">{{ optional($sale->product)->title ?? '-' }}</div>
                                            <small class="text-muted">{{ optional($sale->plan)->name ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ number_format($sale->total_price, 2) }}</div>
                                            @if($sale->discount > 0)
                                                <small class="text-danger">Disc: {{ number_format($sale->discount, 2) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('sales.update-status', $sale->id) }}" method="POST" class="status-form">
                                                @csrf
                                                <select name="status" class="form-control form-control-sm status-change" style="width: 120px;">
                                                    @foreach($statuses as $key => $label)
                                                        <option value="{{ $key }}" {{ $sale->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <span class="badge {{ $sale->payment_status === 'paid' ? 'bg-success' : ($sale->payment_status === 'unpaid' ? 'bg-danger' : 'bg-warning') }}">
                                                {{ $paymentStatuses[$sale->payment_status] ?? $sale->payment_status }}
                                            </span>
                                            <div class="small text-muted">{{ $sale->payment_method ? ucfirst($sale->payment_method) : '' }}</div>
                                        </td>
                                        <td>{{ $sale->sale_date ? \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y') : $sale->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-info-light">View</a>
                                                <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-primary-light">Edit</a>
                                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger-light" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </div>
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
