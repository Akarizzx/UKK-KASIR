@extends('layouts.app')

@section('title', 'Products')
@section('page-title', 'Products Management')

@section('content')
<div class="mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Product
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Products List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Photo</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Supplier</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr style="vertical-align: middle;">
                            <td class="text-center">
                                @if($product->photo)
                                    <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" 
                                         class="img-thumbnail" style="max-width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <span class="badge bg-secondary">No Photo</span>
                                @endif
                            </td>
                            <td><strong>{{ $product->name }}</strong></td>
                            <td><code>{{ $product->sku }}</code></td>
                            <td>
                                <a href="{{ route('suppliers.show', $product->supplier) }}">
                                    {{ $product->supplier->name }}
                                </a>
                            </td>
                            <td>
                                @if($product->category)
                                    <span class="badge bg-primary">{{ $product->category->name }}</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge @if($product->stock > 0) bg-success @else bg-danger @endif">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons d-flex">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No products found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $products->links() }}
    </div>
</div>
@endsection
