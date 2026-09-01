<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('primaryImage')
            ->where('is_active', true)
            ->when($request->filled('materials'), fn ($query) => $query->whereIn('material', $request->input('materials')))
            ->when($request->min_price, fn ($query, $minPrice) => $query->where('price', '>=', $minPrice))
            ->when($request->max_price, fn ($query, $maxPrice) => $query->where('price', '<=', $maxPrice))
            ->when($request->sort === 'price_low', fn ($query) => $query->orderBy('price'))
            ->when($request->sort === 'price_high', fn ($query) => $query->orderByDesc('price'))
            ->when(! in_array($request->sort, ['price_low', 'price_high'], true), fn ($query) => $query->latest())
            ->paginate(20)
            ->withQueryString();

        $materials = Product::where('is_active', true)
            ->whereNotNull('material')
            ->distinct()
            ->orderBy('material')
            ->pluck('material');

        return view('products.index', compact('products', 'materials'));
    }

    public function show(Product $product)
    {
        $product->load('images');

        $relatedProducts = Product::where('is_active', true)
            ->where('material', $product->material)
            ->whereKeyNot($product->getKey())
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
