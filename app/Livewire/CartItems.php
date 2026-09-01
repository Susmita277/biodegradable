<?php

namespace App\Livewire;

use App\Models\CartItem;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Cart extends Component
{
    public function incrementQuantity(int $itemId)
    {
        $item = CartItem::where('user_id', auth()->id())->findOrFail($itemId);

        if ($item->quantity < $item->product->stock) {
            $item->increment('quantity');
        }
    }

    public function decrementQuantity(int $itemId)
    {
        $item = CartItem::where('user_id', auth()->id())->findOrFail($itemId);

        if ($item->quantity > 1) {
            $item->decrement('quantity');
        }
    }

    public function removeItem(int $itemId)
    {
        CartItem::where('user_id', auth()->id())->findOrFail($itemId)->delete();
    }

    #[Computed]
    public function items()
    {
        return CartItem::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    }

    #[Computed]
    public function subtotal()
    {
        return $this->items->sum->subtotal;
    }

    public function render()
    {
        return view('livewire.cart-items');
    }
}