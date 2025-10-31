@extends('layouts.app')

@section('title', $product->name)
@section('description', $product->short_description)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-pink-600">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('shop') }}" class="ml-1 text-gray-700 hover:text-pink-600 md:ml-2">Shop</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('shop', ['category' => $product->category->id]) }}" class="ml-1 text-gray-700 hover:text-pink-600 md:ml-2">{{ $product->category->name }}</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-gray-500 md:ml-2">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Product Images -->
        @php
            $existingImages = $product->images()->get();
        @endphp
        <div class="space-y-4" x-data="imageGallery()">
            <!-- Main Image -->
            <div class="aspect-w-1 aspect-h-1">
                <div class="w-full h-96 bg-gray-200 rounded-lg overflow-hidden">
                    @if($existingImages->count() > 0)
                        <img :src="selectedImage" :alt="$product->name" 
                             class="w-full h-full object-cover transition-all duration-300">
                    @else
                        <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" 
                             class="w-full h-full object-cover transition-all duration-300">
                    @endif
                </div>
            </div>
            
            <!-- Thumbnail Images -->
            @if($existingImages->count() > 0)
            <div class="grid grid-cols-4 gap-4">
                @foreach($existingImages as $index => $image)
                <div class="aspect-w-1 aspect-h-1">
                    <div class="w-full h-20 bg-gray-200 rounded-lg overflow-hidden cursor-pointer transition-all duration-200 hover:ring-2 hover:ring-pink-500"
                         :class="{ 'ring-2 ring-pink-500': selectedImage === '{{ $image->image_url }}' }"
                         @click="selectImage('{{ $image->image_url }}')">
                        <img src="{{ $image->image_url }}" alt="{{ $image->alt_text }}" 
                             class="w-full h-full object-cover">
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="grid grid-cols-4 gap-4">
                @php
                    $placeholderImages = [
                        'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80',
                        'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80',
                        'https://images.unsplash.com/photo-1567767292278-a4f21aa2d36e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80',
                        'https://images.unsplash.com/photo-1505691723518-36a5ac3c3537?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80',
                    ];
                @endphp
                @for($i = 0; $i < 4; $i++)
                <div class="aspect-w-1 aspect-h-1">
                    <div class="w-full h-20 bg-gray-200 rounded-lg overflow-hidden cursor-pointer">
                        <img src="{{ $placeholderImages[$i] }}" alt="Product thumbnail {{ $i + 1 }}" 
                             class="w-full h-full object-cover">
                    </div>
                </div>
                @endfor
            </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="space-y-6">
            <!-- Brand & Title -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-pink-600 font-semibold">{{ $product->brand->name }}</span>
                    @if($product->sale_price)
                    <span class="bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full">
                        {{ $product->discount_percentage }}% OFF
                    </span>
                    @endif
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
            </div>

            <!-- Rating -->
            <div class="flex items-center space-x-2">
                <div class="flex items-center">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>
                <span class="text-sm text-gray-600">({{ $product->review_count }} reviews)</span>
            </div>

            <!-- Price -->
            <div class="flex items-center space-x-4">
                @if($product->sale_price)
                <span class="text-4xl font-bold text-gray-900">₹{{ number_format($product->sale_price, 2) }}</span>
                <span class="text-2xl text-gray-500 line-through">₹{{ number_format($product->price, 2) }}</span>
                @else
                <span class="text-4xl font-bold text-gray-900">₹{{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            <!-- Description -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                <p class="text-gray-600">{{ $product->description }}</p>
            </div>

            <!-- Product Attributes -->
            @if($product->attributes)
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Product Details</h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($product->attributes as $key => $value)
                    <div>
                        <span class="text-sm font-medium text-gray-700">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                        <span class="text-sm text-gray-600 ml-2">{{ $value }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Stock Status -->
            <div class="flex items-center space-x-2">
                @if($product->isInStock())
                <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                <span class="text-green-600 font-medium">In Stock ({{ $product->stock }} available)</span>
                @else
                <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                <span class="text-red-600 font-medium">Out of Stock</span>
                @endif
            </div>

            <!-- Add to Cart -->
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <button type="button" class="px-3 py-2 text-gray-600 hover:text-gray-800" onclick="decreaseQuantity()">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        </button>
                        <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                               class="w-16 text-center border-0 focus:ring-0 focus:outline-none">
                        <button type="button" class="px-3 py-2 text-gray-600 hover:text-gray-800" onclick="increaseQuantity()">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                    <span class="text-sm text-gray-600">SKU: {{ $product->sku }}</span>
                </div>

                <div class="flex space-x-4">
                    @if($product->isInStock())
                    <button onclick="addToCart()" 
                            class="flex-1 bg-pink-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-pink-700 transition-colors">
                        Add to Cart
                    </button>
                    @else
                    <button disabled 
                            class="flex-1 bg-gray-400 text-white py-3 px-6 rounded-lg font-semibold cursor-not-allowed">
                        Out of Stock
                    </button>
                    @endif
                    
                    @auth
                    <button onclick="toggleWishlist()" 
                            class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                    @endauth
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Shipping Information</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Free shipping on orders over ₹1000
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Express delivery available
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        30-day return policy
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Product Reviews -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Customer Reviews</h2>
        
        @if($product->reviews->count() > 0)
        <div class="space-y-6">
            @foreach($product->reviews as $review)
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                            <span class="text-pink-600 font-semibold">{{ substr($review->user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $review->user->name }}</h4>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
                </div>
                @if($review->comment)
                <p class="text-gray-600">{{ $review->comment }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">💬</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No reviews yet</h3>
            <p class="text-gray-600">Be the first to review this product!</p>
        </div>
        @endif
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow group">
                <div class="aspect-w-1 aspect-h-1">
                    <div class="w-full h-64 bg-gray-200 rounded-t-lg overflow-hidden">
                        @if($relatedProduct->images && $relatedProduct->images->count() > 0)
                            <img src="{{ $relatedProduct->main_image_url }}" alt="{{ $relatedProduct->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $relatedProduct->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-pink-600 font-semibold">{{ $relatedProduct->brand->name }}</span>
                        @if($relatedProduct->sale_price)
                        <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                            {{ $relatedProduct->discount_percentage }}% OFF
                        </span>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                        {{ $relatedProduct->name }}
                    </h3>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            @if($relatedProduct->sale_price)
                            <span class="text-xl font-bold text-gray-900">₹{{ number_format($relatedProduct->sale_price, 2) }}</span>
                            <span class="text-lg text-gray-500 line-through">₹{{ number_format($relatedProduct->price, 2) }}</span>
                            @else
                            <span class="text-xl font-bold text-gray-900">₹{{ number_format($relatedProduct->price, 2) }}</span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('product.show', $relatedProduct) }}" 
                       class="block w-full bg-pink-600 text-white text-center py-2 rounded-lg hover:bg-pink-700 transition-colors">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Image Gallery functionality
function imageGallery() {
    return {
        selectedImage: '{{ $existingImages->count() > 0 ? $existingImages->first()->image_url : $product->main_image_url }}',
        
        selectImage(imageUrl) {
            this.selectedImage = imageUrl;
        }
    }
}

let quantity = 1;
const maxQuantity = {{ $product->stock }};

function increaseQuantity() {
    if (quantity < maxQuantity) {
        quantity++;
        document.getElementById('quantity').value = quantity;
    }
}

function decreaseQuantity() {
    if (quantity > 1) {
        quantity--;
        document.getElementById('quantity').value = quantity;
    }
}

function addToCart() {
    fetch('/cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: {{ $product->id }},
            quantity: quantity
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
}

function toggleWishlist() {
    // Wishlist functionality will be implemented later
    alert('Wishlist functionality coming soon!');
}
</script>
@endpush
