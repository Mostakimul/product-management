@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold mb-6">Product Details</h2>

    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $product->name }}</h3>
        
        <div class="mb-4">
            <p class="text-lg text-gray-700"><strong>Product ID:</strong> {{ $product->product_id }}</p>
            <p class="text-lg text-gray-700"><strong>Description:</strong> {{ $product->description ?? 'No description available.' }}</p>
            <p class="text-lg text-gray-700"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p class="text-lg text-gray-700"><strong>Stock:</strong> {{ $product->stock ?? 'Not available' }}</p>
        </div>

        <div class="mb-4">
            @if($product->image)
                <img src="{{ $product->image }}" alt="Product Image" class=" h-32 rounded-lg shadow-md">
            @else
                <p class="text-gray-500">No image available for this product.</p>
            @endif
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('products.index') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                Back to Product List
            </a>
        </div>
    </div>
</div>
@endsection
