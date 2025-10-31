@extends('layouts.app')

@section('title', 'Checkout')
@section('description', 'Complete your order with secure checkout.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Checkout</h1>
        <p class="text-gray-600">Complete your order with secure checkout</p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        <!-- Checkout Form -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Shipping Address -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Shipping Address</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                        <input type="text" name="shipping_address[first_name]" required 
                               class="input-field" value="{{ old('shipping_address.first_name', auth()->user()->name ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                        <input type="text" name="shipping_address[last_name]" required 
                               class="input-field" value="{{ old('shipping_address.last_name') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="shipping_address[email]" required 
                               class="input-field" value="{{ old('shipping_address.email', auth()->user()->email ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                        <input type="tel" name="shipping_address[phone]" required 
                               class="input-field" value="{{ old('shipping_address.phone') }}">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                        <textarea name="shipping_address[address]" required rows="3" 
                                  class="input-field">{{ old('shipping_address.address') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                        <input type="text" name="shipping_address[city]" required 
                               class="input-field" value="{{ old('shipping_address.city') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                        <input type="text" name="shipping_address[state]" required 
                               class="input-field" value="{{ old('shipping_address.state') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code *</label>
                        <input type="text" name="shipping_address[postal_code]" required 
                               class="input-field" value="{{ old('shipping_address.postal_code') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                        <select name="shipping_address[country]" required class="input-field">
                            <option value="India" {{ old('shipping_address.country') == 'India' ? 'selected' : '' }}>India</option>
                            <option value="USA" {{ old('shipping_address.country') == 'USA' ? 'selected' : '' }}>USA</option>
                            <option value="UK" {{ old('shipping_address.country') == 'UK' ? 'selected' : '' }}>UK</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Billing Address -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Billing Address</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                        <input type="text" name="billing_address[first_name]" required 
                               class="input-field" value="{{ old('billing_address.first_name', auth()->user()->name ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                        <input type="text" name="billing_address[last_name]" required 
                               class="input-field" value="{{ old('billing_address.last_name') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="billing_address[email]" required 
                               class="input-field" value="{{ old('billing_address.email', auth()->user()->email ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                        <input type="tel" name="billing_address[phone]" required 
                               class="input-field" value="{{ old('billing_address.phone') }}">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                        <textarea name="billing_address[address]" required rows="3" 
                                  class="input-field">{{ old('billing_address.address') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                        <input type="text" name="billing_address[city]" required 
                               class="input-field" value="{{ old('billing_address.city') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                        <input type="text" name="billing_address[state]" required 
                               class="input-field" value="{{ old('billing_address.state') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code *</label>
                        <input type="text" name="billing_address[postal_code]" required 
                               class="input-field" value="{{ old('billing_address.postal_code') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                        <select name="billing_address[country]" required class="input-field">
                            <option value="India" {{ old('billing_address.country') == 'India' ? 'selected' : '' }}>India</option>
                            <option value="USA" {{ old('billing_address.country') == 'USA' ? 'selected' : '' }}>USA</option>
                            <option value="UK" {{ old('billing_address.country') == 'UK' ? 'selected' : '' }}>UK</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Payment Method</h2>
                <div class="space-y-4">
                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="payment_method" value="card" class="text-pink-600 focus:ring-pink-500" checked>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">Credit/Debit Card</div>
                            <div class="text-sm text-gray-500">Pay securely with your card</div>
                        </div>
                    </label>
                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="payment_method" value="upi" class="text-pink-600 focus:ring-pink-500">
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">UPI</div>
                            <div class="text-sm text-gray-500">Pay with UPI apps</div>
                        </div>
                    </label>
                    <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="payment_method" value="cod" class="text-pink-600 focus:ring-pink-500">
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">Cash on Delivery</div>
                            <div class="text-sm text-gray-500">Pay when your order arrives</div>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="card p-6 sticky top-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Order Summary</h2>
                
                <!-- Cart Items -->
                <div class="space-y-4 mb-6">
                    @foreach($cartItems as $item)
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden">
                            <div class="w-full h-full bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center">
                                <div class="text-2xl">✨</div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                        </div>
                        <div class="text-sm font-medium text-gray-900">
                            ₹{{ number_format($item->total, 2) }}
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Totals -->
                <div class="space-y-3 border-t border-gray-200 pt-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">₹{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax (18%)</span>
                        <span class="font-medium">₹{{ number_format($tax, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-medium">
                            @if($subtotal > 1000)
                                <span class="text-green-600">FREE</span>
                            @else
                                ₹{{ number_format($shipping, 2) }}
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-lg font-bold border-t border-gray-200 pt-3">
                        <span>Total</span>
                        <span>₹{{ number_format($total, 2) }}</span>
                    </div>
                </div>
                
                <button type="submit" 
                        class="w-full btn-primary mt-6 text-lg py-4">
                    Place Order
                </button>
                
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
    </form>
</div>
@endsection
