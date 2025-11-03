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
    <!-- Products Grid - Good Earth Style -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-12 mb-8">
        @foreach($products as $product)
        <div class="group flex flex-col">
            <!-- Product Image -->
            <div class="relative overflow-hidden aspect-[3/4] bg-gray-50 mb-5">
                <a href="{{ route('product.show', $product) }}" class="block h-full">
                    @if($product->images && count($product->images) > 0)
                        <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" 
                             class="w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-90">
                    @else
                        <img src="https://images.unsplash.com/photo-1567767292278-a4f21aa2d36e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $product->name }}" 
                             class="w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-90">
                    @endif
                </a>
            </div>
            
            <!-- Product Info -->
            <div class="flex flex-col flex-grow">
                <a href="{{ route('product.show', $product) }}" class="block mb-2 group-hover:opacity-70 transition-opacity">
                    <h3 class="text-sm font-light text-gray-900 leading-snug font-tanishq tracking-tight">
                        {{ $product->name }}
                    </h3>
                </a>
                
                <!-- Price -->
                <div class="mb-4">
                    @if($product->sale_price)
                        <span class="text-sm font-light text-gray-900">₹{{ number_format($product->sale_price, 0) }}</span>
                        <span class="text-xs text-gray-500 line-through ml-2">₹{{ number_format($product->price, 0) }}</span>
                    @elseif($product->compare_price && $product->compare_price > $product->price)
                        <span class="text-sm font-light text-gray-900">₹{{ number_format($product->price, 0) }}</span>
                        <span class="text-xs text-gray-500 line-through ml-2">₹{{ number_format($product->compare_price, 0) }}</span>
                    @else
                        <span class="text-sm font-light text-gray-900">₹{{ number_format($product->price, 0) }}</span>
                    @endif
                </div>
                
                <!-- ADD TO BAG Button - Good Earth Style -->
                <button class="add-to-bag w-full mt-auto py-2.5 bg-gray-900 text-white text-xs font-light tracking-wider uppercase hover:bg-gray-800 transition-colors"
                        data-product-id="{{ $product->id }}"
                        data-product-name="{{ $product->name }}">
                    ADD TO BAG
                </button>
            </div>
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

@push('scripts')
<script>
// Add to bag functionality - Good Earth Style
document.addEventListener('DOMContentLoaded', function() {
    const addToBagButtons = document.querySelectorAll('.add-to-bag');
    
    addToBagButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const originalText = this.textContent;
            
            // Disable button during request
            this.disabled = true;
            this.textContent = 'ADDING...';
            
            fetch('/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.cart_count;
                    }
                    
                    // Update button text
                    this.textContent = 'ADDED';
                    this.style.backgroundColor = '#10b981';
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.style.backgroundColor = '';
                        this.disabled = false;
                    }, 2000);
                } else {
                    alert(data.error || 'Something went wrong');
                    this.textContent = originalText;
                    this.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong');
                this.textContent = originalText;
                this.disabled = false;
            });
        });
    });
});
</script>
@endpush
