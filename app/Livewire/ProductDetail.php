<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Product as ProductModel;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductDetail extends Component
{
    public ProductModel $product;
    public int $quantity = 1;
    public array $galleryImages = [];
    public int $selectedIndex = 0;

    public function mount(ProductModel $product)
    {
        $this->product = $product->load('category');

        $this->galleryImages = $this->product->images ?? [];

        if ($this->product->image && !in_array($this->product->image, $this->galleryImages)) {
            array_unshift($this->galleryImages, $this->product->image);
        }
    }

    public function selectImage(int $index)
    {
        $this->selectedIndex = $index;
    }

    #[Computed]
    public function selectedImage()
    {
        if (empty($this->galleryImages)) {
            return 'https://img.magnific.com/premium-psd/3d-paper-bag-recycle-save-planet-energy-concept-icon-isolated-white-background-3d-rendering-illustration-clipping-path_696265-1745.jpg?w=1500';
        }

        return asset('storage/' . $this->galleryImages[$this->selectedIndex]);
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    

    public function buyNow()
    {
        if (!auth()->check()) {
            session()->flash('error', 'Please login to purchase.');
            return redirect()->route('login');
        }

        if ($this->quantity > $this->product->stock) {
            session()->flash('error', 'Not enough stock available.');
            return;
        }

        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + $this->quantity]);
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
            ]);
        }

        $this->dispatch('cart-updated');
        
        return redirect()->route('checkout');
    }

    #[Computed]
    public function relatedProducts()
    {
        return ProductModel::where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.product-details');
    }
}
