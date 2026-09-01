<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product as ProductModel;
use App\Traits\HasPageBlocks;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use HasPageBlocks;
    use WithPagination;

    public array $selectedCategories = [];
    public $minPrice = null;
    public $maxPrice = 5000;
    public string $sortBy = 'latest';

    protected $paginationTheme = 'tailwind';

    public function addToCart(int $productId)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $product = \App\Models\Product::findOrFail($productId);

    if ($product->stock < 1) {
        session()->flash('cart_message', 'Out of stock.');
        return;
    }

    \App\Services\CartService::add($product);

    $this->dispatch('cart-updated');
    session()->flash('cart_message', 'Added to cart.');
}

    public function updated($property)
    {
        if (str_starts_with($property, 'selectedCategories') || in_array($property, ['minPrice', 'maxPrice', 'sortBy'])) {
            $this->resetPage();
        }
    }

    public function clearFilters()
    {
        $this->reset(['selectedCategories', 'minPrice', 'maxPrice', 'sortBy']);
        $this->resetPage();
    }

    #[Computed]
    public function categories()
    {
        return Category::where('is_active', true)->orderBy('name')->get();
    }

    #[Computed]
    public function products()
    {
        return ProductModel::query()
            ->where('is_active', true)
            ->when(!empty($this->selectedCategories), function ($q) {
                $q->whereIn('category_id', $this->selectedCategories);
            })
            ->when(!is_null($this->minPrice) && $this->minPrice !== '', function ($q) {
                $q->where('price', '>=', $this->minPrice);
            })
            ->when(!is_null($this->maxPrice) && $this->maxPrice !== '', function ($q) {
                $q->where('price', '<=', $this->maxPrice);
            })
            ->when($this->sortBy === 'price_asc', fn ($q) => $q->orderBy('price', 'asc'))
            ->when($this->sortBy === 'price_desc', fn ($q) => $q->orderBy('price', 'desc'))
            ->when(in_array($this->sortBy, ['latest', 'popular']), fn ($q) => $q->latest())
            ->paginate(9);
    }

    public function render()
    {
        // $this->page, $this->seo, $this->blocks — still available, untouched
        return view('livewire.product');
    }
}