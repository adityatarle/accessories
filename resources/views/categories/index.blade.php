@extends('layouts.app')

@section('title', 'Categories - Browse Our Product Categories')
@section('description', 'Explore our wide range of product categories including jewelry, cosmetics, accessories, and more.')

@section('content')
<!-- Hero Section - Good Earth Style -->
<section class="relative overflow-hidden bg-[#fafafa]">
    {{-- Background Image with subtle overlay --}}
    <div class="absolute inset-0">
        <img
            src="{{ asset('assets/imgs/Hero.jpg') }}"
            alt="Categories Hero background"
            class="w-full h-full object-cover object-center opacity-10"
            loading="eager">
    </div>

    {{-- Content --}}
    <div class="relative z-10 flex min-h-[60vh] items-center justify-center px-4 sm:px-6 lg:px-8 py-20">
        <div class="mx-auto text-center max-w-4xl">
            <h1 class="text-4xl font-light leading-tight md:text-6xl lg:text-7xl text-gray-900 font-tanishq-display mb-6 tracking-tight">
                Shop by
                <span class="block mt-2 text-gray-700">Category</span>
            </h1>

            <p class="mx-auto mt-6 text-base text-gray-600 md:text-lg font-light max-w-2xl leading-relaxed">
                Discover our carefully curated collection of accessories, cosmetics, and jewelry organized by category.
                <span class="block mt-3 text-gray-500">Find the perfect pieces to match your style.</span>
            </p>

            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('shop') }}"
                    class="px-10 py-3 bg-gray-900 text-white text-sm font-light tracking-wide transition-all duration-300 hover:bg-gray-800 uppercase">
                    Browse All Products
                </a>
                <a href="#categories"
                    class="px-10 py-3 border border-gray-900 text-gray-900 text-sm font-light tracking-wide transition-all duration-300 hover:bg-gray-900 hover:text-white uppercase">
                    Explore Categories
                </a>
            </div>
        </div>
    </div>
</section>

<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24" id="categories">

        @if($categories->count() > 0)
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-light text-gray-900 mb-4 font-tanishq-display tracking-tight">
                Our Collections
            </h2>
            <p class="text-base text-gray-600 font-light max-w-2xl mx-auto">
                Handpicked categories featuring the finest selection
            </p>
        </div>

        <!-- Categories Grid - Good Earth Style -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
            @foreach($categories as $category)
            <div class="group relative bg-white overflow-hidden transition-all duration-500 hover:shadow-2xl">
                <a href="{{ route('shop', ['category' => $category->id]) }}" class="block">
                    <!-- Category Image with elegant overlay -->
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
                    <div class="relative overflow-hidden aspect-[4/5] bg-gray-100">
                        <img 
                            src="{{ $categoryImage }}" 
                            alt="{{ $category->name }}" 
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out">
                        
                        {{-- Subtle overlay --}}
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/5 transition-colors duration-500"></div>
                        
                        {{-- Category name overlay --}}
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl md:text-3xl font-light mb-2 font-tanishq-display tracking-tight">
                                {{ $category->name }}
                            </h3>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-sm text-gray-200 font-light">
                                    {{ $category->products_count }} {{ Str::plural('item', $category->products_count) }}
                                </span>
                                <span class="text-white text-sm font-light tracking-wide group-hover:translate-x-1 transition-transform duration-300">
                                    Explore →
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Call to Action - Good Earth Style -->
        <div class="mt-20 text-center">
            <div class="bg-[#fafafa] border border-gray-200 p-12 md:p-16 max-w-4xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-light text-gray-900 mb-4 font-tanishq-display tracking-tight">
                    Can't find what you're looking for?
                </h2>
                <p class="text-gray-600 mb-8 font-light text-base max-w-2xl mx-auto">
                    Browse all our products or use our search to find exactly what you need.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('shop') }}" 
                       class="px-10 py-3 bg-gray-900 text-white text-sm font-light tracking-wide uppercase transition-all duration-300 hover:bg-gray-800">
                        Browse All Products
                    </a>
                    <a href="{{ route('home') }}" 
                       class="px-10 py-3 border border-gray-900 text-gray-900 text-sm font-light tracking-wide uppercase transition-all duration-300 hover:bg-gray-900 hover:text-white">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
        @else
        <!-- Empty State - Good Earth Style -->
        <div class="text-center py-20">
            <div class="text-6xl mb-6 opacity-30">📦</div>
            <h2 class="text-3xl font-light text-gray-900 mb-4 font-tanishq-display tracking-tight">
                No Categories Available
            </h2>
            <p class="text-gray-600 mb-10 font-light text-base max-w-md mx-auto">
                We're working on adding more categories. Check back soon!
            </p>
            <a href="{{ route('shop') }}" 
               class="inline-block px-10 py-3 bg-gray-900 text-white text-sm font-light tracking-wide uppercase transition-all duration-300 hover:bg-gray-800">
                Browse Products
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
