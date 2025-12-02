@extends('layouts.app')

@section('title', 'Transaction Details')
@section('page-title', 'Transaction Details')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-receipt"></i> Transaction Details
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Transaction Code</h6>
                        <p><code>{{ $transaction->transaction_code }}</code></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Type</h6>
                        <p>
                            <span class="badge @if($transaction->type === 'sale') bg-success @else bg-warning @endif">
                                {{ ucfirst($transaction->type) }}
                            </span>
                        </p>
                    </div>
                </div>

                <hr>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Product</h6>
                        <p>
                            <strong><a href="{{ route('products.show', $transaction->product) }}">
                                {{ $transaction->product->name }}
                            </a></strong><br>
                            SKU: <code>{{ $transaction->product->sku }}</code>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Category</h6>
                        <p>
                            @if($transaction->product->category)
                                <span class="badge bg-primary">{{ $transaction->product->category->name }}</span>
                            @else
                                <span class="badge bg-secondary">Not assigned</span>
                            @endif
                        </p>
                    </div>
                </div>

                <hr>

                <div class="row mb-4">
                    <div class="col-md-6">
                </div>

                <hr>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <h6 class="text-muted">Quantity</h6>
                        <h5>{{ $transaction->quantity }}</h5>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-muted">Unit Price</h6>
                        <h5>Rp {{ number_format($transaction->unit_price, 0, ',', '.') }}</h5>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Total Price</h6>
                        <h4 style="color: #667eea;">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</h4>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Created At</h6>
                        <p>{{ $transaction->created_at->format('d M Y H:i:s') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Last Updated</h6>
                        <p>{{ $transaction->updated_at->format('d M Y H:i:s') }}</p>
                    </div>
                </div>

                <hr>

                <div class="d-flex gap-2">
                   

                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
