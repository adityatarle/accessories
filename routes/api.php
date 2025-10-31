<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API routes for AJAX requests
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Cart API routes
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'store']);
    Route::put('/cart/{cart}/update', [CartController::class, 'update']);
    Route::delete('/cart/{cart}/remove', [CartController::class, 'destroy']);
    Route::get('/cart/count', [CartController::class, 'count']);
    
    // Wishlist API routes
    Route::post('/wishlist/add', [WishlistController::class, 'store']);
    Route::delete('/wishlist/{wishlist}/remove', [WishlistController::class, 'destroy']);
    
    // Review API routes
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
});
