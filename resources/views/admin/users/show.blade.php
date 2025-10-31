@extends('layouts.admin')

@section('title', 'User Details - ' . $user->name)
@section('page-title', 'User Details')

@section('content')
<div class="space-y-6">
    <!-- Success Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <div class="h-16 w-16 rounded-full bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center">
                <span class="text-2xl font-medium text-gray-700">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </span>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                <p class="text-gray-600">User ID: {{ $user->id }}</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.users.index') }}" 
               class="btn-secondary">
                ← Back to Users
            </a>
        </div>
    </div>

    <!-- Status Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Role</h3>
                    <p class="text-lg font-semibold text-gray-900">
                        <span class="px-2 py-1 rounded-full text-sm {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $user->is_admin ? 'Admin' : 'Customer' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Orders</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $user->orders()->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Wishlist</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $user->wishlists()->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Member Since</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Personal Information</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Full Name</h3>
                            <p class="text-sm text-gray-900">{{ $user->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Email</h3>
                            <p class="text-sm text-gray-900">{{ $user->email }}</p>
                        </div>
                        @if($user->phone)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Phone</h3>
                            <p class="text-sm text-gray-900">{{ $user->phone }}</p>
                        </div>
                        @endif
                        @if($user->date_of_birth)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Date of Birth</h3>
                            <p class="text-sm text-gray-900">{{ $user->date_of_birth->format('M d, Y') }}</p>
                        </div>
                        @endif
                        @if($user->gender)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Gender</h3>
                            <p class="text-sm text-gray-900">{{ ucfirst($user->gender) }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            @if($user->address || $user->city || $user->state)
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Address Information</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @if($user->address)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Address</h3>
                            <p class="text-sm text-gray-900">{{ $user->address }}</p>
                        </div>
                        @endif
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @if($user->city)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">City</h3>
                                <p class="text-sm text-gray-900">{{ $user->city }}</p>
                            </div>
                            @endif
                            @if($user->state)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">State</h3>
                                <p class="text-sm text-gray-900">{{ $user->state }}</p>
                            </div>
                            @endif
                            @if($user->postal_code)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Postal Code</h3>
                                <p class="text-sm text-gray-900">{{ $user->postal_code }}</p>
                            </div>
                            @endif
                        </div>
                        @if($user->country)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Country</h3>
                            <p class="text-sm text-gray-900">{{ $user->country }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Recent Orders -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Recent Orders</h2>
                </div>
                <div class="p-6">
                    @if($user->orders()->count() > 0)
                    <div class="space-y-4">
                        @foreach($user->orders()->latest()->take(5)->get() as $order)
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Order #{{ $order->order_number }}</h3>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ $order->formatted_total }}</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_badge_class }}">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-4">No orders found</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- User Management -->
        <div class="space-y-6">
            <!-- Role Management -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Role Management</h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Role</label>
                            <p class="text-sm text-gray-900 mb-4">
                                <span class="px-2 py-1 rounded-full text-sm {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $user->is_admin ? 'Admin' : 'Customer' }}
                                </span>
                            </p>
                        </div>

                        @if($user->id !== auth()->id())
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Change Role</label>
                            <select name="is_admin" class="input-field">
                                <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>Customer</option>
                                <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full btn-primary">
                            Update Role
                        </button>
                        @else
                        <p class="text-sm text-gray-500">You cannot change your own role</p>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Account Actions -->
            @if($user->id !== auth()->id())
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Account Actions</h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                            Delete User
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- Account Statistics -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Account Statistics</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Total Orders</span>
                            <span class="text-sm font-medium">{{ $user->orders()->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Wishlist Items</span>
                            <span class="text-sm font-medium">{{ $user->wishlists()->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Reviews Written</span>
                            <span class="text-sm font-medium">{{ $user->reviews()->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Account Created</span>
                            <span class="text-sm font-medium">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Last Login</span>
                            <span class="text-sm font-medium">{{ $user->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
