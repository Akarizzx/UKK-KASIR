@extends('layouts.app')

@section('title', 'Supplier Details')
@section('page-title', 'Supplier Details - ' . $supplier->name)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Supplier Information
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Name:</dt>
                    <dd class="col-sm-8">{{ $supplier->name }}</dd>

                    <dt class="col-sm-4">Contact:</dt>
                    <dd class="col-sm-8">{{ $supplier->contact_person ?? '-' }}</dd>

                    <dt class="col-sm-4">Phone:</dt>
                    <dd class="col-sm-8">{{ $supplier->phone ?? '-' }}</dd>

                    <dt class="col-sm-4">Email:</dt>
                    <dd class="col-sm-8">{{ $supplier->email ?? '-' }}</dd>

                    <dt class="col-sm-4">City:</dt>
                    <dd class="col-sm-8">{{ $supplier->city ?? '-' }}</dd>

                    <dt class="col-sm-4">State:</dt>
                    <dd class="col-sm-8">{{ $supplier->state ?? '-' }}</dd>
                </dl>

                <div class="d-flex gap-2">
                    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-box"></i> Supplier Products ({{ $products->total() }})
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td><code>{{ $product->sku }}</code></td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $product->stock }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No products for this supplier</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
