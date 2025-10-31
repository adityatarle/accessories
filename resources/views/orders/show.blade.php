@extends('layouts.app')

@section('title', 'Order Details - #' . $order->order_number)
@section('description', 'View detailed information about your order.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Details</h1>
                <p class="text-gray-600">Order #{{ $order->order_number }}</p>
            </div>
            <div class="flex items-center space-x-4">
                <span class="px-4 py-2 rounded-full text-sm font-medium {{ $order->status_badge_class }}">
                    {{ ucfirst($order->order_status) }}
                </span>
                <a href="{{ route('orders.index') }}" 
                   class="btn-secondary">
                    ← Back to Orders
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Items -->
        <div class="lg:col-span-2">
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Order Items</h2>
                
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                        <div class="w-20 h-20 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                            <div class="w-full h-full bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center">
                                <div class="text-3xl">✨</div>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-medium text-gray-900">{{ $item->product_name }}</h3>
                            <p class="text-sm text-gray-500">SKU: {{ $item->product_sku }}</p>
                            <p class="text-sm text-gray-500">Brand: {{ $item->product_brand ?? 'N/A' }}</p>
                            <div class="flex items-center space-x-4 mt-2">
                                <span class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</span>
                                <span class="text-sm text-gray-600">Price: ₹{{ number_format($item->unit_price, 2) }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-semibold text-gray-900">
                                ₹{{ number_format($item->total, 2) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Summary & Details -->
        <div class="space-y-6">
            <!-- Order Summary -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>
                
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="text-gray-900">₹{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    
                    @if($order->discount_amount > 0)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Discount</span>
                        <span class="text-green-600">-₹{{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                    @endif
                    
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Tax</span>
                        <span class="text-gray-900">₹{{ number_format($order->tax_amount, 2) }}</span>
                    </div>
                    
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Shipping</span>
                        <span class="text-gray-900">₹{{ number_format($order->shipping_amount, 2) }}</span>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-3">
                        <div class="flex justify-between text-lg font-semibold">
                            <span class="text-gray-900">Total</span>
                            <span class="text-gray-900">{{ $order->formatted_total }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Information -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Information</h2>
                
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Order Number</h3>
                        <p class="text-sm text-gray-900">{{ $order->order_number }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Order Date</h3>
                        <p class="text-sm text-gray-900">{{ $order->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Payment Method</h3>
                        <p class="text-sm text-gray-900">{{ ucfirst($order->payment_method ?? 'N/A') }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Payment Status</h3>
                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full 
                            {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($order->payment_status ?? 'pending') }}
                        </span>
                    </div>
                    
                    @if($order->tracking_number)
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Tracking Number</h3>
                        <p class="text-sm text-gray-900 font-mono">{{ $order->tracking_number }}</p>
                    </div>
                    @endif
                    
                    @if($order->shipped_at)
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Shipped Date</h3>
                        <p class="text-sm text-gray-900">{{ $order->shipped_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    @endif
                    
                    @if($order->delivered_at)
                    <div>
                        <h3 class="text-sm font-medium text-gray-600">Delivered Date</h3>
                        <p class="text-sm text-gray-900">{{ $order->delivered_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Shipping Address -->
            @if($order->shipping_address)
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Shipping Address</h2>
                
                <div class="text-sm text-gray-900">
                    @if(is_array($order->shipping_address))
                        <p class="font-medium">{{ $order->shipping_address['name'] ?? '' }}</p>
                        <p>{{ $order->shipping_address['address'] ?? '' }}</p>
                        <p>{{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} {{ $order->shipping_address['postal_code'] ?? '' }}</p>
                        <p>{{ $order->shipping_address['country'] ?? '' }}</p>
                        @if(isset($order->shipping_address['phone']))
                        <p class="mt-2">Phone: {{ $order->shipping_address['phone'] }}</p>
                        @endif
                    @else
                        <p>{{ $order->shipping_address }}</p>
                    @endif
                </div>
            </div>
            @endif

            <!-- Order Actions -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Actions</h2>
                
                <div class="space-y-3">
                    @if($order->order_status === 'delivered')
                    <button class="w-full btn-primary">
                        Leave Review
                    </button>
                    @endif
                    
                    @if($order->order_status === 'pending')
                    <button class="w-full bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200 transition-colors">
                        Cancel Order
                    </button>
                    @endif
                    
                    @if($order->tracking_number)
                    <a href="#" class="w-full btn-secondary text-center block">
                        Track Package
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
