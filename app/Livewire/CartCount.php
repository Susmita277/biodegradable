<?php

namespace App\Livewire;

use App\Models\CartItem;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCount extends Component
{
    public int $count = 0;

    public function mount()
    {
        $this->refreshCount();
    }

    #[On('cart-updated')]
    public function refreshCount()
    {
        $this->count = auth()->check()
            ? CartItem::where('user_id', auth()->id())->sum('quantity')
            : 0;
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}