<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'order_id' => 'nullable|exists:orders,id',
        ]);

        // Check if user has purchased this product
        $hasPurchased = false;
        if ($request->order_id) {
            $order = Order::where('id', $request->order_id)
                ->where('user_id', Auth::id())
                ->where('order_status', 'delivered')
                ->first();
            
            if ($order) {
                $hasPurchased = $order->orderItems()
                    ->where('product_id', $request->product_id)
                    ->exists();
            }
        }

        // Check if user already reviewed this product
        $existingReview = Review::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingReview) {
            return response()->json(['error' => 'You have already reviewed this product'], 400);
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_verified_purchase' => $hasPurchased,
            'is_approved' => true, // Auto-approve for now
        ]);

        // Update product rating
        $this->updateProductRating($request->product_id);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully',
            'review' => $review->load('user')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Update product rating
        $this->updateProductRating($review->product_id);

        return response()->json([
            'success' => true,
            'message' => 'Review updated successfully',
            'review' => $review->load('user')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $productId = $review->product_id;
        $review->delete();

        // Update product rating
        $this->updateProductRating($productId);

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully'
        ]);
    }

    /**
     * Update product rating and review count
     */
    private function updateProductRating($productId)
    {
        $product = Product::find($productId);
        $approvedReviews = $product->reviews()->where('is_approved', true);
        
        $product->update([
            'rating' => $approvedReviews->avg('rating') ?? 0,
            'review_count' => $approvedReviews->count(),
        ]);
    }
}
