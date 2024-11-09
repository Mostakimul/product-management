@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Product</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 

            <div class="mb-3">
                <label for="product_id" class="form-label">Product ID</label>
                <input type="text" class="form-control" id="product_id" name="product_id" value="{{ old('product_id', $product->product_id) }}" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock (Optional)</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image (Optional)</label>
                <input type="text" class="form-control" id="image" name="image" value="{{ old('image', $product->image) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
@endsection
