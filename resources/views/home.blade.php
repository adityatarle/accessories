@extends('layouts.app')

@section('title', 'Home')
@section('description', 'Shop premium accessories, cosmetics, jewelry, and fashion items at our online store.')

@section('content')
<!-- Hero Section - Good Earth Style -->
<section class="relative overflow-hidden bg-[#fafafa]">
    {{-- Background Image with subtle overlay --}}
    <div class="absolute inset-0">
        <img
            src="{{ asset('assets/imgs/Hero.jpg') }}"
            alt="Hero background"
            class="w-full h-full object-cover object-center opacity-20"
            loading="eager">
        <div class="absolute inset-0 bg-[#fafafa]/90"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 flex min-h-[85vh] items-center justify-center px-4 sm:px-6 lg:px-8 py-20">
        <div class="mx-auto text-center max-w-4xl">
            <h1 class="text-4xl font-light leading-tight md:text-6xl lg:text-7xl text-gray-900 font-tanishq-display mb-6 tracking-tight">
                Transform Your
                <span class="block mt-2 text-gray-700">Living Space</span>
            </h1>

            <p class="mx-auto mt-8 text-base text-gray-600 md:text-lg font-light max-w-2xl leading-relaxed">
                Premium home decor and accessories curated for the modern home.
                <span class="block mt-3 text-gray-500">Express your style with our exclusive collection of beautiful furnishings.</span>
            </p>

            <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('shop') }}"
                    class="px-10 py-3 bg-gray-900 text-white text-sm font-light tracking-wide transition-all duration-300 hover:bg-gray-800 uppercase">
                    Shop Now
                </a>
                <a href="#featured"
                    class="px-10 py-3 border border-gray-900 text-gray-900 text-sm font-light tracking-wide transition-all duration-300 hover:bg-gray-900 hover:text-white uppercase">
                    Explore Collection
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Secondary Banner Section - Good Earth Style -->
<section class="relative overflow-hidden bg-white">
    <div class="flex flex-col md:flex-row min-h-[70vh]">
        <!-- Left: Text Content -->
        <div class="flex-1 flex items-center justify-center p-12 md:p-16 lg:p-20">
            <div class="text-center md:text-left max-w-md">
                <h2 class="text-3xl md:text-5xl font-light leading-tight text-gray-900 font-tanishq-display mb-6 tracking-tight">
                    Crafted with
                    <span class="block mt-2 text-gray-700">Excellence</span>
                </h2>
                <p class="mt-4 text-base text-gray-600 font-light leading-relaxed">
                    Discover new possibilities and drive success with our premium collection.
                </p>
                <a href="{{ route('categories.index') }}"
                    class="mt-8 inline-block px-10 py-3 border border-gray-900 text-gray-900 text-sm font-light tracking-wide uppercase transition-all duration-300 hover:bg-gray-900 hover:text-white">
                    Explore More
                </a>
            </div>
        </div>

        <!-- Right: Full Image -->
        <div class="relative flex-1 overflow-hidden min-h-[400px] md:min-h-0 bg-gray-100">
            <img
                src="{{ asset('assets/imgs/Banner2.jpg') }}"
                alt="Premium collection"
                class="absolute inset-0 w-full h-full object-cover"
                loading="eager">
        </div>
    </div>
</section>
<!-- Featured Categories -->
<!-- <section id="featured" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Shop by Category</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Explore our carefully curated collection of premium products across different categories</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $index => $category)
            @php
            $homeDecorImages = [
            'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1567767292278-a4f21aa2d36e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1505691723518-36a5ac3c3537?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ];
            $imageUrl = $homeDecorImages[$index % count($homeDecorImages)];
            @endphp
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <div class="aspect-w-16 aspect-h-9">
                    <div class="w-full h-80 relative overflow-hidden">
                        <img src="{{ $imageUrl }}" alt="{{ $category->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                        <div class="absolute inset-0 flex items-end justify-center p-6 z-10">
                            <div class="text-center">
                                <h3 class="text-3xl font-bold text-white mb-2">{{ $category->name }}</h3>
                                <p class="text-white text-sm">{{ $category->description }}</p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                    </div>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <div class="absolute bottom-6 left-6 right-6">
                        <a href="{{ route('shop', ['category' => $category->id]) }}"
                            class="block w-full bg-white text-gray-800 px-6 py-4 rounded-xl font-bold text-center hover:bg-gray-100 transition-colors duration-200 transform translate-y-4 group-hover:translate-y-0">
                            Shop {{ $category->name }} →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> -->
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-light text-gray-900 mb-4 font-tanishq-display tracking-tight">Shop by Category</h2>
            <p class="text-base text-gray-600 font-light max-w-2xl mx-auto">Explore our carefully curated collection of premium products across different categories</p>
        </div>

        <!-- Desktop Layout: 2 + 2 -->
        <div class="hidden md:flex justify-center gap-2 pb-12">

            <!-- Left Column -->
            <div class="flex flex-col gap-3">
                <!-- Home -->
                <a href="{{ route('shop') }}" class="group relative block overflow-hidden transition-all duration-500 hover:opacity-95">
                    <img src="{{ asset('assets/imgs/HomeDecor2.jpg') }}"
                        alt="Home"
                        class="pillar-img object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-500"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8">
                        <h2 class="text-3xl font-light text-white font-tanishq-display tracking-tight">Home</h2>
                    </div>
                </a>

                <!-- Style -->
                <a href="{{ route('shop') }}" class="group relative block overflow-hidden transition-all duration-500 hover:opacity-95">
                    <img src="{{ asset('assets/imgs/HomeDecor1.jpg') }}"
                        alt="Style"
                        class="w-full pillar-img-alt object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-500"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8">
                        <h2 class="text-3xl font-light text-white font-tanishq-display tracking-tight">Style</h2>
                    </div>
                </a>
            </div>

            <!-- Right Column -->
            <div class="flex flex-col gap-3">
                <!-- Decor -->
                <a href="{{ route('shop') }}" class="group relative block overflow-hidden transition-all duration-500 hover:opacity-95">
                    <img src="{{ asset('assets/imgs/HomeDecor.jpg') }}"
                        alt="Decor"
                        class="w-full pillar-img-alt object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-500"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8">
                        <h2 class="text-3xl font-light text-white font-tanishq-display tracking-tight">Decor</h2>
                    </div>
                </a>

                <!-- Accessory -->
                <a href="{{ route('shop') }}" class="group relative block overflow-hidden transition-all duration-500 hover:opacity-95">
                    <img src="{{ asset('assets/imgs/HomeDecor3.jpg') }}"
                        alt="Accessory"
                        class="w-full pillar-img object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-500"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8">
                        <h2 class="text-3xl font-light text-white font-tanishq-display tracking-tight">Accessory</h2>
                    </div>
                </a>
            </div>
        </div>

        <!-- Mobile Layout: 2 × 2 Grid -->
        <div class="md:hidden grid grid-cols-2 gap-2 pb-8">

            <!-- Home -->
            <a href="{{ route('shop') }}" class="group relative block overflow-hidden rounded-xl shadow-lg">
                <img src="{{ asset('assets/imgs/HomeDecor2.jpg') }}"
                    alt="Home"
                    class="w-full pillar-img object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-[#832729] via-[#832729]/95 to-transparent opacity-90"></div>
                <div class="absolute bottom-0 w-full h-10 flex items-end justify-center pb-2">
                    <h2 class="pillar-title">Home</h2>
                </div>
            </a>

            <!-- Style -->
            <a href="{{ route('shop') }}" class="group relative block overflow-hidden rounded-xl shadow-lg">
                <img src="{{ asset('assets/imgs/HomeDecor1.jpg') }}"
                    alt="Style"
                    class="w-full pillar-img-alt object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-[#832729] via-[#832729]/95 to-transparent opacity-90"></div>
                <div class="absolute bottom-0 w-full h-10 flex items-end justify-center pb-2">
                    <h2 class="pillar-title">Style</h2>
                </div>
            </a>

            <!-- Decor -->
            <a href="{{ route('shop') }}" class="group relative block overflow-hidden rounded-xl shadow-lg">
                <img src="{{ asset('assets/imgs/HomeDecor.jpg') }}"
                    alt="Decor"
                    class="w-full pillar-img-alt object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-[#832729] via-[#832729]/95 to-transparent opacity-90"></div>
                <div class="absolute bottom-0 w-full h-10 flex items-end justify-center pb-2">
                    <h2 class="pillar-title">Decor</h2>
                </div>
            </a>

            <!-- Accessory -->
            <a href="{{ route('shop') }}" class="group relative block overflow-hidden rounded-xl shadow-lg">
                <img src="{{ asset('assets/imgs/HomeDecor3.jpg') }}"
                    alt="Accessory"
                    class="w-full pillar-img object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-[#832729] via-[#832729]/95 to-transparent opacity-90"></div>
                <div class="absolute bottom-0 w-full h-10 flex items-end justify-center pb-2">
                    <h2 class="pillar-title">Accessory</h2>
                </div>
            </a>
        </div>

    </div>
</section>

<!-- Language of Flowers Section -->
<section class="relative overflow-hidden bg-[#fafaf8]">
    <div class="flex flex-col lg:flex-row min-h-[500px] md:min-h-[550px] lg:min-h-[600px] max-h-[700px]">
        <!-- Left: Text Content -->
        <div class="flex-1 flex items-center justify-center p-12 md:p-16 lg:p-20 bg-white">
            <div class="text-center max-w-lg">
                <div class="mb-6">
                    <svg class="w-12 h-12 mx-auto text-[#d4a574]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-light leading-tight text-gray-800 font-tanishq-display mb-6 tracking-tight">
                    Language of
                    <span class="block mt-2">Flowers</span>
                </h2>
                <p class="mt-6 text-base text-gray-600 font-light leading-relaxed italic">
                    "Ceremonial Indian flowers transcend seasons"
                </p>
                <p class="mt-4 text-sm text-gray-500 font-light leading-relaxed">
                    Bring home porcelain platters and fine bone china that celebrate their enduring beauty all year long.
                </p>
                <a href="{{ route('shop') }}"
                    class="mt-8 inline-block px-10 py-3 border border-gray-800 text-gray-800 text-xs font-light tracking-widest uppercase transition-all duration-300 hover:bg-gray-800 hover:text-white">
                    Discover
                </a>
            </div>
        </div>

        <!-- Right: Full Image -->
        <div class="relative flex-1 overflow-hidden">
            <img
                src="{{ asset('assets/imgs/tea-black-tea-with-turkish-delight-dried-flowers-teapot-tray.jpg') }}"
                alt="Language of Flowers"
                class="w-full h-full object-cover object-center"
                loading="lazy">
        </div>
    </div>
</section>

<!-- The Gift Section - Three Column -->
<section class="relative overflow-hidden bg-white">
    <div class="flex flex-col md:flex-row min-h-[450px] md:min-h-[500px] lg:min-h-[600px] max-h-[700px]">
        <!-- Left Image -->
        <div class="relative flex-1 overflow-hidden">
            <img
                src="{{ asset('assets/imgs/cup-candles-vase-with-protea-flowers-knitted-element-room-blurred-background.jpg') }}"
                alt="Artisan Crafts"
                class="w-full h-full object-cover object-center"
                loading="lazy">
        </div>

        <!-- Center: Text Overlay -->
        <div class="relative flex-1 flex items-center justify-center p-12 md:p-16 bg-[#e8e5e0]">
            <div class="text-center max-w-md">
                <h2 class="text-xl md:text-2xl font-light tracking-[0.25em] uppercase mb-6 text-gray-700">
                    The Gift Of
                </h2>
                <div class="mb-6">
                    <svg class="w-10 h-10 mx-auto text-[#d4a574]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <h3 class="text-3xl md:text-4xl font-light font-tanishq-display mb-6 tracking-tight text-gray-800">
                    StyleStore
                </h3>
                <p class="text-sm font-light leading-relaxed text-gray-600 mb-2 italic">
                    "Nature-inspired designs that evoke floral splendour"
                </p>
                <p class="text-xs font-light leading-relaxed text-gray-500 mb-8">
                    Make everyday moments feel a little more special.
                </p>
                <a href="{{ route('shop') }}"
                    class="inline-block px-10 py-3 border border-gray-800 text-gray-800 text-xs font-light tracking-widest uppercase transition-all duration-300 hover:bg-gray-800 hover:text-white">
                    Gifting
                </a>
            </div>
        </div>

        <!-- Right Image -->
        <div class="relative flex-1 overflow-hidden">
            <img
                src="{{ asset('assets/imgs/flower-vase-modern-interior.jpg') }}"
                alt="Home Decor"
                class="w-full h-full object-cover object-center"
                loading="lazy">
        </div>
    </div>
</section>

<!-- Traditional Heritage Section -->
<section class="relative overflow-hidden bg-[#f5f3f0]">
    <div class="flex flex-col lg:flex-row-reverse min-h-[500px] md:min-h-[550px] lg:min-h-[600px] max-h-[700px]">
        <!-- Right: Text Content -->
        <div class="flex-1 flex items-center justify-center p-12 md:p-16 lg:p-20">
            <div class="text-center max-w-lg">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-light leading-tight text-gray-800 font-tanishq-display mb-6 tracking-tight">
                    Timeless
                    <span class="block mt-2">Traditions</span>
                </h2>
                <p class="mt-6 text-base text-gray-600 font-light leading-relaxed italic">
                    "Every piece tells a story of heritage and artistry"
                </p>
                <p class="mt-4 text-sm text-gray-500 font-light leading-relaxed">
                    Experience the warmth of traditional craftsmanship. From ornate mirrors to hand-painted ceramics, discover treasures that transcend time.
                </p>
                <a href="{{ route('shop') }}"
                    class="mt-8 inline-block px-10 py-3 border border-gray-800 text-gray-800 text-xs font-light tracking-widest uppercase transition-all duration-300 hover:bg-gray-800 hover:text-white">
                    Explore Collection
                </a>
            </div>
        </div>

        <!-- Left: Full Image -->
        <div class="relative flex-1 overflow-hidden">
            <img
                src="{{ asset('assets/imgs/still-life-vintage-objects.jpg') }}"
                alt="Timeless Traditions"
                class="w-full h-full object-cover object-center"
                loading="lazy">
        </div>
    </div>
</section>

<!-- Coffee Culture Section - Full Width Banner -->
<section class="relative overflow-hidden bg-[#2c2825] h-[500px] md:h-[600px] lg:h-[650px]">
    <img
        src="{{ asset('assets/imgs/traditional-turkish-coffee-side-view.jpg') }}"
        alt="Coffee Culture"
        class="absolute inset-0 w-full h-full object-cover object-center opacity-50"
        loading="lazy">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#2c2825]/30 to-[#2c2825]/70"></div>
    
    <div class="absolute inset-0 flex items-center justify-center px-4">
        <div class="text-center max-w-3xl text-white">
            <div class="mb-6">
                <svg class="w-10 h-10 mx-auto text-[#d4a574]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-light leading-tight font-tanishq-display mb-6 tracking-tight">
                The Art of
                <span class="block mt-3">Coffee & Tea</span>
            </h2>
            <p class="text-base md:text-lg font-light leading-relaxed mb-2 max-w-2xl mx-auto italic">
                "Transform every pour into a ceremony"
            </p>
            <p class="text-sm font-light leading-relaxed opacity-80 mb-10 max-w-xl mx-auto">
                Discover our exquisite collection of serveware that makes every sip a moment of pure indulgence.
            </p>
            <a href="{{ route('shop') }}"
                class="inline-block px-12 py-3 bg-white text-gray-900 text-xs font-light tracking-widest uppercase transition-all duration-300 hover:bg-[#d4a574] hover:text-white">
                Shop The Collection
            </a>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-20 bg-[#fafafa]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-light text-gray-900 mb-4 font-tanishq-display tracking-tight">Featured Products</h2>
            <p class="text-base text-gray-600 font-light max-w-2xl mx-auto">Handpicked items that define style and elegance, carefully selected for you</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            @foreach($featuredProducts as $product)
            <div class="group flex flex-col">
                <!-- Product Image -->
                <div class="relative overflow-hidden aspect-[3/4] bg-gray-50 mb-5">
                    <a href="{{ route('product.show', $product) }}" class="block h-full">
                        @php
                            $placeholderImage = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='1066'%3E%3Crect fill='%23EAEAEA' width='800' height='1066'/%3E%3Ctext fill='%23999999' font-family='sans-serif' font-size='20' dy='10.5' font-weight='bold' x='50%25' y='50%25' text-anchor='middle'%3ELoading...%3C/text%3E%3C/svg%3E";
                            $errorPlaceholder = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='1066'%3E%3Crect fill='%23EAEAEA' width='800' height='1066'/%3E%3Ctext fill='%23999999' font-family='sans-serif' font-size='20' dy='10.5' font-weight='bold' x='50%25' y='50%25' text-anchor='middle'%3ENo Image%3C/text%3E%3C/svg%3E";
                        @endphp
                        <img src="{{ $placeholderImage }}" 
                             data-src="{{ $product->main_image_url }}" 
                             alt="{{ $product->name }}"
                             loading="lazy"
                             onerror="this.onerror=null; this.src='{{ $errorPlaceholder }}';"
                             class="w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-90">
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
            @endforeach
        </div>

        <div class="text-center mt-16">
            <a href="{{ route('shop') }}"
                class="btn-primary px-10 py-4 text-lg">
                View All Products →
            </a>
        </div>
    </div>
</section>

<!-- Latest Products -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-light text-gray-900 mb-4 font-tanishq-display tracking-tight">Latest Arrivals</h2>
            <p class="text-base text-gray-600 font-light">Fresh styles just added to our collection</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            @foreach($latestProducts as $product)
            <div class="group flex flex-col">
                <!-- Product Image -->
                <div class="relative overflow-hidden aspect-[3/4] bg-gray-50 mb-5">
                    <a href="{{ route('product.show', $product) }}" class="block h-full">
                        @php
                            $placeholderImage = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='1066'%3E%3Crect fill='%23EAEAEA' width='800' height='1066'/%3E%3Ctext fill='%23999999' font-family='sans-serif' font-size='20' dy='10.5' font-weight='bold' x='50%25' y='50%25' text-anchor='middle'%3ELoading...%3C/text%3E%3C/svg%3E";
                            $errorPlaceholder = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='1066'%3E%3Crect fill='%23EAEAEA' width='800' height='1066'/%3E%3Ctext fill='%23999999' font-family='sans-serif' font-size='20' dy='10.5' font-weight='bold' x='50%25' y='50%25' text-anchor='middle'%3ENo Image%3C/text%3E%3C/svg%3E";
                        @endphp
                        <img src="{{ $placeholderImage }}" 
                             data-src="{{ $product->main_image_url }}" 
                             alt="{{ $product->name }}"
                             loading="lazy"
                             onerror="this.onerror=null; this.src='{{ $errorPlaceholder }}';"
                             class="w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-90">
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
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section - Good Earth Style -->
<section class="relative overflow-hidden bg-[#fafafa] py-20 border-t border-gray-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-light text-gray-900 mb-4 font-tanishq-display tracking-tight">
            Stay in the Loop
        </h2>
        <p class="text-base text-gray-600 mb-10 max-w-2xl mx-auto font-light leading-relaxed">
            Get the latest updates on new products, exclusive offers, and style tips delivered to your inbox
        </p>
        <form class="max-w-lg mx-auto flex flex-col sm:flex-row gap-3">
            <input type="email"
                placeholder="Enter your email address"
                class="flex-1 px-5 py-3 bg-white border border-gray-300 text-gray-900 placeholder-gray-400 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400 font-light">
            <button type="submit"
                class="px-8 py-3 bg-gray-900 text-white text-sm font-light tracking-wide uppercase transition-all duration-300 hover:bg-gray-800">
                Subscribe Now
            </button>
        </form>
        <p class="text-gray-500 text-xs mt-6 font-light">Join 10,000+ happy customers who get our updates</p>
    </div>
</section>
@endsection

@push('scripts')
<script>
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