@extends('layouts.app')

@section('title', 'My Orders')
@section('description', 'View your order history and track your purchases.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">My Orders</h1>
        <p class="text-gray-600">Track your orders and view order history</p>
    </div>

    @if($orders->count() > 0)
    <div class="space-y-6">
        @foreach($orders as $order)
        <div class="card p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->order_number }}</h3>
                    <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}</p>
                </div>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $order->status_badge_class }}">
                        {{ ucfirst($order->order_status) }}
                    </span>
                    <span class="text-lg font-bold text-gray-900">{{ $order->formatted_total }}</span>
                </div>
            </div>
            
            <!-- Order Items -->
            <div class="space-y-3 mb-4">
                @foreach($order->orderItems as $item)
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden">
                        <div class="w-full h-full bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center">
                            <div class="text-2xl">✨</div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h4>
                        <p class="text-sm text-gray-500">SKU: {{ $item->product_sku }} | Qty: {{ $item->quantity }}</p>
                    </div>
                    <div class="text-sm font-medium text-gray-900">
                        ₹{{ number_format($item->total, 2) }}
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Order Actions -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('orders.show', $order) }}" 
                   class="btn-secondary text-center">
                    View Details
                </a>
                @if($order->order_status === 'delivered')
                <button class="btn-primary">
                    Leave Review
                </button>
                @endif
                @if($order->order_status === 'pending')
                <button class="bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200 transition-colors">
                    Cancel Order
                </button>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="text-6xl mb-4">📦</div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4">No orders yet</h2>
        <p class="text-gray-600 mb-8">You haven't placed any orders yet. Start shopping to see your orders here.</p>
        <a href="{{ route('shop') }}" 
           class="btn-primary">
            Start Shopping
        </a>
    </div>
    @endif
</div>
@endsection
