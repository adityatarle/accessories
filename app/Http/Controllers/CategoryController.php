<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     */
    public function index()
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Display products in a specific category.
     */
    public function show(Category $category)
    {
        $products = Product::where('category_id', $category->id)
            ->with(['category', 'brand'])
            ->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }
}