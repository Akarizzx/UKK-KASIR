@extends('layouts.app')

@section('title', 'Transactions')
@section('page-title', 'Transactions Management')

@section('content')
<div class="mb-3">
    <a href="{{ route('transactions.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Transaction
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Transactions List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr>
                            <td><code>{{ substr($transaction->transaction_code, 0, 15) }}...</code></td>
                            <td>
                                <a href="{{ route('products.show', $transaction->product) }}">
                                    {{ $transaction->product->name }}
                                </a>
                            </td>
                            <td>
                                @if($transaction->product->category)
                                    <span class="badge bg-primary">{{ $transaction->product->category->name }}</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge @if($transaction->type === 'sale') bg-success @else bg-warning @endif">
                                    {{ ucfirst($transaction->type) }}
                                </span>
                            </td>
                            <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="action-buttons d-flex">
                                    <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display: inline;">
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
                            <td colspan="8" class="text-center text-muted">No transactions found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $transactions->links() }}
    </div>
</div>
@endsection
