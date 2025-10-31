@extends('layouts.app')

@section('title', 'About Us - Your Trusted Accessories & Cosmetics Store')
@section('description', 'Learn about our mission to provide premium accessories, cosmetics, and jewelry. Discover our story, values, and commitment to quality.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="relative mb-16 rounded-2xl overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2016&q=80" alt="About Us" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-40"></div>
        </div>
        <div class="relative text-center py-20 px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">About StyleStore</h1>
            <p class="text-xl text-gray-100 max-w-3xl mx-auto">
                Your premier destination for premium home decor and accessories. 
                We're passionate about helping you transform your living space.
            </p>
        </div>
    </div>

    <!-- Our Story -->
    <div class="mb-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                <div class="space-y-4 text-gray-600">
                    <p>
                        Founded in 2020, StyleStore began as a small online boutique with a simple mission: 
                        to make premium accessories and cosmetics accessible to everyone. What started as a 
                        passion project has grown into a trusted destination for thousands of customers worldwide.
                    </p>
                    <p>
                        We believe that everyone deserves to feel confident and beautiful, which is why we 
                        carefully curate our collection to include only the highest quality products from 
                        trusted brands and emerging designers.
                    </p>
                    <p>
                        Today, we're proud to serve customers across the globe, offering everything from 
                        elegant jewelry and luxury cosmetics to trendy accessories and fashion essentials.
                    </p>
                </div>
            </div>
            <div class="relative rounded-2xl overflow-hidden">
                <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Quality First" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-pink-900/80 to-purple-900/80"></div>
                <div class="relative p-8 text-center">
                    <h3 class="text-2xl font-bold text-white mb-4">Quality First</h3>
                    <p class="text-gray-100">
                        Every product in our collection is carefully selected for its quality, 
                        durability, and style. We work directly with manufacturers to ensure 
                        the highest standards.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Values -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Our Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-pink-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <div class="text-2xl">💎</div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Quality</h3>
                <p class="text-gray-600 text-sm">
                    We never compromise on quality. Every product is carefully selected and tested.
                </p>
            </div>
            <div class="text-center">
                <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <div class="text-2xl">🤝</div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Trust</h3>
                <p class="text-gray-600 text-sm">
                    Building lasting relationships with our customers through transparency and reliability.
                </p>
            </div>
            <div class="text-center">
                <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <div class="text-2xl">🎨</div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Style</h3>
                <p class="text-gray-600 text-sm">
                    Helping you express your unique personality through carefully curated collections.
                </p>
            </div>
            <div class="text-center">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <div class="text-2xl">🌱</div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Sustainability</h3>
                <p class="text-gray-600 text-sm">
                    Committed to ethical sourcing and environmentally conscious business practices.
                </p>
            </div>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="mb-16 bg-gray-50 rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Why Choose StyleStore?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="flex items-start space-x-4">
                <div class="bg-pink-600 text-white rounded-lg p-2 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Free Shipping</h3>
                    <p class="text-gray-600">Free shipping on orders over ₹1000. Fast and reliable delivery worldwide.</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="bg-pink-600 text-white rounded-lg p-2 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Easy Returns</h3>
                    <p class="text-gray-600">30-day return policy. Not satisfied? Return it hassle-free.</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="bg-pink-600 text-white rounded-lg p-2 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Round-the-clock customer support to help you with any questions.</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="bg-pink-600 text-white rounded-lg p-2 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Secure Shopping</h3>
                    <p class="text-gray-600">Your data and payments are protected with industry-standard security.</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="bg-pink-600 text-white rounded-lg p-2 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Fast Processing</h3>
                    <p class="text-gray-600">Quick order processing and same-day shipping on most orders.</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="bg-pink-600 text-white rounded-lg p-2 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Exclusive Deals</h3>
                    <p class="text-gray-600">Special offers and exclusive deals for our valued customers.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Get in Touch</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-pink-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Phone</h3>
                <p class="text-gray-600">+91 9876543210</p>
            </div>
            <div class="text-center">
                <div class="bg-pink-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-600">info@accessoriesstore.com</p>
            </div>
            <div class="text-center">
                <div class="bg-pink-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Address</h3>
                <p class="text-gray-600">123 Fashion Street<br>Mumbai, India 400001</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="text-center bg-gradient-to-r from-pink-50 to-purple-50 rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Ready to Start Shopping?</h2>
        <p class="text-gray-600 mb-6">Explore our collection and find the perfect accessories for your style.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('shop') }}" 
               class="btn-primary">
                Shop Now
            </a>
            <a href="{{ route('categories.index') }}" 
               class="btn-secondary">
                Browse Categories
            </a>
        </div>
    </div>
</div>
@endsection
