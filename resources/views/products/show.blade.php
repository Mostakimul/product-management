@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Product Details</h2>

        <div class="product-details">
            <h3>{{ $product->name }}</h3>
            <p><strong>Product ID:</strong> {{ $product->product_id }}</p>
            <p><strong>Description:</strong> {{ $product->description ?? 'No description available.' }}</p>
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p><strong>Stock:</strong> {{ $product->stock ?? 'Not available' }}</p>
            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid" />

            <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Product List</a>
        </div>
    </div>
@endsection
