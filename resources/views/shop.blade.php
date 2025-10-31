@extends('layouts.app')

@section('title', 'Shop')
@section('description', 'Browse our complete collection of accessories, cosmetics, jewelry, and fashion items.')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gray-900">
    {{-- Background Image --}}
    <img
        src="{{ asset('assets/imgs/Hero.jpg') }}"
        alt="Shop Hero background"
        class="absolute inset-0 w-full h-full object-cover object-center"
        loading="eager">

    {{-- Dark overlay --}}
    <div class="absolute inset-0 bg-black/60"></div>

    {{-- Content --}}
    <div class="relative z-10 flex min-h-[60vh] items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="mx-auto text-center max-w-4xl">
            <h1 class="text-4xl font-bold leading-tight md:text-6xl text-white font-tanishq-display mb-6">
                Discover Our
                <span class="block text-yellow-300">Premium Collection</span>
            </h1>

            <p class="mx-auto mt-6 text-lg text-pink-100 md:text-xl font-tanishq">
                Browse through our carefully curated selection of premium accessories, cosmetics, and fashion items.
                Find the perfect pieces to express your unique style.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#products"
                    class="rounded-full bg-white px-8 py-3 font-bold text-pink-600 text-lg shadow-lg transition-all hover:bg-gray-100 hover:scale-105">
                    Explore Products
                </a>
                <a href="{{ route('categories.index') }}"
                    class="rounded-full border-2 border-white px-8 py-3 font-bold text-white text-lg transition-all hover:bg-white hover:text-pink-600 hover:scale-105">
                    Browse Categories
                </a>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" id="products">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4 font-tanishq-display">Shop All Products</h1>
        <p class="text-gray-600 font-tanishq">Discover our complete collection of premium accessories and cosmetics</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Filters</h3>
                
                <!-- Search -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search products..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                </div>

                <!-- Categories -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="category" value="" class="text-pink-600 focus:ring-pink-500" {{ !request('category') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">All Categories</span>
                        </label>
                        @foreach($categories as $category)
                        <label class="flex items-center">
                            <input type="radio" name="category" value="{{ $category->id }}" class="text-pink-600 focus:ring-pink-500" {{ request('category') == $category->id ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Brands -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brands</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="brand" value="" class="text-pink-600 focus:ring-pink-500" {{ !request('brand') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">All Brands</span>
                        </label>
                        @foreach($brands as $brand)
                        <label class="flex items-center">
                            <input type="radio" name="brand" value="{{ $brand->id }}" class="text-pink-600 focus:ring-pink-500" {{ request('brand') == $brand->id ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">{{ $brand->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                    <div class="space-y-2">
                        <input type="number" 
                               name="min_price" 
                               value="{{ request('min_price') }}"
                               placeholder="Min Price" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        <input type="number" 
                               name="max_price" 
                               value="{{ request('max_price') }}"
                               placeholder="Max Price" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Sort -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price Low to High</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest First</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                    </select>
                </div>

                <button type="button" 
                        onclick="applyFilters()" 
                        class="w-full bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-700 transition-colors">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="lg:w-3/4">
            <!-- Results Header -->
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">
                    Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
                </p>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-700">View:</span>
                    <button class="p-2 bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                        </svg>
                    </button>
                    <button class="p-2 bg-pink-600 text-white rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow group">
                    <div class="aspect-w-1 aspect-h-1">
                        <div class="w-full h-64 bg-gray-200 rounded-t-lg overflow-hidden">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <img src="https://images.unsplash.com/photo-1505691723518-36a5ac3c3537?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-pink-600 font-semibold">{{ $product->brand->name }}</span>
                            @if($product->sale_price)
                            <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                {{ $product->discount_percentage }}% OFF
                            </span>
                            @endif
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 font-tanishq">
                            {{ $product->name }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ $product->short_description }}
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                @if($product->sale_price)
                                <span class="text-2xl font-bold text-gray-900">₹{{ number_format($product->sale_price, 2) }}</span>
                                <span class="text-lg text-gray-500 line-through">₹{{ number_format($product->price, 2) }}</span>
                                @else
                                <span class="text-2xl font-bold text-gray-900">₹{{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                                <span class="text-sm text-gray-600 ml-1">({{ $product->review_count }})</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('product.show', $product) }}" 
                               class="flex-1 bg-pink-600 text-white text-center py-2 rounded-lg hover:bg-pink-700 transition-colors">
                                View Details
                            </a>
                            <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors add-to-cart" 
                                    data-product-id="{{ $product->id }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No products found</h3>
                    <p class="text-gray-600 mb-4">Try adjusting your filters or search terms</p>
                    <a href="{{ route('shop') }}" 
                       class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition-colors">
                        Clear Filters
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-8">
                {{ $products->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function applyFilters() {
    const form = document.createElement('form');
    form.method = 'GET';
    form.action = '{{ route("shop") }}';
    
    const search = document.querySelector('input[name="search"]').value;
    const category = document.querySelector('input[name="category"]:checked').value;
    const brand = document.querySelector('input[name="brand"]:checked').value;
    const minPrice = document.querySelector('input[name="min_price"]').value;
    const maxPrice = document.querySelector('input[name="max_price"]').value;
    const sort = document.querySelector('select[name="sort"]').value;
    
    if (search) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'search';
        input.value = search;
        form.appendChild(input);
    }
    
    if (category) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'category';
        input.value = category;
        form.appendChild(input);
    }
    
    if (brand) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'brand';
        input.value = brand;
        form.appendChild(input);
    }
    
    if (minPrice) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'min_price';
        input.value = minPrice;
        form.appendChild(input);
    }
    
    if (maxPrice) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'max_price';
        input.value = maxPrice;
        form.appendChild(input);
    }
    
    if (sort) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'sort';
        input.value = sort;
        form.appendChild(input);
    }
    
    document.body.appendChild(form);
    form.submit();
}

// Add to cart functionality
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            
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
                    
                    // Show success message
                    alert(data.message);
                } else {
                    alert(data.error || 'Something went wrong');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong');
            });
        });
    });
});
</script>
@endpush
