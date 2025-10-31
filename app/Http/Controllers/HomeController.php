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

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->limit(6)
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
