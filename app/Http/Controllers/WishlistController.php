<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    /**
     * Show user's wishlist products.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // load products the user has wishlisted
        $products = $user->wishlist()->get(); // returns Product models

        return view('wishlist.index', compact('products'));
    }

    /**
     * Toggle a product in the wishlist.
     * If product exists in wishlist -> remove; otherwise attach.
     */
    public function toggle(Request $request, Product $product)
    {
        $user = $request->user();

        if ($user->wishlist()->where('product_id', $product->id)->exists()) {
            $user->wishlist()->detach($product->id);
            return back()->with('success', 'Removed from wishlist.');
        }

        $user->wishlist()->attach($product->id);
        return back()->with('success', 'Added to wishlist!');
    }
}
