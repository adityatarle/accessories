@extends('layouts.app')

@section('title', 'Categories - Browse Our Product Categories')
@section('description', 'Explore our wide range of product categories including jewelry, cosmetics, accessories, and more.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Shop by Category</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Discover our carefully curated collection of accessories, cosmetics, and jewelry organized by category
        </p>
    </div>

    @if($categories->count() > 0)
    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($categories as $category)
        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
            <a href="{{ route('categories.show', $category) }}" class="block">
                <!-- Category Image -->
                @php
                    $categoryImages = [
                        'Jewelry' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'Cosmetics' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'Accessories' => 'https://images.unsplash.com/photo-1567767292278-a4f21aa2d36e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'Fashion' => 'https://images.unsplash.com/photo-1505691723518-36a5ac3c3537?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'Beauty' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'Watches' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'Bags' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'Shoes' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    ];
                    $categoryImage = $categoryImages[$category->name] ?? 'https://images.unsplash.com/photo-1567767292278-a4f21aa2d36e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                @endphp
                <div class="aspect-w-16 aspect-h-12 relative overflow-hidden">
                    <img src="{{ $categoryImage }}" alt="{{ $category->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                </div>
                
                <!-- Category Info -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-pink-600 transition-colors">
                        {{ $category->name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $category->description ?? 'Explore our collection of ' . strtolower($category->name) }}
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">
                            {{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}
                        </span>
                        <span class="text-pink-600 font-medium group-hover:text-pink-700">
                            Shop Now →
                        </span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <!-- Call to Action -->
    <div class="mt-16 text-center">
        <div class="bg-gradient-to-r from-pink-50 to-purple-50 rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Can't find what you're looking for?</h2>
            <p class="text-gray-600 mb-6">Browse all our products or use our search to find exactly what you need.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('shop') }}" 
                   class="btn-primary">
                    Browse All Products
                </a>
                <a href="{{ route('home') }}" 
                   class="btn-secondary">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="text-6xl mb-4">📦</div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4">No categories available</h2>
        <p class="text-gray-600 mb-8">We're working on adding more categories. Check back soon!</p>
        <a href="{{ route('shop') }}" 
           class="btn-primary">
            Browse Products
        </a>
    </div>
    @endif
</div>
@endsection
