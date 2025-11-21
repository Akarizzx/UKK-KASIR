@extends('layouts.app')

@section('title', 'Product Details')
@section('page-title', 'Product Details - ' . $product->name)

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Product Information
            </div>
            <div class="card-body">
                <dl class="row">
                    @if($product->photo)
                        <dt class="col-sm-12 mb-3">
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" 
                                 class="img-fluid rounded" style="max-width: 300px;">
                        </dt>
                    @endif

                    <dt class="col-sm-4">Name:</dt>
                    <dd class="col-sm-8">{{ $product->name }}</dd>

                    <dt class="col-sm-4">SKU:</dt>
                    <dd class="col-sm-8"><code>{{ $product->sku }}</code></dd>

                    <dt class="col-sm-4">Supplier:</dt>
                    <dd class="col-sm-8">
                        <a href="{{ route('suppliers.show', $product->supplier) }}">
                            {{ $product->supplier->name }}
                        </a>
                    </dd>

                    @if($product->category)
                        <dt class="col-sm-4">Category:</dt>
                        <dd class="col-sm-8">
                            <a href="{{ route('categories.show', $product->category) }}">
                                {{ $product->category->name }}
                            </a>
                        </dd>
                    @endif

                    <dt class="col-sm-4">Price:</dt>
                    <dd class="col-sm-8">Rp {{ number_format($product->price, 0, ',', '.') }}</dd>

                    <dt class="col-sm-4">Stock:</dt>
                    <dd class="col-sm-8">
                        <span class="badge @if($product->stock > 0) bg-success @else bg-danger @endif">
                            {{ $product->stock }}
                        </span>
                    </dd>

                    @if($product->description)
                        <dt class="col-sm-4">Description:</dt>
                        <dd class="col-sm-8">{{ $product->description }}</dd>
                    @endif
                </dl>

                <div class="d-flex gap-2">
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
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
