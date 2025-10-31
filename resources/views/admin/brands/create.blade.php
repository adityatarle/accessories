@extends('layouts.admin')

@section('title', $brand->exists ? 'Edit Brand' : 'Add Brand')
@section('page-title', $brand->exists ? 'Edit Brand' : 'Add Brand')

@section('content')
<div class="max-w-2xl mx-auto">
    <form action="{{ $brand->exists ? route('admin.brands.update', $brand) : route('admin.brands.store') }}" method="POST" class="space-y-6">
        @csrf
        @if($brand->exists)
            @method('PUT')
        @endif
        
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Brand Information</h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand Name *</label>
                    <input type="text" name="name" value="{{ old('name', $brand->name) }}" required 
                           class="input-field @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4" 
                              class="input-field @error('description') border-red-500 @enderror">{{ old('description', $brand->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                    <input type="url" name="website" value="{{ old('website', $brand->website) }}" 
                           placeholder="https://example.com"
                           class="input-field @error('website') border-red-500 @enderror">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $brand->sort_order ?? 0) }}" 
                               class="input-field @error('sort_order') border-red-500 @enderror">
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $brand->is_active ?? true) ? 'checked' : '' }} 
                               class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm text-gray-700">Active</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.brands.index') }}" class="btn-secondary">
                Cancel
            </a>
            <button type="submit" class="btn-primary">
                {{ $brand->exists ? 'Update Brand' : 'Create Brand' }}
            </button>
        </div>
    </form>
</div>
@endsection
