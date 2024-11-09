@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Products</h1>

    <!-- Search Form -->
    <form action="{{ route('products.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" value="{{ old('search', $searchQuery) }}" class="form-control" placeholder="Search by product ID or description">
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>

    <a href="{{ route('products.create') }}" class="btn btn-secondary my-5 mx-5">Add New Product</a>

    <div class="mb-3">
        <strong>Sort by:</strong>
        <a href="{{ route('products.index', ['sort' => 'name', 'order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $searchQuery]) }}" class="btn btn-link">
            Name
            @if ($sortField === 'name')
                <span>{{ $sortOrder === 'asc' ? '↓' : '↑' }}</span>
            @endif
        </a>
        <a href="{{ route('products.index', ['sort' => 'price', 'order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $searchQuery]) }}" class="btn btn-link">
            Price
            @if ($sortField === 'price')
                <span>{{ $sortOrder === 'asc' ? '↓' : '↑' }}</span>
            @endif
        </a>
    </div>

    @if($products->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>${{ $product->price }}</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    @else
        <p>No products available.</p>
    @endif
</div>
@endsection
