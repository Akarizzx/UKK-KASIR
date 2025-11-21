@extends('layouts.app')

@section('title', 'Categories')
@section('page-title', 'Product Categories Management')

@section('content')
<div class="mb-3">
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Category
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Categories List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr style="vertical-align: middle;">
                            <td><strong>{{ $category->name }}</strong></td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td>
                                <span class="badge bg-info">{{ $category->products_count }}</span>
                            </td>
                            <td>
                                <div class="action-buttons d-flex gap-2">
                                    <a href="{{ route('categories.manage-products', $category) }}" class="btn btn-success btn-sm" title="Manage Products">
                                        <i class="fas fa-cubes"></i> Manage
                                    </a>
                                    <a href="{{ route('categories.show', $category) }}" class="btn btn-info btn-sm" title="View Details">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $categories->links() }}
    </div>
</div>
@endsection
