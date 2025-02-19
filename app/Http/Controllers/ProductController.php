<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $sortField = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');

        $searchQuery = $request->get('search', '');

        $products = Product::where('product_id', 'like', "%$searchQuery%")
            ->orWhere('description', 'like', "%$searchQuery%")
            ->orderBy($sortField, $sortOrder)
            ->paginate(10);

        return view('products.index', compact('products', 'sortField', 'sortOrder', 'searchQuery'));
    }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|string|unique:products,product_id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::create([
            'product_id' => $validated['product_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
            'image' => $request->input('image'),

        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|string|unique:products,product_id,' . $id,
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
