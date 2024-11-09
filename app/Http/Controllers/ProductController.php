<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::paginate(5); 
        return view('products.index', compact('products'));
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
            'product_id' => 'required|string|unique:products,product_id,'.$id, 
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

  
    public function destroy(Product $product)
    {
        //
    }
}
