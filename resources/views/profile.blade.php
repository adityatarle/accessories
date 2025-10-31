@extends('layouts.app')

@section('title', 'My Profile')
@section('description', 'Manage your account settings and preferences.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Success Messages -->
    @if (session('status'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            @switch(session('status'))
                @case('profile-updated')
                    Profile information updated successfully!
                    @break
                @case('address-updated')
                    Address information updated successfully!
                    @break
                @case('password-updated')
                    Password updated successfully!
                    @break
                @default
                    {{ session('status') }}
            @endswitch
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">My Profile</h1>
        <p class="text-gray-600">Manage your account settings and preferences</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Personal Information</h2>
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" 
                                   class="input-field @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" 
                                   class="input-field bg-gray-100" readonly>
                            <p class="text-sm text-gray-500 mt-1">Email cannot be changed. Contact support if needed.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}" 
                                   class="input-field @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth', auth()->user()->date_of_birth?->format('Y-m-d')) }}" 
                                   class="input-field @error('date_of_birth') border-red-500 @enderror">
                            @error('date_of_birth')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <select name="gender" class="input-field @error('gender') border-red-500 @enderror">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', auth()->user()->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', auth()->user()->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', auth()->user()->gender) === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn-primary">
                        Update Profile
                    </button>
                </form>
            </div>

            <!-- Address Information -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Address Information</h2>
                <form action="{{ route('profile.address.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <textarea name="address" rows="3" 
                                      class="input-field">{{ auth()->user()->address }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                            <input type="text" name="city" value="{{ auth()->user()->city }}" 
                                   class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                            <input type="text" name="state" value="{{ auth()->user()->state }}" 
                                   class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                            <input type="text" name="postal_code" value="{{ auth()->user()->postal_code }}" 
                                   class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <select name="country" class="input-field">
                                <option value="India" {{ auth()->user()->country === 'India' ? 'selected' : '' }}>India</option>
                                <option value="USA" {{ auth()->user()->country === 'USA' ? 'selected' : '' }}>USA</option>
                                <option value="UK" {{ auth()->user()->country === 'UK' ? 'selected' : '' }}>UK</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary">
                        Update Address
                    </button>
                </form>
            </div>

            <!-- Change Password -->
            <div class="card p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Change Password</h2>
                <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                        <input type="password" name="current_password" required 
                               class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <input type="password" name="password" required 
                               class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required 
                               class="input-field">
                    </div>
                    <button type="submit" class="btn-primary">
                        Update Password
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Account Summary -->
            <div class="card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Summary</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Member since</span>
                        <span class="font-medium">{{ auth()->user()->created_at->format('M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Orders</span>
                        <span class="font-medium">{{ auth()->user()->orders()->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Wishlist Items</span>
                        <span class="font-medium">{{ auth()->user()->wishlists()->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('orders.index') }}" 
                       class="block w-full btn-secondary text-center">
                        View Orders
                    </a>
                    <a href="{{ route('wishlist.index') }}" 
                       class="block w-full btn-secondary text-center">
                        My Wishlist
                    </a>
                    <a href="{{ route('shop') }}" 
                       class="block w-full btn-primary text-center">
                        Continue Shopping
                    </a>
                </div>
            </div>

            <!-- Account Status -->
            <div class="card p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Status</h3>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                    <span class="text-sm text-gray-600">Account Active</span>
                </div>
                <p class="text-xs text-gray-500 mt-2">
                    Your account is in good standing
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
