<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'total_revenue' => Order::sum('total_amount'),
            'total_products' => Product::count(),
            'total_users' => User::count(),
            'recent_orders' => Order::with('user')->latest()->limit(5)->get(),
            'low_stock_products' => Product::where('stock', '<', 10)->count(),
            'pending_orders' => Order::where('order_status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Display the products management page.
     */
    public function products()
    {
        $products = Product::with(['category', 'brand', 'images'])->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function createProduct()
    {
        $product = new Product();
        return view('admin.products.create', compact('product'));
    }

    /**
     * Store a newly created product.
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
        ]);

        $product = Product::create($request->all());

        // Handle image uploads
        if ($request->hasFile('images')) {
            $this->handleImageUploads($request->file('images'), $product, $request->input('image_sort_order', []));
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the orders management page.
     */
    public function orders()
    {
        $orders = Order::with(['user', 'orderItems.product'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the users management page.
     */
    public function users(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            if ($request->get('role') === 'admin') {
                $query->where('is_admin', true);
            } elseif ($request->get('role') === 'customer') {
                $query->where('is_admin', false);
            }
        }

        $users = $query->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified user.
     */
    public function showUser(User $user)
    {
        $user->load(['orders', 'wishlists', 'reviews']);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'is_admin' => 'required|boolean',
        ]);

        $user->update($request->only(['is_admin']));

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete the specified user.
     */
    public function destroyUser(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Display the categories management page.
     */
    public function categories()
    {
        $categories = Category::paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Display the brands management page.
     */
    public function brands()
    {
        $brands = Brand::paginate(15);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for editing a product.
     */
    public function editProduct(Product $product)
    {
        $product->load('images');
        return view('admin.products.create', compact('product'));
    }

    /**
     * Update the specified product.
     */
    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
        ]);

        $product->update($request->all());

        // Handle image uploads
        if ($request->hasFile('images')) {
            // Clear existing primary flag so the first newly uploaded image becomes primary
            ProductImage::where('product_id', $product->id)->update(['is_primary' => false]);

            $this->handleImageUploads($request->file('images'), $product, $request->input('image_sort_order', []));
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroyProduct(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Display the specified order.
     */
    public function showOrder(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the specified order.
     */
    public function updateOrder(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'nullable|in:pending,paid,failed,refunded',
            'tracking_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $order->update($request->only(['order_status', 'payment_status', 'tracking_number', 'notes']));

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully.');
    }

    /**
     * Display the reviews management page.
     */
    public function reviews(Request $request)
    {
        $query = \App\Models\Review::with(['user', 'product']);

        // Filter by approval status
        if ($request->filled('status')) {
            if ($request->get('status') === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->get('status') === 'pending') {
                $query->where('is_approved', false);
            } elseif ($request->get('status') === 'verified') {
                $query->where('is_verified_purchase', true);
            }
        }

        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->get('rating'));
        }

        $reviews = $query->latest()->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Update the specified review.
     */
    public function updateReview(Request $request, \App\Models\Review $review)
    {
        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $review->update($request->only(['is_approved']));

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified review.
     */
    public function destroyReview(\App\Models\Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }

    /**
     * Show the form for creating a new category.
     */
    public function createCategory()
    {
        $category = new Category();
        return view('admin.categories.create', compact('category'));
    }

    /**
     * Store a newly created category.
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing a category.
     */
    public function editCategory(Category $category)
    {
        return view('admin.categories.create', compact('category'));
    }

    /**
     * Update the specified category.
     */
    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category.
     */
    public function destroyCategory(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * Show the form for creating a new brand.
     */
    public function createBrand()
    {
        $brand = new Brand();
        return view('admin.brands.create', compact('brand'));
    }

    /**
     * Store a newly created brand.
     */
    public function storeBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        Brand::create($request->all());

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    /**
     * Show the form for editing a brand.
     */
    public function editBrand(Brand $brand)
    {
        return view('admin.brands.create', compact('brand'));
    }

    /**
     * Update the specified brand.
     */
    public function updateBrand(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $brand->update($request->all());

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified brand.
     */
    public function destroyBrand(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }

    /**
     * Handle image uploads for products
     */
    private function handleImageUploads($images, $product, $sortOrders = [])
    {
        foreach ($images as $index => $image) {
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products', $filename, 'public');
            
            $sortOrder = isset($sortOrders[$index]) ? (int)$sortOrders[$index] : $index + 1;
            $isPrimary = $index === 0; // First image is primary by default
            
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'alt_text' => $product->name,
                'sort_order' => $sortOrder,
                'is_primary' => $isPrimary,
            ]);
        }
    }

    /**
     * Delete a product image
     */
    public function deleteImage(ProductImage $image)
    {
        // Delete the file from storage
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        // Delete the database record
        $image->delete();
        
        return response()->json(['success' => true]);
    }

    /**
     * Set an image as primary
     */
    public function setPrimaryImage(ProductImage $image)
    {
        // Remove primary from all other images of this product
        ProductImage::where('product_id', $image->product_id)
                   ->where('id', '!=', $image->id)
                   ->update(['is_primary' => false]);
        
        // Set this image as primary
        $image->update(['is_primary' => true]);
        
        return response()->json(['success' => true]);
    }
}
