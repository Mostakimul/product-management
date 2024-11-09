@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">All Products</h1>

    <!-- Search Form -->
    <form action="{{ route('products.index') }}" method="GET" class="mb-6 flex">
        <input type="text" name="search" value="{{ old('search', $searchQuery) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search by product ID or description">
        <button type="submit" class="ml-4 px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Search</button>
    </form>

    <a href="{{ route('products.create') }}" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 mb-5 inline-block">Add New Product</a>

    <div class="mb-4">
        <strong class="text-lg">Sort by:</strong>
        <a href="{{ route('products.index', ['sort' => 'name', 'order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $searchQuery]) }}" class="text-indigo-600 hover:text-indigo-800 ml-4">
            Name
            @if ($sortField === 'name')
                <span>{{ $sortOrder === 'asc' ? '↓' : '↑' }}</span>
            @endif
        </a>
        <a href="{{ route('products.index', ['sort' => 'price', 'order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $searchQuery]) }}" class="text-indigo-600 hover:text-indigo-800 ml-4">
            Price
            @if ($sortField === 'price')
                <span>{{ $sortOrder === 'asc' ? '↓' : '↑' }}</span>
            @endif
        </a>
    </div>

    @if($products->count())
        <table class="min-w-full bg-white border border-gray-200 rounded-md shadow-md">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Product Id</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Price</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-t border-gray-100">
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $product->id }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $product->product_id }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $product->name }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">${{ $product->price }}</td>
                        <td class="px-6 py-3 text-sm">
                            <a href="{{ route('products.show', $product->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-gray-600">No products available.</p>
    @endif
</div>
@endsection
