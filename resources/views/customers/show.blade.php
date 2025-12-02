@extends('layouts.app')

@section('title', 'Customer Details')
@section('page-title', 'Customer Details - ' . $customer->name)

@section('styles')
<style>
    .card-header {
        background: linear-gradient(135deg, #1376f8ff  0%, #1376f8ff 100%);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-header i {
        font-size: 18px;
    }

    .customer-profile-header {
        background: linear-gradient(135deg,  #1376f8ff  0%, #1376f8ff 100%);
        color: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .customer-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .customer-profile-info h3 {
        margin: 0;
        font-size: 24px;
    }

    .customer-profile-info p {
        margin: 5px 0 0 0;
        opacity: 0.9;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<!-- Customer Profile Header -->
<div class="customer-profile-header">
    <div class="customer-avatar">
        <i class="fas fa-user"></i>
    </div>
    <div class="customer-profile-info">
        <h3>{{ $customer->name }}</h3>
        <p><i class="fas fa-envelope"></i> {{ $customer->email }}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-user-circle"></i> Customer Information
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Name:</dt>
                    <dd class="col-sm-8">{{ $customer->name }}</dd>

                    <dt class="col-sm-4">Email:</dt>
                    <dd class="col-sm-8">{{ $customer->email }}</dd>

                    <dt class="col-sm-4">Phone:</dt>
                    <dd class="col-sm-8">{{ $customer->phone ?? '-' }}</dd>

                    <dt class="col-sm-4">City:</dt>
                    <dd class="col-sm-8">{{ $customer->city ?? '-' }}</dd>

                    <dt class="col-sm-4">State:</dt>
                    <dd class="col-sm-8">{{ $customer->state ?? '-' }}</dd>

                    @if($customer->address)
                        <dt class="col-sm-4">Address:</dt>
                        <dd class="col-sm-8">{{ $customer->address }}</dd>
                    @endif
                </dl>

                <div class="d-flex gap-2">
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
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-receipt"></i> Customer Transactions ({{ $transactions->total() }})
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>
                                        <a href="{{ route('transactions.show', $transaction) }}">
                                            {{ substr($transaction->transaction_code, 0, 12) }}...
                                        </a>
                                    </td>
                                    <td>{{ $transaction->product->name }}</td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge @if($transaction->type === 'sale') bg-success @else bg-warning @endif">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </td>
                                    <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No transactions for this customer</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
