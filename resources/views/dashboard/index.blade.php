@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card suppliers">
            <div class="stat-icon">
                <i class="fas fa-truck"></i>
            </div>
            <h3>{{ $stats['suppliers'] }}</h3>
            <p>Total Suppliers</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card products">
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <h3>{{ $stats['products'] }}</h3>
            <p>Total Products</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card customers">
            <div class="stat-icon">
                <i class="fas fa-tag"></i>
            </div>
            <h3>{{ $stats['categories'] }}</h3>
            <p>Total Categories</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card transactions">
            <div class="stat-icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <h3>{{ $stats['transactions'] }}</h3>
            <p>Total Transactions</p>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-line"></i> Monthly Sales (Last 6 Months)
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Key Metrics
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Total Revenue</label>
                    <h4 style="color: #ffffffff;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                </div>
                <div class="mb-3">
                    <label class="form-label">Average Transaction</label>
                    <h4 style="color: #1376f8ff;">
                        Rp {{ $stats['transactions'] > 0 ? number_format($totalRevenue / $stats['transactions'], 0, ',', '.') : '0' }}
                    </h4>
                </div>
                <hr>
                <a href="{{ route('transactions.create') }}" class="btn btn-primary w-100">
                    <i class="fas fa-plus"></i> New Transaction
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-star"></i> Top Products
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Transactions</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topProducts as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('products.show', $product) }}">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td>{{ $product->transactions_count }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No products yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-receipt"></i> Recent Transactions
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $transaction)
                            <tr>
                                <td>
                                    <a href="{{ route('transactions.show', $transaction) }}">
                                        {{ substr($transaction->transaction_code, 0, 15) }}...
                                    </a>
                                </td>
                                <td>{{ $transaction->product->name }}</td>
                                <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge @if($transaction->type === 'sale') bg-success @else bg-warning @endif">
                                        {{ ucfirst($transaction->type) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No transactions yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($monthlySales as $sale)
                    '{{ $sale->month }}',
                @endforeach
            ],
            datasets: [{
                label: 'Sales',
                data: [
                    @foreach($monthlySales as $sale)
                        {{ $sale->total }},
                    @endforeach
                ],
                backgroundColor: 'rgba(102, 126, 234, 0.6)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 1,
                borderRadius: 5,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
