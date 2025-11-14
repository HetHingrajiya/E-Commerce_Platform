<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product; // optional - uses Product if present

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Load active banners ordered by sort_order asc
        $banners = Banner::query()
            ->where('active', true)
            ->orderBy('sort_order', 'asc')
            ->get(['id', 'title', 'subtitle', 'image', 'alt', 'cta_text', 'cta_url']);

        // Featured products if the Product model/table exists; otherwise an empty collection
        $products = collect();
        if (class_exists(Product::class)) {
            try {
                // take 8 products — adjust as needed
                $products = Product::orderBy('sales_count', 'desc')->take(8)->get();
            } catch (\Throwable $e) {
                // DB table might not exist yet — keep empty collection
                $products = collect();
            }
        }

        // Ensure banner image paths are absolute URLs (optional convenience)
        $banners = $banners->map(function ($b) {
            $b->image = $this->normalizeImageUrl($b->image);
            return $b;
        });

        // --- NEW: preload wishlist IDs to avoid N+1 queries in the view ---
        $wishlistIds = [];
        try {
            if ($request->user()) {
                // pluck product_ids from the pivot table quickly
                $wishlistIds = $request->user()->wishlist()->pluck('product_id')->toArray();
            }
        } catch (\Throwable $e) {
            // if wishlist pivot table or relation doesn't exist yet, ignore
            $wishlistIds = [];
        }

        return view('home', compact('banners', 'products', 'wishlistIds'));
    }

    // normalizes local paths to absolute URLs (if image is relative)
    protected function normalizeImageUrl($path)
    {
        if (!$path) {
            return null;
        }
        // already absolute
        if (preg_match('/^https?:\/\//i', $path)) {
            return $path;
        }
        // leading slash -> url(root)/path
        if (substr($path, 0, 1) === '/') {
            return url($path);
        }
        // treat as relative to public
        return asset($path);
    }
}
