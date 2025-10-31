@extends('layouts.app')

@section('title', 'Home')
@section('description', 'Shop premium accessories, cosmetics, jewelry, and fashion items at our online store.')

@section('content')
<!-- Hero Section -->
{{-- resources/views/partials/hero.blade.php  (or wherever you keep it) --}}

<section class="relative overflow-hidden bg-gray-900">
    {{-- 1. The image itself – object-cover forces it to fill the container --}}
    <img
        src="{{ asset('assets/imgs/Hero.jpg') }}"
        alt="Hero background"
        class="absolute inset-0 w-full h-full object-cover object-center py-5"
        loading="eager">

    {{-- 2. Dark overlay – keeps the text readable --}}
    <div class="absolute inset-0 bg-black/60"></div>

    {{-- 3. Content – sits on top of the image --}}
    <div class="relative z-10 flex min-h-screen items-center justify-end px-4 sm:px-6 lg:px-8">
        <div class="mx-auto  text-right">
            <h1 class="text-5xl font-bold leading-tight md:text-7xl text-white font-tanishq-display">
                Transform Your
                <span class="block text-yellow-300">Living Space</span>
            </h1>

            <p class="mx-auto mt-6 text-xl text-pink-100 md:text-2xl py-3 font-tanishq">
                Premium home decor and accessories curated for the modern home.
                Express your style with our exclusive collection of beautiful furnishings.
            </p>

            <div class="mt-10 flex flex-col justify-end my-6 gap-6 sm:flex-row">
                <a href="{{ route('shop') }}"
                    class="rounded-full bg-white px-10 py-4 font-bold text-pink-600 text-lg shadow-lg transition-all hover:bg-gray-100 hover:scale-105">
                    Shop Now
                </a>
                <a href="#featured"
                    class="rounded-full border-2 border-white px-10 py-4 font-bold text-white text-lg transition-all hover:bg-white hover:text-pink-600 hover:scale-105">
                    Explore Collection
                </a>
            </div>
        </div>
    </div>
</section>
<div class="flex flex-col md:flex-row min-h-screen bg-pink-600">
    <!-- Left: Text Content -->
    <div class="flex-1 flex items-center justify-center p-6 md:p-12">
        <div class="text-center text-white max-w-md">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight font-tanishq-display">
                Innovate with Us
            </h1>
            <p class="mt-4 text-lg opacity-90 font-tanishq">
                Discover new possibilities and drive success.
            </p>
            <a href="https://spacema-dev.com/free-tailwind-css-templates/"
                class="mt-6 inline-block bg-white text-blue-600 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition-all hover:scale-105">
                Free Tailwind Template
            </a>
        </div>
    </div>

    <!-- Right: Full Image (using <img> + object-cover) -->
    <div class="relative flex-1 overflow-hidden">
        <img
            src="{{ asset('assets/imgs/Banner2.jpg') }}"
            alt="Innovation background"
            class="absolute inset-0 object-cover object-center"
            loading="eager">
    </div>
</div>
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
<section class="py-12 lg:py-20 bg-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6 font-tanishq-display">Shop by Category</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-tanishq">Explore our carefully curated collection of premium products across different categories</p>
        </div>

        <!-- Desktop Layout: 2 + 2 -->
        <div class="hidden md:flex justify-center gap-2 pb-12">

            <!-- Left Column: Wedding + Gold -->
            <div class="flex flex-col gap-2">
                <!-- Home -->
                <a href="{{ route('shop') }}" class="group relative block overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
                    <img src="{{ asset('assets/imgs/HomeDecor2.jpg') }}"
                        alt="Home"
                        class=" pillar-img object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#832729] via-[#832729]/95 to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 w-full h-32 flex items-end justify-center pb-8">
                        <h2 class="pillar-title">Home</h2>
                    </div>
                </a>

                <!-- Style -->
                <a href="{{ route('shop') }}" class="group relative block overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
                    <img src="{{ asset('assets/imgs/HomeDecor1.jpg') }}"
                        alt="Style"
                        class="w-full pillar-img-alt object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#832729] via-[#832729]/95 to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 w-full h-32 flex items-end justify-center pb-8">
                        <h2 class="pillar-title">Style</h2>
                    </div>
                </a>
            </div>

            <!-- Right Column: Diamond + Dailywear -->
            <div class="flex flex-col gap-2">
                <!-- Decor -->
                <a href="{{ route('shop') }}" class="group relative block overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
                    <img src="{{ asset('assets/imgs/HomeDecor.jpg') }}"
                        alt="Decor"
                        class="w-full pillar-img-alt object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#832729] via-[#832729]/95 to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 w-full h-32 flex items-end justify-center pb-8">
                        <h2 class="pillar-title">Decor</h2>
                    </div>
                </a>

                <!-- Accessory -->
                <a href="{{ route('shop') }}" class="group relative block overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
                    <img src="{{ asset('assets/imgs/HomeDecor3.jpg') }}"
                        alt="Accessory"
                        class="w-full pillar-img object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#832729] via-[#832729]/95 to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 w-full h-32 flex items-end justify-center pb-8">
                        <h2 class="pillar-title">Accessory</h2>
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
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6 font-tanishq-display">Featured Products</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-tanishq">Handpicked items that define style and elegance, carefully selected for you</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
            <div class="product-card">
                <div class="relative overflow-hidden">
                    <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}"
                        class="w-full h-72 object-cover group-hover:scale-105 hover: transition-transform duration-300">
                    @if($product->sale_price)
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                        {{ $product->discount_percentage }}% OFF
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm text-pink-600 font-bold uppercase tracking-wide">{{ $product->brand->name }}</span>
                        <div class="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="star" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @endfor
                                <span class="text-sm text-gray-500 ml-2">({{ $product->review_count }})</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 font-tanishq">
                        {{ $product->name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $product->short_description }}
                    </p>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-2">
                            @if($product->sale_price)
                            <span class="sale-price">₹{{ number_format($product->sale_price, 2) }}</span>
                            <span class="original-price">₹{{ number_format($product->price, 2) }}</span>
                            @else
                            <span class="price-text">₹{{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('product.show', $product) }}"
                            class="flex-1 btn-primary text-center">
                            View Details
                        </a>
                        <button class="bg-gray-100 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-200 transition-colors add-to-cart"
                            data-product-id="{{ $product->id }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                            </svg>
                        </button>
                    </div>
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
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4 font-tanishq-display">Latest Arrivals</h2>
            <p class="text-gray-600 font-tanishq">Fresh styles just added to our collection</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($latestProducts as $product)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow group">
                <div class="aspect-w-1 aspect-h-1">
                    <div class="w-full h-64 bg-gray-200 rounded-t-lg overflow-hidden">
                        <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-blue-600 font-semibold">{{ $product->brand->name }}</span>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">NEW</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 font-tanishq">
                        {{ $product->name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $product->short_description }}
                    </p>
                    <div class="flex items-center justify-between">
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
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @endfor
                                <span class="text-sm text-gray-600 ml-1">({{ $product->review_count }})</span>
                        </div>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('product.show', $product) }}"
                            class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition-colors">
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
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-20 gradient-bg relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2016&q=80');"></div>
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-tanishq-display">Stay in the Loop</h2>
        <p class="text-xl text-pink-100 mb-10 max-w-2xl mx-auto font-tanishq">Get the latest updates on new products, exclusive offers, and style tips delivered to your inbox</p>
        <form class="max-w-lg mx-auto flex flex-col sm:flex-row gap-4">
            <input type="email"
                placeholder="Enter your email address"
                class="flex-1 px-6 py-4 rounded-full focus:outline-none focus:ring-4 focus:ring-white/30 text-gray-900 placeholder-gray-500">
            <button type="submit"
                class="bg-white text-pink-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                Subscribe Now
            </button>
        </form>
        <p class="text-pink-200 text-sm mt-6">Join 10,000+ happy customers who get our updates</p>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 w-24 h-24 bg-white opacity-10 rounded-full"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-yellow-300 opacity-20 rounded-full"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-pink-300 opacity-30 rounded-full"></div>
</section>
@endsection

@push('scripts')
<script>
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