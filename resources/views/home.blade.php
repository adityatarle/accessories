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
                        <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}"
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
                        <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}"
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