@extends('layouts.admin')

@section('title', $product->exists ? 'Edit Product' : 'Add Product')
@section('page-title', $product->exists ? 'Edit Product' : 'Add Product')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($product->exists)
            @method('PUT')
        @endif
        
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Product Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required 
                           class="input-field @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SKU *</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required 
                           class="input-field @error('sku') border-red-500 @enderror">
                    @error('sku')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                    <select name="category_id" required class="input-field @error('category_id') border-red-500 @enderror">
                        <option value="">Select Category</option>
                        @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand *</label>
                    <select name="brand_id" required class="input-field @error('brand_id') border-red-500 @enderror">
                        <option value="">Select Brand</option>
                        @foreach(\App\Models\Brand::all() as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required 
                           class="input-field @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sale Price</label>
                    <input type="number" name="sale_price" step="0.01" value="{{ old('sale_price', $product->sale_price) }}" 
                           class="input-field @error('sale_price') border-red-500 @enderror">
                    @error('sale_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required 
                           class="input-field @error('stock') border-red-500 @enderror">
                    @error('stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Weight (kg)</label>
                    <input type="number" name="weight" step="0.01" value="{{ old('weight', $product->weight) }}" 
                           class="input-field @error('weight') border-red-500 @enderror">
                    @error('weight')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                <textarea name="short_description" rows="3" 
                          class="input-field @error('short_description') border-red-500 @enderror">{{ old('short_description', $product->short_description) }}</textarea>
                @error('short_description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="5" 
                          class="input-field @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dimensions</label>
                    <input type="text" name="dimensions" value="{{ old('dimensions', $product->dimensions) }}" 
                           placeholder="e.g., 10x5x3 cm"
                           class="input-field @error('dimensions') border-red-500 @enderror">
                    @error('dimensions')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}" 
                           class="input-field @error('sort_order') border-red-500 @enderror">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Product Images Section -->
        <div class="bg-white shadow rounded-lg p-6" x-data="imageUploader()" x-init="init()">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Product Images</h3>
            
            <!-- Image Upload Area -->
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-pink-400 transition-colors"
                 @dragover.prevent="isDragging = true"
                 @dragleave.prevent="isDragging = false"
                 @drop.prevent="handleDrop($event)"
                 :class="{ 'border-pink-400 bg-pink-50': isDragging }">
                <input type="file" 
                       id="image-upload" 
                       name="images[]" 
                       multiple 
                       accept="image/*" 
                       @change="handleFileSelect($event)"
                       class="hidden">
                
                <div class="space-y-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    
                    <div>
                        <label for="image-upload" class="cursor-pointer">
                            <span class="mt-2 block text-sm font-medium text-gray-900">
                                Upload product images
                            </span>
                            <span class="mt-1 block text-sm text-gray-500">
                                Drag and drop images here, or click to select
                            </span>
                        </label>
                    </div>
                    
                    <p class="text-xs text-gray-500">
                        PNG, JPG, GIF up to 10MB each. You can upload multiple images.
                    </p>
                </div>
            </div>

            <!-- Image Preview Grid -->
            <div x-show="images.length > 0" class="mt-6">
                <h4 class="text-sm font-medium text-gray-900 mb-3">Uploaded Images</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <template x-for="(image, index) in images" :key="index">
                        <div class="relative group">
                            <img :src="image.preview" :alt="image.name" 
                                 class="w-full h-32 object-cover rounded-lg border border-gray-200">
                            
                            <!-- Image Actions -->
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center space-x-2">
                                <button type="button" 
                                        @click="removeImage(index)"
                                        class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                                
                                <button type="button" 
                                        @click="setPrimary(index)"
                                        class="p-2 bg-pink-600 text-white rounded-full hover:bg-pink-700 transition-colors"
                                        :class="{ 'bg-pink-800': image.isPrimary }">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Primary Badge -->
                            <div x-show="image.isPrimary" 
                                 class="absolute top-2 left-2 bg-pink-600 text-white text-xs px-2 py-1 rounded-full">
                                Primary
                            </div>
                            
                            <!-- Sort Order Input -->
                            <div class="mt-2">
                                <input type="number" 
                                       :name="`image_sort_order[${index}]`" 
                                       :value="image.sortOrder"
                                       @input="updateSortOrder(index, $event.target.value)"
                                       class="w-full text-xs text-center border border-gray-300 rounded px-2 py-1"
                                       placeholder="Order">
                                <!-- Hidden input to track which files are being uploaded -->
                                <input type="hidden" :name="`image_names[${index}]`" :value="image.name">
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Existing Images (for edit mode) -->
            @php
                // Explicitly fetch relation to avoid conflict with 'images' attribute on products table
                $existingImages = $product->exists ? $product->images()->get() : collect();
            @endphp
            @if($product->exists && $existingImages->count() > 0)
            <div class="mt-6">
                <h4 class="text-sm font-medium text-gray-900 mb-3">Current Images</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($existingImages as $image)
                    <div class="relative group">
                        <img src="{{ $image->image_url }}" alt="{{ $image->alt_text }}" 
                             class="w-full h-32 object-cover rounded-lg border border-gray-200">
                        
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center space-x-2">
                            <button type="button" 
                                    onclick="deleteImage({{ $image->id }})"
                                    class="p-2 bg-red-600 text-white rounded-full hover:bg-red-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                            
                            <button type="button" 
                                    onclick="setPrimaryImage({{ $image->id }})"
                                    class="p-2 bg-pink-600 text-white rounded-full hover:bg-pink-700 transition-colors
                                           {{ $image->is_primary ? 'bg-pink-800' : '' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        @if($image->is_primary)
                        <div class="absolute top-2 left-2 bg-pink-600 text-white text-xs px-2 py-1 rounded-full">
                            Primary
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Product Settings</h3>
            
            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} 
                           class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                    <label class="ml-2 text-sm text-gray-700">Featured Product</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} 
                           class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                    <label class="ml-2 text-sm text-gray-700">Active</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.products.index') }}" class="btn-secondary">
                Cancel
            </a>
            <button type="submit" class="btn-primary">
                {{ $product->exists ? 'Update Product' : 'Create Product' }}
            </button>
        </div>
    </form>
</div>

<!-- Alpine.js Image Uploader Script -->
<script>
function imageUploader() {
    return {
        images: [],
        isDragging: false,
        fileInput: null,
        
        init() {
            this.fileInput = document.getElementById('image-upload');
            // Intercept form submission to ensure files are included
            const form = this.fileInput ? this.fileInput.closest('form') : null;
            if (form) {
                form.addEventListener('submit', (e) => {
                    // Before form submits, sync files to the input
                    this.syncHiddenInput();
                });
            }
        },
        
        handleFileSelect(event) {
            const files = Array.from(event.target.files);
            this.processFiles(files);
        },
        
        handleDrop(event) {
            event.preventDefault();
            this.isDragging = false;
            const files = Array.from(event.dataTransfer.files);
            this.processFiles(files);
            // Sync files to input after drop
            this.syncHiddenInput();
        },
        
        processFiles(files) {
            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    // Check if file already exists to avoid duplicates
                    const exists = this.images.some(img => img.name === file.name && img.file.size === file.size);
                    if (exists) return;
                    
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.images.push({
                            file: file,
                            name: file.name,
                            preview: e.target.result,
                            isPrimary: this.images.length === 0, // First image is primary by default
                            sortOrder: this.images.length + 1
                        });
                        // Sync after each file is processed
                        this.syncHiddenInput();
                    };
                    reader.readAsDataURL(file);
                }
            });
        },
        
        removeImage(index) {
            this.images.splice(index, 1);
            // If we removed the primary image, make the first remaining image primary
            if (this.images.length > 0 && !this.images.some(img => img.isPrimary)) {
                this.images[0].isPrimary = true;
            }
            this.syncHiddenInput();
        },
        
        setPrimary(index) {
            // Remove primary from all images
            this.images.forEach(img => img.isPrimary = false);
            // Set the selected image as primary
            this.images[index].isPrimary = true;
        },
        
        updateSortOrder(index, value) {
            this.images[index].sortOrder = parseInt(value) || 0;
        },

        syncHiddenInput() {
            if (!this.fileInput) {
                this.fileInput = document.getElementById('image-upload');
            }
            if (!this.fileInput) {
                console.error('File input not found');
                return;
            }

            // Only sync if we have images to sync
            if (this.images.length === 0) {
                return;
            }

            try {
                // Create a DataTransfer object to build a new FileList
                const dt = new DataTransfer();
                this.images.forEach(img => {
                    if (img.file instanceof File) {
                        dt.items.add(img.file);
                    }
                });
                
                // Assign the new FileList to the file input so it submits with the form
                this.fileInput.files = dt.files;
                
                // Verify the sync worked
                console.log('Synced files:', this.fileInput.files.length, 'files to input');
            } catch (error) {
                console.error('Error syncing files:', error);
            }
        }
    }
}

// Functions for existing images (edit mode)
function deleteImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        fetch(`/admin/products/images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting image');
        });
    }
}

function setPrimaryImage(imageId) {
    fetch(`/admin/products/images/${imageId}/set-primary`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error setting primary image');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error setting primary image');
    });
}
</script>
@endsection
