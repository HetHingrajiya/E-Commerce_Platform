<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /products
    public function index(Request $request)
    {
        $q = $request->query('q');

        $query = Product::query()->orderBy('created_at', 'desc');

        if ($request->filled('featured')) {
            $query->where('featured', true);
        }

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'LIKE', "%{$q}%")
                    ->orWhere('short_description', 'LIKE', "%{$q}%")
                    ->orWhere('description', 'LIKE', "%{$q}%");
            });
        }

        $products = $query->paginate(12)->withQueryString();

        // If you want the same home view to pull latest/popular, you can pass $products to the home route too.
        return view('products.index', compact('products'));
    }

    // GET /products/{product}  (route-model binding)
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
