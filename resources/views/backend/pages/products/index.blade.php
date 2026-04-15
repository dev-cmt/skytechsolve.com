<x-backend-layout title="Product Management">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Product Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>

    @push('css')
    <style>
        .module-stat-card {
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            background: #fff;
            border: 1px solid #eef2f6;
        }
        .module-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .module-stat-card--success {
            border-left: 4px solid #10b981;
        }
        .module-stat-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            font-size: 24px;
        }
        .module-stat-value {
            font-size: 24px;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 4px;
            color: #1f2937;
        }
        .module-stat-label {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
        }
    </style>
    @endpush

    <div class="row mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="module-stat-card module-stat-card--success p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="module-stat-icon"><i class="ti ti-package"></i></div>
                    <div class="module-stat-copy">
                        <div class="module-stat-value">{{ $products->total() }}</div>
                        <div class="module-stat-label">Active Products</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Additional stat cards can be added here -->
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Products List
                    </div>
                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                        <i class="ri-add-line me-1 fw-semibold align-middle"></i>Add New Product
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Price Plans</th>
                                    <th scope="col">Order</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $key => $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $key }}</td>
                                    <td>
                                        @php
                                            $mainMedia = $product->media->where('is_main', 1)->first();
                                        @endphp
                                        @if($mainMedia)
                                            <img src="{{ asset($mainMedia->path) }}" alt="{{ $product->title }}" style="max-height: 40px; border-radius: 4px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $product->title }}</div>
                                        <div class="text-muted fs-11">{{ $product->subtitle }}</div>
                                    </td>
                                    <td><span class="badge bg-primary-transparent">{{ $product->type ?? 'N/A' }}</span></td>
                                    <td>
                                        <span class="badge bg-info-transparent">{{ $product->price_plans_count }} Plans</span>
                                    </td>
                                    <td>{{ $product->sort_order }}</td>
                                    <td>
                                        <span class="badge bg-{{ $product->status ? 'success' : 'danger' }}-transparent">
                                            {{ $product->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning-light btn-icon">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-light btn-icon" onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No products found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-backend-layout>
