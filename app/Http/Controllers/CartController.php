<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $cartItems->sum('total');
        $tax = $subtotal * 0.18; // 18% GST
        $shipping = $subtotal > 1000 ? 0 : 50; // Free shipping above ₹1000
        $total = $subtotal + $tax + $shipping;

        return view('cart', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->isInStock()) {
            return response()->json(['error' => 'Product is out of stock'], 400);
        }

        if ($request->quantity > $product->stock) {
            return response()->json(['error' => 'Requested quantity exceeds available stock'], 400);
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->current_price,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully',
            'cart_count' => Cart::where('user_id', Auth::id())->sum('quantity')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        if ($cart->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($request->quantity > $cart->product->stock) {
            return response()->json(['error' => 'Requested quantity exceeds available stock'], 400);
        }

        $cart->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
            'item_total' => $cart->total,
            'cart_count' => Cart::where('user_id', Auth::id())->sum('quantity')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $cart->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully',
            'cart_count' => Cart::where('user_id', Auth::id())->sum('quantity')
        ]);
    }

    /**
     * Get cart count for AJAX requests
     */
    public function count()
    {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['count' => $count]);
    }
}
