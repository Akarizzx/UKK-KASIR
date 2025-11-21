@extends('layouts.app')

@section('title', 'Manage Products - ' . $category->name)

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">{{ $category->name }} - Manage Products</h2>
            <p class="text-muted">{{ $category->description }}</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Current Products in Category -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-boxes"></i> Products in {{ $category->name }}
                    <span class="badge bg-light text-dark float-end">{{ count($category->products) }}</span>
                </div>
                <div class="card-body">
                    @if (count($category->products) > 0)
                        <div class="list-group">
                            @foreach ($category->products as $product)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            Rp {{ number_format($product->price, 0, ',', '.') }} 
                                            <span class="badge bg-primary">Stock: {{ $product->stock }}</span>
                                        </small>
                                    </div>
                                    <form action="{{ route('categories.remove-product', [$category, $product]) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Remove this product from category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-inbox" style="font-size: 2rem;"></i>
                            <p>No products in this category yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Available Products to Add -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-plus-circle"></i> Add Products to {{ $category->name }}
                </div>
                <div class="card-body">
                    @if (count($allProducts) > 0)
                        <form action="{{ route('categories.add-product', $category) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="product_id" class="form-label fw-bold">Select Product</label>
                                <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                                    <option value="">-- Choose a product --</option>
                                    @foreach ($allProducts as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-plus"></i> Add Product
                            </button>
                        </form>
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-check-circle" style="font-size: 2rem;"></i>
                            <p>All products are already assigned to categories!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
