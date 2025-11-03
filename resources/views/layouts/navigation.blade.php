<nav x-data="{ open: false, cartOpen: false, scrolled: false }" 
     @scroll.window="scrolled = window.scrollY > 50"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
     :class="scrolled ? 'bg-white shadow-sm sticky top-0 text-gray-900 border-b border-gray-100' : 'bg-white text-gray-900 border-b border-gray-100'"
     class="transition-all duration-300 w-full z-50">
    
    <!-- Main Navigation - Good Earth Style -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <div class="text-2xl font-light tracking-wide text-gray-900 font-tanishq-display group-hover:opacity-70 transition-opacity duration-200">
                        StyleStore
                    </div>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex-1 max-w-md mx-8 hidden md:block">
                <form action="{{ route('shop') }}" method="GET" class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search products..." 
                           class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-50 border border-gray-200 rounded-sm focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400 text-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Navigation Links - Good Earth Style -->
            <div class="hidden md:flex items-center space-x-10">
                <a href="{{ route('home') }}" 
                   class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-light tracking-wide transition-colors border-b-2 border-transparent hover:border-gray-900">
                    Home
                </a>
                <a href="{{ route('shop') }}" 
                   class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-light tracking-wide transition-colors border-b-2 border-transparent hover:border-gray-900">
                    Shop
                </a>
                <a href="{{ route('categories.index') }}" 
                   class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-light tracking-wide transition-colors border-b-2 border-transparent hover:border-gray-900">
                    Categories
                </a>
                <a href="{{ route('about.index') }}" 
                   class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-light tracking-wide transition-colors border-b-2 border-transparent hover:border-gray-900">
                    About
                </a>
            </div>

            <!-- Right Side Icons - Good Earth Style -->
            <div class="flex items-center space-x-6">
                <!-- Search Icon for Mobile -->
                <button class="md:hidden text-gray-700 hover:text-gray-900 p-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- Wishlist -->
                @auth
                <a href="{{ route('wishlist.index') }}" 
                   class="text-gray-700 hover:text-gray-900 p-2 relative transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </a>
                @endauth

                <!-- Cart -->
                <button @click="cartOpen = !cartOpen" 
                        class="text-gray-700 hover:text-gray-900 p-2 relative transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                    </svg>
                    <span id="cart-count" class="absolute -top-1 -right-1 bg-gray-900 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center font-light">0</span>
                </button>

                <!-- User Account - Good Earth Style -->
                @auth
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="text-gray-700 hover:text-gray-900 p-2 transition-colors flex items-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" 
                         class="absolute right-0 mt-2 w-48 bg-white shadow-lg py-2 z-50 border border-gray-100">
                        <a href="{{ route('profile.edit') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 font-light transition-colors">Profile</a>
                        <a href="{{ route('orders.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 font-light transition-colors">My Orders</a>
                        <a href="{{ route('wishlist.index') }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 font-light transition-colors">Wishlist</a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 font-light transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('auth.unified') }}" 
                       class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-light tracking-wide transition-colors">
                        Login
                    </a>
                    <a href="{{ route('orders.index') }}" 
                       class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-light tracking-wide transition-colors">
                        Track Order
                    </a>
                </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="open = !open" 
                        class="md:hidden text-gray-700 p-2 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu - Good Earth Style -->
    <div x-show="open" class="md:hidden bg-white border-t border-gray-100">
        <div class="px-4 pt-4 pb-6 space-y-1">
            <a href="{{ route('home') }}" 
               class="block px-3 py-3 text-base font-light text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition-colors">Home</a>
            <a href="{{ route('shop') }}" 
               class="block px-3 py-3 text-base font-light text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition-colors">Shop</a>
            <a href="{{ route('categories.index') }}" 
               class="block px-3 py-3 text-base font-light text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition-colors">Categories</a>
            <a href="{{ route('about.index') }}" 
               class="block px-3 py-3 text-base font-light text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition-colors">About</a>
        </div>
    </div>

    <!-- Cart Dropdown - Good Earth Style -->
    <div x-show="cartOpen" @click.away="cartOpen = false" 
         class="absolute right-0 mt-2 w-96 bg-white shadow-lg border border-gray-100 z-50">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-base font-light tracking-wide text-gray-900">Shopping Cart</h3>
                <button @click="cartOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="cart-items">
                <!-- Cart items will be loaded here by Vue.js -->
                <div class="text-center py-12 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                    </svg>
                    <p class="text-sm font-light">Your cart is empty</p>
                </div>
            </div>
            <div class="mt-6 pt-6 border-t border-gray-100">
                <a href="{{ route('cart') }}" 
                   class="block w-full bg-gray-900 text-white text-center py-3 text-sm font-light tracking-wide hover:bg-gray-800 transition-colors">
                    View Cart
                </a>
            </div>
        </div>
    </div>
</nav>