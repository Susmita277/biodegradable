<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;

class CartService
{
    public static function add(Product $product, int $quantity = 1): void
    {
        $item = CartItem::firstOrNew([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        $newQuantity = $item->exists ? $item->quantity + $quantity : $quantity;
        $item->quantity = min($newQuantity, $product->stock);
        $item->save();
    }
}