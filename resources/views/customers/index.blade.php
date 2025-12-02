@extends('layouts.app')

@section('title', 'Customers')
@section('page-title', 'Customers Management')

@section('styles')
<style>
    .customers-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .customers-header-content {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .customers-header-icon {
        font-size: 48px;
        opacity: 0.9;
    }

    .customers-header h2 {
        margin: 0;
        font-size: 32px;
        font-weight: bold;
    }

    .customers-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-header i {
        font-size: 18px;
    }
</style>
@endsection

@section('content')
<!-- Customers Header -->
<div class="customers-header">
    <div class="customers-header-content">
        <div class="customers-header-icon">
            <i class="fas fa-users-alt"></i>
        </div>
        <div>
            <h2>Customers</h2>
            <p>Manage all your customers and their transactions</p>
        </div>
    </div>
    <div>
        <a href="{{ route('customers.create') }}" class="btn btn-light btn-lg">
            <i class="fas fa-plus"></i> Add Customer
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Customers List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Transactions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td><strong>{{ $customer->name }}</strong></td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone ?? '-' }}</td>
                            <td>{{ $customer->city ?? '-' }}</td>
                            <td>
                                <span class="badge bg-info">{{ $customer->transactions()->count() }}</span>
                            </td>
                            <td>
                                <div class="action-buttons d-flex">
                                    <a href="{{ route('customers.show', $customer) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display: inline;">
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
                            <td colspan="6" class="text-center text-muted">No customers found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $customers->links() }}
    </div>
</div>
@endsection
