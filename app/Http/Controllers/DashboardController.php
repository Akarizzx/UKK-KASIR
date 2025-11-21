<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'suppliers' => Supplier::count(),
            'products' => Product::count(),
            'categories' => Category::count(),
            'transactions' => Transaction::count(),
        ];

        // Get monthly sales data
        $monthlySales = Transaction::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_price) as total')
            ->where('type', 'sale')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(6)
            ->get()
            ->reverse();

        // Get recent transactions
        $recentTransactions = Transaction::with('product')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get top products
        $topProducts = Product::withCount('transactions')
            ->orderBy('transactions_count', 'desc')
            ->limit(5)
            ->get();

        // Get total revenue
        $totalRevenue = Transaction::where('type', 'sale')->sum('total_price');

        return view('dashboard.index', compact(
            'stats',
            'monthlySales',
            'recentTransactions',
            'topProducts',
            'totalRevenue'
        ));
    }

    public function suppliers(): View
    {
        $suppliers = Supplier::withCount('products')->paginate(10);
        return view('dashboard.suppliers', compact('suppliers'));
    }

    public function products(): View
    {
        $products = Product::with('supplier')->paginate(10);
        return view('dashboard.products', compact('products'));
    }

    public function customers(): View
    {
        $categories = Category::withCount('products')->paginate(10);
        return view('dashboard.categories', compact('categories'));
    }

    public function transactions(): View
    {
        $transactions = Transaction::with('product')->paginate(10);
        return view('dashboard.transactions', compact('transactions'));
    }
}
