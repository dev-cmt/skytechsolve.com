<x-backend-layout title="Edit Sale">
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Edit Sale: {{ $sale->invoice_no }}</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Sale</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ route('sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-8">
                <div class="card custom-card">
                    <div class="card-header"><div class="card-title">Customer & Order Details</div></div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label class="form-label">Customer Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $sale->name) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Customer Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $sale->email) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Customer Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $sale->phone) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" value="{{ old('subject', $sale->subject) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Product</label>
                                <select name="product_id" class="form-control">
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id', $sale->product_id) == $product->id ? 'selected' : '' }}>{{ $product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price Plan</label>
                                <select name="plan_id" class="form-control">
                                    <option value="">Select Plan</option>
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}" {{ old('plan_id', $sale->plan_id) == $plan->id ? 'selected' : '' }}>{{ $plan->name }} ({{ $plan->price }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Customer Message</label>
                                <textarea name="message" class="form-control" rows="3">{{ old('message', $sale->message) }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Internal Notes</label>
                                <textarea name="notes" class="form-control" rows="3" placeholder="Add private notes here...">{{ old('notes', $sale->notes) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card custom-card">
                    <div class="card-header"><div class="card-title">Financial Information</div></div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-4">
                                <label class="form-label">Unit Price</label>
                                <input type="number" step="0.01" name="price" id="priceInput" class="form-control" value="{{ old('price', $sale->price) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" id="quantityInput" class="form-control" value="{{ old('quantity', $sale->quantity) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Discount</label>
                                <input type="number" step="0.01" name="discount" id="discountInput" class="form-control" value="{{ old('discount', $sale->discount) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tax</label>
                                <input type="number" step="0.01" name="tax" id="taxInput" class="form-control" value="{{ old('tax', $sale->tax) }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Total Price (Calculated)</label>
                                <input type="text" id="totalPriceDisplay" class="form-control bg-light" value="{{ number_format($sale->total_price, 2) }}" readonly>
                                <small class="text-muted">Total is calculated as: (Price * Quantity) - Discount + Tax</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card custom-card">
                    <div class="card-header"><div class="card-title">Status & Payment</div></div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-12">
                                <label class="form-label">Order Status</label>
                                <select name="status" class="form-control">
                                    @foreach($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', $sale->status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Payment Status</label>
                                <select name="payment_status" class="form-control">
                                    @foreach($paymentStatuses as $key => $label)
                                        <option value="{{ $key }}" {{ old('payment_status', $sale->payment_status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-control">
                                    <option value="">Select Method</option>
                                    @foreach($paymentMethods as $key => $label)
                                        <option value="{{ $key }}" {{ old('payment_method', $sale->payment_method) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Transaction ID</label>
                                <input type="text" name="transaction_id" class="form-control" value="{{ old('transaction_id', $sale->transaction_id) }}" placeholder="e.g. TR-592305">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Sale Date</label>
                                <input type="date" name="sale_date" class="form-control" value="{{ old('sale_date', $sale->sale_date) }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Expiry Date</label>
                                <input type="date" name="expaire_date" class="form-control" value="{{ old('expaire_date', $sale->expaire_date) }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary w-100 mb-2">Save Changes</button>
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary-light w-100">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceInput = document.getElementById('priceInput');
            const quantityInput = document.getElementById('quantityInput');
            const discountInput = document.getElementById('discountInput');
            const taxInput = document.getElementById('taxInput');
            const totalPriceDisplay = document.getElementById('totalPriceDisplay');

            function calculateTotal() {
                const price = parseFloat(priceInput.value) || 0;
                const quantity = parseInt(quantityInput.value) || 0;
                const discount = parseFloat(discountInput.value) || 0;
                const tax = parseFloat(taxInput.value) || 0;

                const total = (price * quantity) - discount + tax;
                totalPriceDisplay.value = total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
            }

            [priceInput, quantityInput, discountInput, taxInput].forEach(input => {
                input.addEventListener('input', calculateTotal);
            });
        });
    </script>
    @endpush
</x-backend-layout>
