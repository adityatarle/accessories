@extends('layouts.app')

@section('title', $category->name . ' - Shop ' . $category->name . ' Products')
@section('description', 'Shop our collection of ' . strtolower($category->name) . ' products. Find the perfect ' . strtolower($category->name) . ' for your style.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-pink-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('categories.index') }}" class="ml-1 text-gray-700 hover:text-pink-600 md:ml-2">Categories</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-gray-500 md:ml-2">{{ $category->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2 font-tanishq-display">{{ $category->name }}</h1>
                <p class="text-gray-600">{{ $products->total() }} {{ Str::plural('product', $products->total()) }} found</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('categories.index') }}" 
                   class="btn-secondary">
                    ← All Categories
                </a>
            </div>
        </div>
    </div>

    @if($products->count() > 0)
    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @foreach($products as $product)
        <div class="group bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
            <a href="{{ route('product.show', $product) }}" class="block">
                <!-- Product Image -->
                <div class="aspect-w-1 aspect-h-1 bg-gray-200 relative overflow-hidden">
                    @if($product->images && count($product->images) > 0)
                        <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                    @else
                        <img src="https://images.unsplash.com/photo-1567767292278-a4f21aa2d36e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $product->name }}" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                    @endif
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                </div>
                
                <!-- Product Info -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-pink-600 transition-colors line-clamp-2 font-tanishq">
                        {{ $product->name }}
                    </h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $product->brand->name ?? 'Brand' }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <span class="text-lg font-bold text-gray-900">₹{{ number_format($product->price, 2) }}</span>
                            @if($product->compare_price && $product->compare_price > $product->price)
                            <span class="text-sm text-gray-500 line-through">₹{{ number_format($product->compare_price, 2) }}</span>
                            @endif
                        </div>
                        @if($product->compare_price && $product->compare_price > $product->price)
                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">
                            {{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}% OFF
                        </span>
                        @endif
                    </div>
                    @if($product->average_rating > 0)
                    <div class="flex items-center mt-2">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $product->average_rating)
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <span class="text-sm text-gray-500 ml-2">({{ $product->reviews_count ?? 0 }})</span>
                    </div>
                    @endif
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="text-6xl mb-4">🔍</div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4">No products found in this category</h2>
        <p class="text-gray-600 mb-8">We're working on adding more products to this category. Check back soon!</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('categories.index') }}" 
               class="btn-primary">
                Browse Other Categories
            </a>
            <a href="{{ route('shop') }}" 
               class="btn-secondary">
                View All Products
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
