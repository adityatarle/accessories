@extends('layouts.app')

@section('title', 'My Wishlist')
@section('description', 'View your saved items and manage your wishlist.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">My Wishlist</h1>
        <p class="text-gray-600">Your saved items and favorites</p>
    </div>

    @if($wishlistItems->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($wishlistItems as $wishlistItem)
        <div class="product-card">
            <div class="relative overflow-hidden">
                <div class="w-full h-72 bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-6xl mb-4 transform group-hover:scale-110 transition-transform duration-300">✨</div>
                        <p class="text-sm text-gray-600 font-medium">Product Image</p>
                    </div>
                </div>
                @if($wishlistItem->product->sale_price)
                <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                    {{ $wishlistItem->product->discount_percentage }}% OFF
                </div>
                @endif
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm text-pink-600 font-bold uppercase tracking-wide">{{ $wishlistItem->product->brand->name }}</span>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="star" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                        <span class="text-sm text-gray-500 ml-2">({{ $wishlistItem->product->review_count }})</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                    {{ $wishlistItem->product->name }}
                </h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    {{ $wishlistItem->product->short_description }}
                </p>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-2">
                        @if($wishlistItem->product->sale_price)
                        <span class="sale-price">₹{{ number_format($wishlistItem->product->sale_price, 2) }}</span>
                        <span class="original-price">₹{{ number_format($wishlistItem->product->price, 2) }}</span>
                        @else
                        <span class="price-text">₹{{ number_format($wishlistItem->product->price, 2) }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('product.show', $wishlistItem->product) }}" 
                       class="flex-1 btn-primary text-center">
                        View Details
                    </a>
                    <form action="{{ route('wishlist.destroy', $wishlistItem) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-100 text-red-700 px-4 py-3 rounded-lg hover:bg-red-200 transition-colors"
                                onclick="return confirm('Remove from wishlist?')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-8">
        {{ $wishlistItems->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="text-6xl mb-4">❤️</div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Your wishlist is empty</h2>
        <p class="text-gray-600 mb-8">Start adding items to your wishlist to see them here.</p>
        <a href="{{ route('shop') }}" 
           class="btn-primary">
            Start Shopping
        </a>
    </div>
    @endif
</div>
@endsection
