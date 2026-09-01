<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrendingProducts extends Component
{
    public $products;

    public function __construct()
    {
       
        $this->products = Product::with(['category'])
            ->where('is_active', true)
            ->latest()
            ->take(4)
            ->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.trending-products');
    }
}
