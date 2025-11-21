<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::withCount('products')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        $category->load('products');
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Show products in a category and manage them.
     */
    public function manageProducts(Category $category): View
    {
        $category->load('products');
        $allProducts = Product::where('category_id', '!=', $category->id)->get();
        return view('categories.manage-products', compact('category', 'allProducts'));
    }

    /**
     * Add product to category.
     */
    public function addProduct(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id|unique:products,category_id',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $product->update(['category_id' => $category->id]);

        return redirect()->route('categories.manage-products', $category)->with('success', 'Product added to category successfully.');
    }

    /**
     * Remove product from category.
     */
    public function removeProduct(Category $category, Product $product): RedirectResponse
    {
        if ($product->category_id === $category->id) {
            $product->update(['category_id' => null]);
        }

        return redirect()->route('categories.manage-products', $category)->with('success', 'Product removed from category successfully.');
    }
}
