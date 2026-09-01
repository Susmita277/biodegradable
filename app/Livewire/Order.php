<?php

namespace App\Livewire;

use App\Models\Order as OrderModel;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Order extends Component
{
    public OrderModel $order;

    public function mount(OrderModel $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $this->order = $order->load(['items.product', 'district']);
    }

    #[Computed]
    public function statusBadgeColor()
    {
        return match($this->order->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'shipped' => 'bg-indigo-100 text-indigo-800',
            'delivered' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    #[Computed]
    public function statusSteps()
    {
        $allSteps = ['pending', 'processing', 'shipped', 'delivered'];
        $currentIndex = array_search($this->order->status, $allSteps);
        
        if ($this->order->status === 'cancelled') {
            return collect($allSteps)->map(function($step, $index) {
                return [
                    'key' => $step,
                    'label' => ucfirst($step),
                    'completed' => false,
                    'active' => false,
                    'cancelled' => $index === 0,
                ];
            });
        }
        
        return collect($allSteps)->map(function($step, $index) use ($currentIndex) {
            return [
                'key' => $step,
                'label' => ucfirst($step),
                'completed' => $index <= $currentIndex,
                'active' => $index === $currentIndex,
                'cancelled' => false,
            ];
        });
    }

    public function cancelOrder()
    {
        if ($this->order->status !== 'pending') {
            session()->flash('error', 'This order cannot be cancelled.');
            return;
        }
        
        $this->order->update(['status' => 'cancelled']);
        
        // Restore stock
        foreach ($this->order->items as $item) {
            $item->product->increment('stock', $item->quantity);
        }
        
        session()->flash('success', 'Order cancelled successfully.');
        return redirect()->route('orders.show', $this->order);
    }

    public function render()
    {
        return view('livewire.order');
    }
}