@extends('layouts.app')

@section('title', 'Category Details')
@section('page-title', 'Category Details - ' . $category->name)

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Category Information
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Name:</dt>
                    <dd class="col-sm-8">{{ $category->name }}</dd>

                    @if($category->description)
                        <dt class="col-sm-4">Description:</dt>
                        <dd class="col-sm-8">{{ $category->description }}</dd>
                    @endif

                    <dt class="col-sm-4">Products:</dt>
                    <dd class="col-sm-8">
                        <span class="badge bg-info">{{ $category->products->count() }}</span>
                    </dd>
                </dl>

                <div class="d-flex gap-2">
                    <a href="{{ route('categories.manage-products', $category) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-cubes"></i> Manage Products
                    </a>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if($category->products->count() > 0)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-box"></i> Products in this Category
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($category->products as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $product->name }}</strong>
                                    <br>
                                    <small class="text-muted">SKU: {{ $product->sku }}</small>
                                </div>
                                <span class="badge bg-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
