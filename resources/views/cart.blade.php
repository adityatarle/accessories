@extends('layouts.app')

@section('title', 'Shopping Cart')
@section('description', 'Review your selected items and proceed to checkout.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Shopping Cart</h1>
        <p class="text-gray-600">Review your items and proceed to checkout</p>
    </div>

    @if($cartItems->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Cart Items ({{ $cartItems->count() }})</h2>
                </div>
                
                <div class="divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                <div class="w-20 h-20 bg-gray-200 rounded-lg overflow-hidden">
                                    <div class="w-full h-full bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="text-2xl">✨</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Product Details -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $item->product->brand->name }}</p>
                                <p class="text-sm text-gray-500">SKU: {{ $item->product->sku }}</p>
                                
                                <!-- Quantity Controls -->
                                <div class="mt-4 flex items-center space-x-4">
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button type="button" 
                                                class="px-3 py-1 text-gray-600 hover:text-gray-800 update-quantity" 
                                                data-cart-id="{{ $item->id }}" 
                                                data-action="decrease">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <span class="px-3 py-1 text-gray-900 quantity-display">{{ $item->quantity }}</span>
                                        <button type="button" 
                                                class="px-3 py-1 text-gray-600 hover:text-gray-800 update-quantity" 
                                                data-cart-id="{{ $item->id }}" 
                                                data-action="increase">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <!-- Remove Button -->
                                    <button type="button" 
                                            class="text-red-600 hover:text-red-800 text-sm remove-item" 
                                            data-cart-id="{{ $item->id }}">
                                        Remove
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Price -->
                            <div class="text-right">
                                <div class="text-lg font-semibold text-gray-900">
                                    ₹{{ number_format($item->total, 2) }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    ₹{{ number_format($item->price, 2) }} each
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">₹{{ number_format($subtotal, 2) }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax (18%)</span>
                        <span class="font-semibold">₹{{ number_format($tax, 2) }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-semibold">
                            @if($subtotal > 1000)
                                <span class="text-green-600">FREE</span>
                            @else
                                ₹{{ number_format($shipping, 2) }}
                            @endif
                        </span>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span>₹{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 space-y-4">
                    <a href="{{ route('checkout') }}" 
                       class="block w-full bg-pink-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-pink-700 transition-colors">
                        Proceed to Checkout
                    </a>
                    
                    <a href="{{ route('shop') }}" 
                       class="block w-full bg-gray-100 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-200 transition-colors">
                        Continue Shopping
                    </a>
                </div>
                
                <!-- Security Badges -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-center space-x-4 text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            Secure Checkout
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Money Back
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Empty Cart -->
    <div class="text-center py-16">
        <div class="text-6xl mb-4">🛒</div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Your cart is empty</h2>
        <p class="text-gray-600 mb-8">Looks like you haven't added any items to your cart yet.</p>
        <a href="{{ route('shop') }}" 
           class="bg-pink-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-pink-700 transition-colors">
            Start Shopping
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update quantity
    document.querySelectorAll('.update-quantity').forEach(button => {
        button.addEventListener('click', function() {
            const cartId = this.getAttribute('data-cart-id');
            const action = this.getAttribute('data-action');
            const quantityDisplay = this.parentElement.querySelector('.quantity-display');
            let currentQuantity = parseInt(quantityDisplay.textContent);
            
            if (action === 'increase') {
                currentQuantity++;
            } else if (action === 'decrease' && currentQuantity > 1) {
                currentQuantity--;
            }
            
            if (currentQuantity >= 1) {
                updateCartItem(cartId, currentQuantity);
            }
        });
    });
    
    // Remove item
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const cartId = this.getAttribute('data-cart-id');
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                removeCartItem(cartId);
            }
        });
    });
});

function updateCartItem(cartId, quantity) {
    fetch(`/cart/${cartId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update quantity display
            const quantityDisplay = document.querySelector(`[data-cart-id="${cartId}"]`).parentElement.querySelector('.quantity-display');
            quantityDisplay.textContent = quantity;
            
            // Update cart count
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.textContent = data.cart_count;
            }
            
            // Reload page to update totals
            location.reload();
        } else {
            alert(data.error || 'Something went wrong');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong');
    });
}

function removeCartItem(cartId) {
    fetch(`/cart/${cartId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.textContent = data.cart_count;
            }
            
            // Reload page to update cart
            location.reload();
        } else {
            alert(data.error || 'Something went wrong');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong');
    });
}
</script>
@endpush
