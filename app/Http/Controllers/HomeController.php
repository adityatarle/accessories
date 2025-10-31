<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['category', 'brand', 'images'])
            ->where('is_featured', true)
            ->where('is_active', true)
            ->inStock()
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        // Fetch only category names from database (no images, just names)
        $categories = Category::where('is_active', true)
            ->select('id', 'name', 'slug')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(4)
            ->get();

        $brands = Brand::where('is_active', true)
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        $latestProducts = Product::with(['category', 'brand', 'images'])
            ->where('is_active', true)
            ->inStock()
            ->latest()
            ->limit(8)
            ->get();

        return view('home', compact('featuredProducts', 'categories', 'brands', 'latestProducts'));
    }
}
