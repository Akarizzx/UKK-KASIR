@extends('layouts.app')

@section('title', 'Edit Transaction')
@section('page-title', 'Edit Transaction')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit"></i> Edit Transaction
            </div>
            <div class="card-body">
                <form action="{{ route('transactions.update', $transaction) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Transaction Type *</label>
                            <select class="form-control @error('type') is-invalid @enderror" 
                                    name="type" required>
                                <option value="">-- Select Type --</option>
                                <option value="sale" @if(old('type', $transaction->type) == 'sale') selected @endif>Sale</option>
                                <option value="return" @if(old('type', $transaction->type) == 'return') selected @endif>Return</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product *</label>
                            <select class="form-control @error('product_id') is-invalid @enderror" 
                                    name="product_id" id="product_id" required>
                                <option value="">-- Select Product --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" 
                                            data-price="{{ $product->price }}"
                                            @if(old('product_id', $transaction->product_id) == $product->id) selected @endif>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity *</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                   name="quantity" id="quantity" value="{{ old('quantity', $transaction->quantity) }}" min="1" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card mb-3" style="background-color: #f8f9fa;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Unit Price</label>
                                    <h5 id="unit_price">Rp {{ number_format($transaction->unit_price, 0, ',', '.') }}</h5>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Total Price</label>
                                    <h5 id="total_price" style="color: #667eea;">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Transaction
                        </button>
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const unitPriceDisplay = document.getElementById('unit_price');
    const totalPriceDisplay = document.getElementById('total_price');

    function updatePrices() {
        const selected = productSelect.options[productSelect.selectedIndex];
        const price = parseFloat(selected.dataset.price) || 0;
        const quantity = parseInt(quantityInput.value) || 0;
        const total = price * quantity;

        unitPriceDisplay.textContent = 'Rp ' + price.toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
        totalPriceDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }

    productSelect.addEventListener('change', updatePrices);
    quantityInput.addEventListener('input', updatePrices);

    updatePrices();
</script>
@endsection
