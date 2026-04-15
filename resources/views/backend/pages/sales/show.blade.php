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
                    <div class="card-title">Sale Details: {{ $sale->invoice_no }}</div>
                    <div class="d-flex gap-2">
                        <span class="badge bg-primary">{{ $statuses[$sale->status] ?? $sale->status }}</span>
                        <span class="badge {{ $sale->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }}">{{ $paymentStatuses[$sale->payment_status] ?? $sale->payment_status }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Customer Info -->
                        <div class="col-md-6 mb-4">
                            <h6 class="fw-semibold mb-3 text-primary"><i class="ri-user-line me-2"></i>Customer Information</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless">
                                    <tr><td class="fw-medium" style="width: 120px;">Name:</td><td>{{ $sale->name ?? '-' }}</td></tr>
                                    <tr><td class="fw-medium">Email:</td><td>{{ $sale->email ?? '-' }}</td></tr>
                                    <tr><td class="fw-medium">Phone:</td><td>{{ $sale->phone ?? '-' }}</td></tr>
                                    <tr><td class="fw-medium">IP Address:</td><td>{{ $sale->customer_ip ?? '-' }}</td></tr>
                                    <tr><td class="fw-medium">Source:</td><td>{{ $sale->source ?? '-' }}</td></tr>
                                </table>
                            </div>
                        </div>

                        <!-- Product & Plan -->
                        <div class="col-md-6 mb-4">
                            <h6 class="fw-semibold mb-3 text-primary"><i class="ri-shopping-bag-line me-2"></i>Product Details</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless">
                                    <tr><td class="fw-medium" style="width: 120px;">Product:</td><td>{{ optional($sale->product)->title ?? '-' }}</td></tr>
                                    <tr><td class="fw-medium">Plan:</td><td>{{ optional($sale->plan)->name ?? '-' }}</td></tr>
                                    <tr><td class="fw-medium">Subject:</td><td>{{ $sale->subject ?? '-' }}</td></tr>
                                    <tr><td class="fw-medium">Sale Date:</td><td>{{ $sale->sale_date ? \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y') : '-' }}</td></tr>
                                    <tr><td class="fw-medium">Expiry Date:</td><td>{{ $sale->expaire_date ? \Carbon\Carbon::parse($sale->expaire_date)->format('M d, Y') : '-' }}</td></tr>
                                </table>
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div class="col-md-12 mb-4">
                            <h6 class="fw-semibold mb-3 text-primary"><i class="ri-wallet-line me-2"></i>Payment & Financials</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded text-center">
                                        <p class="text-muted mb-1 fs-12">Unit Price x Qty</p>
                                        <h5 class="fw-semibold mb-0">{{ number_format($sale->price, 2) }} x {{ $sale->quantity }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded text-center">
                                        <p class="text-muted mb-1 fs-12">Discount & Tax</p>
                                        <h5 class="fw-semibold mb-0 text-danger">-{{ number_format($sale->discount, 2) }}</h5>
                                        <small class="text-success">+{{ number_format($sale->tax, 2) }} Tax</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-primary-transparent rounded text-center">
                                        <p class="text-primary mb-1 fs-12">Total Amount</p>
                                        <h5 class="fw-bold mb-0 text-primary">{{ number_format($sale->total_price, 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <table class="table table-sm table-borderless">
                                    <tr><td class="fw-medium" style="width: 140px;">Payment Method:</td><td>{{ $paymentMethods[$sale->payment_method] ?? ($sale->payment_method ?? 'Not specified') }}</td></tr>
                                    <tr><td class="fw-medium">Transaction ID:</td><td><code>{{ $sale->transaction_id ?? 'N/A' }}</code></td></tr>
                                </table>
                            </div>
                        </div>

                        <!-- Message/Notes -->
                        <div class="col-md-12">
                            <h6 class="fw-semibold mb-3 text-primary"><i class="ri-chat-4-line me-2"></i>Inquiry & Notes</h6>
                            <div class="mb-3">
                                <label class="fs-12 fw-medium text-muted">Customer Message:</label>
                                <div class="p-3 border rounded bg-light-transparent">
                                    {!! nl2br(e($sale->message ?? 'No message')) !!}
                                </div>
                            </div>
                            @if($sale->notes)
                            <div>
                                <label class="fs-12 fw-medium text-muted">Internal Notes:</label>
                                <div class="p-3 border rounded border-warning-transparent">
                                    {!! nl2br(e($sale->notes)) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary-light">Back to List</a>
                        <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-primary">Edit Sale</a>
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
                <div class="card-header"><div class="card-title">Quick Actions</div></div>
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
                    
                    <hr>
                    
                    <div class="text-center">
                        <p class="fs-12 text-muted mb-2">Created at: {{ $sale->created_at->format('M d, Y') }}</p>
                        <button class="btn btn-sm btn-outline-info w-100" onclick="window.print()"><i class="ri-printer-line me-1"></i> Print Invoice</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Professional Invoice Print Area (Hidden on Screen) -->
    <div id="invoice-print-area" class="d-none">
        <div class="invoice-container">
            <div class="invoice-header">
                <div class="row align-items-center">
                    <div class="col-6">
                        @if($settings && $settings->logo)
                            <img src="{{ asset($settings->logo) }}" alt="Logo" class="invoice-logo">
                        @elseif($settings && $settings->logo_light)
                            <img src="{{ asset($settings->logo_light) }}" alt="Logo" class="invoice-logo">
                        @else
                            <h2 class="m-0 text-primary fw-bold">{{ $settings->company_name ?? config('app.name') }}</h2>
                        @endif
                        <p class="mt-2 mb-0 small text-muted">{{ $settings->description ?? '' }}</p>
                    </div>
                    <div class="col-6 text-end">
                        <h1 class="invoice-title text-primary">INVOICE</h1>
                        <div class="mt-2">
                            <p class="mb-0 fw-bold">Invoice #: <span class="text-muted fw-normal">{{ $sale->invoice_no }}</span></p>
                            <p class="mb-0 fw-bold">Date: <span class="text-muted fw-normal">{{ $sale->sale_date ? \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y') : $sale->created_at->format('M d, Y') }}</span></p>
                            <p class="mb-0 fw-bold">Status: <span class="text-muted fw-normal">{{ ucfirst($sale->payment_status) }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-2">

            <div class="invoice-address-section">
                <div class="row">
                    <div class="col-6">
                        <h6 class="text-uppercase fw-bold text-primary mb-2">Company Details:</h6>
                        <h5 class="fw-bold m-0">{{ $settings->company_name ?? config('app.name') }}</h5>
                        <p class="mb-0 text-muted">{!! nl2br(e($settings->address)) !!}</p>
                        @if($settings->phone) <p class="mb-0 text-muted">Phone: {{ $settings->phone }}</p> @endif
                        @if($settings->email) <p class="mb-0 text-muted">Email: {{ $settings->email }}</p> @endif
                    </div>
                    <div class="col-6 text-end">
                        <h6 class="text-uppercase fw-bold text-primary mb-2">Customer Details:</h6>
                        <h5 class="fw-bold m-0">{{ $sale->name ?? 'Valued Customer' }}</h5>
                        <p class="mb-0 text-muted">{{ $sale->email }}</p>
                        <p class="mb-0 text-muted">{{ $sale->phone }}</p>
                        @if($sale->subject)
                            <p class="mb-0 text-muted mt-2"><strong>Ref:</strong> {{ $sale->subject }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="invoice-table-section mt-5">
                <table class="table table-bordered invoice-table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-white">Description</th>
                            <th class="text-center text-white">Unit Price</th>
                            <th class="text-center text-white">Qty</th>
                            <th class="text-end text-white">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="fw-bold fs-15">{{ optional($sale->product)->title ?? 'Product/Service' }}</div>
                                <div class="small text-muted">{{ optional($sale->plan)->name ?? 'Order Enquiry' }}</div>
                                @if($sale->message)
                                    <div class="small mt-2 text-muted border-top pt-1"><em>Notes: {{ Str::limit($sale->message, 150) }}</em></div>
                                @endif
                            </td>
                            <td class="text-center">{{ number_format($sale->price, 2) }}</td>
                            <td class="text-center">{{ $sale->quantity }}</td>
                            <td class="text-end fw-bold">{{ number_format($sale->price * $sale->quantity, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="invoice-summary-section mt-4">
                <div class="row justify-content-end">
                    <div class="col-5">
                        <div class="card shadow-none border-0">
                            <div class="card-body p-0">
                                <table class="table table-sm table-borderless m-0">
                                    <tr>
                                        <td class="text-muted">Sub Total:</td>
                                        <td class="text-end fw-semibold">{{ number_format($sale->price * $sale->quantity, 2) }}</td>
                                    </tr>
                                    @if($sale->tax > 0)
                                    <tr>
                                        <td class="text-muted">Tax (+):</td>
                                        <td class="text-end fw-semibold text-success">{{ number_format($sale->tax, 2) }}</td>
                                    </tr>
                                    @endif
                                    @if($sale->discount > 0)
                                    <tr>
                                        <td class="text-muted">Discount (-):</td>
                                        <td class="text-end fw-semibold text-danger">{{ number_format($sale->discount, 2) }}</td>
                                    </tr>
                                    @endif
                                    <tr class="border-top-2">
                                        <td class="fw-bold fs-18 text-dark">Grand Total:</td>
                                        <td class="text-end fw-bold fs-18 text-primary">{{ number_format($sale->total_price, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="invoice-footer mt-5 pt-4 border-top">
                <div class="row align-items-end">
                    <div class="col-7">
                        <div class="bg-light p-3 rounded">
                            <h6 class="fw-bold mb-2">Information:</h6>
                            <p class="small text-muted mb-1"><strong>Payment Status:</strong> {{ $paymentStatuses[$sale->payment_status] ?? $sale->payment_status }}</p>
                            @if($sale->payment_method)
                                <p class="small text-muted mb-1"><strong>Method:</strong> {{ $paymentMethods[$sale->payment_method] ?? $sale->payment_method }}</p>
                            @endif
                            @if($sale->transaction_id)
                                <p class="small text-muted mb-0"><strong>Transaction ID:</strong> <code>{{ $sale->transaction_id }}</code></p>
                            @endif
                            <p class="small text-muted mt-2 mb-0"><em>* This is a computer generated invoice and requires no signature.</em></p>
                        </div>
                    </div>
                    <div class="col-5 text-center">
                        <div class="px-4">
                            @if($settings && $settings->company_name)
                                <p class="fw-bold mb-0 text-uppercase">{{ $settings->company_name }}</p>
                            @endif
                            <div class="border-top mt-4 pt-1">
                                <p class="small text-muted">Authorized By</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 no-print">
                 <p class="text-muted small">Generated on {{ date('M d, Y h:i A') }}</p>
            </div>
        </div>
    </div>

    <style>
        @media print {
            /* Basic resets */
            body {
                background-color: white !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            
            /* Hide everything except the print area */
            body * {
                visibility: hidden;
            }
            #invoice-print-area, #invoice-print-area * {
                visibility: visible;
            }
            #invoice-print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                display: block !important;
                background-color: white !important;
                color: #000 !important;
                padding: 40px !important;
                margin: 0 !important;
                overflow: visible !important;
            }
            
            /* Page break rules */
            .invoice-header, .invoice-address-section, .invoice-summary-section, .invoice-footer {
                page-break-inside: avoid;
                break-inside: avoid;
            }
            
            .invoice-table {
                width: 100%;
                border-collapse: collapse;
                page-break-inside: auto;
            }
            .invoice-table tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            .invoice-table thead {
                display: table-header-group; /* Repeat header on every page */
            }
            
            /* Font and color fixes for print */
            .text-primary { color: #4e5eef !important; }
            .bg-primary { background-color: #4e5eef !important; color: white !important; -webkit-print-color-adjust: exact; }
            .bg-light { background-color: #f8f9fa !important; -webkit-print-color-adjust: exact; }
            .text-white { color: #fff !important; }
            .badge { border: 1px solid #ddd !important; }

            /* Ensure grand total and signature are together if possible */
            .invoice-summary-section + .invoice-footer {
                page-break-before: auto;
            }

            @page {
                size: A4 portrait;
                margin: 0;
            }
        }

        .invoice-container {
            font-family: 'Inter', sans-serif;
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            color: #333;
        }
        .invoice-logo {
            max-height: 70px;
            width: auto;
            object-fit: contain;
        }
        .invoice-title {
            letter-spacing: 2px;
            font-weight: 800;
            margin: 0;
            font-size: 32px;
        }
        .invoice-table thead th {
            border: none;
            padding: 12px 15px;
            font-size: 13px;
            font-weight: 600;
        }
        .invoice-table tbody td {
            padding: 15px;
            border-color: #eee;
        }
        .border-top-2 {
            border-top: 2px solid #4e5eef !important;
        }
        .fs-15 { font-size: 15px; }
        .fs-18 { font-size: 18px; }
    </style>
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
