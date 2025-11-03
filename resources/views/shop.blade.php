@extends('layouts.app')

@section('title', 'Shop')
@section('description', 'Browse our complete collection of accessories, cosmetics, jewelry, and fashion items.')

@section('content')
<!-- Hero Section - Good Earth Style -->
<section class="relative overflow-hidden bg-[#fafafa]">
    {{-- Background Image with subtle overlay --}}
    <div class="absolute inset-0">
        <img
            src="{{ asset('assets/imgs/Hero.jpg') }}"
            alt="Shop Hero background"
            class="w-full h-full object-cover object-center opacity-10"
            loading="eager">
    </div>

    {{-- Content --}}
    <div class="relative z-10 flex min-h-[60vh] items-center justify-center px-4 sm:px-6 lg:px-8 py-20">
        <div class="mx-auto text-center max-w-4xl">
            <h1 class="text-4xl font-light leading-tight md:text-6xl text-gray-900 font-tanishq-display mb-6 tracking-tight">
                Discover Our
                <span class="block mt-2 text-gray-700">Premium Collection</span>
            </h1>

            <p class="mx-auto mt-6 text-base text-gray-600 md:text-lg font-light max-w-2xl leading-relaxed">
                Browse through our carefully curated selection of premium accessories, cosmetics, and fashion items.
                <span class="block mt-3 text-gray-500">Find the perfect pieces to express your unique style.</span>
            </p>

            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#products"
                    class="px-10 py-3 bg-gray-900 text-white text-sm font-light tracking-wide transition-all duration-300 hover:bg-gray-800 uppercase">
                    Explore Products
                </a>
                <a href="{{ route('categories.index') }}"
                    class="px-10 py-3 border border-gray-900 text-gray-900 text-sm font-light tracking-wide transition-all duration-300 hover:bg-gray-900 hover:text-white uppercase">
                    Browse Categories
                </a>
            </div>
        </div>
    </div>
</section>

<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16" id="products">
        <!-- Header -->
        <div class="mb-12 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-light text-gray-900 mb-4 font-tanishq-display tracking-tight">Shop All Products</h1>
            <p class="text-base text-gray-600 font-light">Discover our complete collection of premium accessories and cosmetics</p>
        </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters - Good Earth Style -->
        <div class="lg:w-52 flex-shrink-0">
            <div class="sticky top-24">
                <h3 class="text-sm font-light tracking-wide uppercase text-gray-900 mb-6 pb-3 border-b border-gray-200">Filter By</h3>
                
                <!-- Categories -->
                <div class="mb-8" x-data="{ open: true }">
                    <button @click="open = !open" class="w-full flex items-center justify-between text-xs font-light tracking-wide uppercase text-gray-900 mb-4">
                        <span>Category</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" class="space-y-2">
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="category" value="" class="text-gray-900 focus:ring-gray-400" {{ !request('category') ? 'checked' : '' }}>
                            <span class="ml-3 text-sm text-gray-700 font-light group-hover:text-gray-900">All Categories</span>
                        </label>
                        @foreach($categories as $category)
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="category" value="{{ $category->id }}" class="text-gray-900 focus:ring-gray-400" {{ request('category') == $category->id ? 'checked' : '' }}>
                            <span class="ml-3 text-sm text-gray-700 font-light group-hover:text-gray-900">{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Brands -->
                <div class="mb-8" x-data="{ open: true }">
                    <button @click="open = !open" class="w-full flex items-center justify-between text-xs font-light tracking-wide uppercase text-gray-900 mb-4">
                        <span>Brands</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" class="space-y-2">
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="brand" value="" class="text-gray-900 focus:ring-gray-400" {{ !request('brand') ? 'checked' : '' }}>
                            <span class="ml-3 text-sm text-gray-700 font-light group-hover:text-gray-900">All Brands</span>
                        </label>
                        @foreach($brands as $brand)
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="brand" value="{{ $brand->id }}" class="text-gray-900 focus:ring-gray-400" {{ request('brand') == $brand->id ? 'checked' : '' }}>
                            <span class="ml-3 text-sm text-gray-700 font-light group-hover:text-gray-900">{{ $brand->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <button type="button" 
                        onclick="applyFilters()" 
                        class="w-full bg-gray-900 text-white py-3 text-sm font-light tracking-wide uppercase hover:bg-gray-800 transition-colors mt-6">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="flex-1">
            <!-- Results Header - Good Earth Style -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 pb-4 border-b border-gray-200">
                <p class="text-sm text-gray-600 font-light mb-4 md:mb-0">
                    {{ $products->total() }} {{ Str::plural('product', $products->total()) }} found
                </p>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-light tracking-wide uppercase text-gray-900">Sort By:</span>
                    <select name="sort" onchange="applyFilters()" class="px-4 py-2 border border-gray-300 bg-white text-gray-900 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400 font-light cursor-pointer">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Our Curation</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest First</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price: Lowest First</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: Highest First</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid - Good Earth Style -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                @forelse($products as $product)
                <div class="group flex flex-col">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden aspect-[3/4] bg-gray-50 mb-5">
                        <a href="{{ route('product.show', $product) }}" class="block h-full">
                            @php
                                $placeholderImage = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='1066'%3E%3Crect fill='%23EAEAEA' width='800' height='1066'/%3E%3Ctext fill='%23999999' font-family='sans-serif' font-size='20' dy='10.5' font-weight='bold' x='50%25' y='50%25' text-anchor='middle'%3ELoading...%3C/text%3E%3C/svg%3E";
                                $errorPlaceholder = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='1066'%3E%3Crect fill='%23EAEAEA' width='800' height='1066'/%3E%3Ctext fill='%23999999' font-family='sans-serif' font-size='20' dy='10.5' font-weight='bold' x='50%25' y='50%25' text-anchor='middle'%3ENo Image%3C/text%3E%3C/svg%3E";
                            @endphp
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ $placeholderImage }}" 
                                     data-src="{{ $product->main_image_url }}" 
                                     alt="{{ $product->name }}" 
                                     loading="lazy"
                                     onerror="this.onerror=null; this.src='{{ $errorPlaceholder }}';"
                                     class="w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-90">
                            @else
                                <img src="{{ $placeholderImage }}" 
                                     data-src="https://images.unsplash.com/photo-1505691723518-36a5ac3c3537?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                     alt="{{ $product->name }}" 
                                     loading="lazy"
                                     onerror="this.onerror=null; this.src='{{ $errorPlaceholder }}';"
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
                @empty
                <div class="col-span-full text-center py-16">
                    <div class="text-6xl mb-6 opacity-30">🔍</div>
                    <h3 class="text-xl font-light text-gray-900 mb-3 font-tanishq-display tracking-tight">No products found</h3>
                    <p class="text-gray-600 mb-8 font-light">Try adjusting your filters or search terms</p>
                    <a href="{{ route('shop') }}" 
                       class="inline-block px-8 py-3 bg-gray-900 text-white text-sm font-light tracking-wide uppercase hover:bg-gray-800 transition-colors">
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

// Image placeholder lazy loading
document.addEventListener('DOMContentLoaded', function() {
    // Load images with placeholders
    const productImages = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    const tempImg = new Image();
                    tempImg.onload = function() {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    };
                    tempImg.onerror = function() {
                        // Keep placeholder if image fails to load
                        img.onerror = null;
                    };
                    tempImg.src = img.dataset.src;
                }
                observer.unobserve(img);
            }
        });
    }, {
        rootMargin: '50px'
    });
    
    productImages.forEach(img => imageObserver.observe(img));
    
    // Add to bag functionality - Good Earth Style
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
