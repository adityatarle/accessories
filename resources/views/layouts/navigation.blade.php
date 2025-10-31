<nav x-data="{ open: false, cartOpen: false, scrolled: false }" 
     @scroll.window="scrolled = window.scrollY > 50"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
     :class="scrolled ? 'bg-white shadow-lg sticky top-0 text-gray-900' : 'bg-transparent absolute top-0 left-0 w-full text-white'"
     class="transition-all duration-300 w-full z-50">
    <!-- Top Bar -->
    <div x-show="!scrolled" class="bg-transparent text-white py-2 transition-opacity duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center space-x-4">
                    <span>Free shipping on orders over ₹1000</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span>Call: +91 9876543210</span>
                    <span>|</span>
                    <span>Email: info@accessoriesstore.com</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" :class="scrolled ? 'text-gray-900' : 'text-white'">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <div class="text-3xl font-bold font-tanishq-display group-hover:scale-105 transition-transform duration-200" 
                         :class="scrolled ? 'text-gray-900' : 'text-white'">
                        <span :class="scrolled ? 'text-pink-600' : 'text-gradient'">Style</span><span :class="scrolled ? 'text-gray-900' : 'text-white'">Store</span>
                    </div>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex-1 max-w-lg mx-8">
                <form action="{{ route('shop') }}" method="GET" class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search products..." 
                           class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" 
                   :class="scrolled ? 'text-gray-700 hover:text-pink-600' : 'text-white hover:text-pink-600'"
                   class="px-3 py-2 text-sm font-medium transition-colors">
                    Home
                </a>
                <a href="{{ route('shop') }}" 
                   :class="scrolled ? 'text-gray-700 hover:text-pink-600' : 'text-white hover:text-pink-600'"
                   class="px-3 py-2 text-sm font-medium transition-colors">
                    Shop
                </a>
                <a href="{{ route('categories.index') }}" 
                   :class="scrolled ? 'text-gray-700 hover:text-pink-600' : 'text-white hover:text-pink-600'"
                   class="px-3 py-2 text-sm font-medium transition-colors">
                    Categories
                </a>
                <a href="{{ route('about.index') }}" 
                   :class="scrolled ? 'text-gray-700 hover:text-pink-600' : 'text-white hover:text-pink-600'"
                   class="px-3 py-2 text-sm font-medium transition-colors">
                    About
                </a>
            </div>

            <!-- Right Side Icons -->
            <div class="flex items-center space-x-4">
                <!-- Wishlist -->
                @auth
                <a href="{{ route('wishlist.index') }}" 
                   :class="scrolled ? 'text-gray-700 hover:text-pink-600' : 'text-white hover:text-pink-600'"
                   class="p-2 relative transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </a>
                @endauth

                <!-- Cart -->
                <button @click="cartOpen = !cartOpen" 
                        :class="scrolled ? 'text-gray-700 hover:text-pink-600' : 'text-white hover:text-pink-600'"
                        class="p-2 relative transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                    </svg>
                    <span id="cart-count" class="absolute -top-1 -right-1 bg-pink-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                </button>

                <!-- User Account -->
                @auth
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            :class="scrolled ? 'text-gray-700 hover:text-pink-600' : 'text-white hover:text-pink-600'"
                            class="flex items-center p-2 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" 
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border">
                        <a href="{{ route('profile.edit') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="{{ route('orders.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Orders</a>
                        <a href="{{ route('wishlist.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Wishlist</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="flex items-center space-x-2">
                    <a href="{{ route('auth.unified') }}" 
                       :class="scrolled ? 'text-gray-700 hover:text-pink-600' : 'text-white hover:text-pink-600'"
                       class="px-3 py-2 text-sm font-medium transition-colors">
                        Login
                    </a>
                    <a href="{{ route('auth.register') }}" 
                       class="bg-pink-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-pink-700 transition-colors">
                        Sign Up
                    </a>
                </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="open = !open" 
                        :class="scrolled ? 'text-gray-700' : 'text-white'"
                        class="md:hidden p-2 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="md:hidden" :class="scrolled ? 'bg-white' : 'bg-transparent'">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t" :class="scrolled ? 'bg-white border-gray-200' : 'bg-transparent border-gray-700'">
            <a href="{{ route('home') }}" 
               :class="scrolled ? 'text-gray-700' : 'text-white'"
               class="block px-3 py-2 text-base font-medium hover:text-pink-600">Home</a>
            <a href="{{ route('shop') }}" 
               :class="scrolled ? 'text-gray-700' : 'text-white'"
               class="block px-3 py-2 text-base font-medium hover:text-pink-600">Shop</a>
            <a href="{{ route('categories.index') }}" 
               :class="scrolled ? 'text-gray-700' : 'text-white'"
               class="block px-3 py-2 text-base font-medium hover:text-pink-600">Categories</a>
            <a href="{{ route('about.index') }}" 
               :class="scrolled ? 'text-gray-700' : 'text-white'"
               class="block px-3 py-2 text-base font-medium hover:text-pink-600">About</a>
        </div>
    </div>

    <!-- Cart Dropdown -->
    <div x-show="cartOpen" @click.away="cartOpen = false" 
         class="absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-lg border z-50">
        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Shopping Cart</h3>
                <button @click="cartOpen = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="cart-items">
                <!-- Cart items will be loaded here by Vue.js -->
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                    </svg>
                    <p>Your cart is empty</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t">
                <a href="{{ route('cart') }}" 
                   class="block w-full bg-pink-600 text-white text-center py-2 rounded-lg hover:bg-pink-700 transition-colors">
                    View Cart
                </a>
            </div>
        </div>
    </div>
</nav>