<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $transactions = Transaction::with('product')->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:sale,return',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $validated['unit_price'] = $product->price;
        $validated['total_price'] = $product->price * $validated['quantity'];
        $validated['transaction_code'] = 'TXN-' . date('YmdHis') . '-' . rand(1000, 9999);

        Transaction::create($validated);

        // Update product stock
        if ($validated['type'] === 'sale') {
            $product->decrement('stock', $validated['quantity']);
        } else {
            $product->increment('stock', $validated['quantity']);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction): View
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction): View
    {
        $products = Product::all();
        return view('transactions.edit', compact('transaction', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Transaction $transaction): RedirectResponse
{
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'type' => 'required|in:sale,return',
    ]);

    // 1. Ambil data lama
    $oldProduct = Product::find($transaction->product_id);
    $oldQty     = $transaction->quantity;
    $oldType    = $transaction->type;

    // 2. Kembalikan efek transaksi lama
    if ($oldType === 'sale') {
        $oldProduct->increment('stock', $oldQty);
    } else {
        $oldProduct->decrement('stock', $oldQty);
    }

    // 3. Efek transaksi baru
    $newProduct = Product::find($request->product_id);
    $newQty     = $request->quantity;
    $newType    = $request->type;

    $validated['unit_price']  = $newProduct->price;
    $validated['total_price'] = $newProduct->price * $newQty;

    // SIMPAN customer_id
    $validated['customer_id'] = $request->customer_id;

    // UPDATE TRANSACTION
    $transaction->update($validated);

    // 4. Terapkan efek baru
    if ($newType === 'sale') {
        $newProduct->decrement('stock', $newQty);
    } else {
        $newProduct->increment('stock', $newQty);
    }

    return redirect()
        ->route('transactions.index')
        ->with('success', 'Transaction updated successfully.');
}




    /**
     * Remove the specified resource from storage.
     */
 public function destroy(Transaction $transaction): RedirectResponse
    {

    }
}
