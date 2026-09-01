<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Services\EsewaService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Filament\Notifications\Notification;

class Checkout extends Component
{
    #[Validate('required|string|max:255')]
    public string $full_name = '';

    #[Validate('required|string|max:20')]
    public string $phone = '';

    #[Validate('required|string')]
    public string $address = '';

    public string $notes = '';

    #[Validate('required|exists:districts,id')]
    public $district_id = '';

    public string $payment_method = 'cod';

    public function mount()
    {
        if (!auth()->check()) {
            session()->flash('error', 'Please login to proceed with checkout.');
            return redirect()->route('login');
        }

        if ($this->items->isEmpty()) {
            return redirect()->route('cart');
        }

        $this->full_name = auth()->user()->name ?? '';
    }

    #[Computed]
    public function items()
    {
        if (!auth()->check()) {
            return collect();
        }
        return CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();
    }

    #[Computed]
    public function subtotal()
    {
        return $this->items->sum('subtotal');
    }

    #[Computed]
    public function districts()
    {
        return District::where('is_active', true)
            ->orderBy('province')
            ->orderBy('name')
            ->get()
            ->groupBy('province');
    }

    #[Computed]
    public function deliveryCharge()
    {
        if (!$this->district_id) {
            return 0;
        }

        return District::find($this->district_id)?->delivery_charge ?? 0;
    }

    #[Computed]
    public function total()
    {
        return $this->subtotal + $this->deliveryCharge;
    }

    public function placeOrder()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate();

        if ($this->items->isEmpty()) {
            return redirect()->route('cart');
        }

        // Check stock
        foreach ($this->items as $item) {
            if ($item->quantity > $item->product->stock) {
                $this->addError('stock', $item->product->name . ' only has ' . $item->product->stock . ' left in stock.');
                return;
            }
        }

        // ✅ For eSewa - Show success directly (skip eSewa redirect since it's down)
        if ($this->payment_method === 'esewa') {
    $order = DB::transaction(function () {
        $order = Order::create([
            'user_id' => auth()->id(),
            'district_id' => $this->district_id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'notes' => $this->notes,
            'subtotal' => $this->subtotal,
            'delivery_charge' => $this->deliveryCharge,
            'total' => $this->total,
            'payment_method' => $this->payment_method,
            'payment_status' => 'pending',
            'status' => 'pending',
        ]);

        foreach ($this->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'subtotal' => $item->subtotal,
            ]);
            $item->product->decrement('stock', $item->quantity);
        }

        CartItem::where('user_id', auth()->id())->delete();

        return $order;
    });

    $paymentData = app(EsewaService::class)->initiatePayment($order);
    session(['esewa_payment_data' => $paymentData]);

    $this->dispatch('cart-updated');

    return redirect()->route('esewa.redirect');
}
       
       

        // ✅ For COD - Normal flow
        $order = DB::transaction(function () {
            $order = Order::create([
                'user_id' => auth()->id(),
                'district_id' => $this->district_id,
                'full_name' => $this->full_name,
                'phone' => $this->phone,
                'address' => $this->address,
                'notes' => $this->notes,
                'subtotal' => $this->subtotal,
                'delivery_charge' => $this->deliveryCharge,
                'total' => $this->total,
                'payment_method' => $this->payment_method,
                'payment_status' => 'pending',
                'status' => 'pending',
            ]);

            foreach ($this->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->subtotal,
                    'stock_at_order' => $item->product->stock + $item->quantity,
                    'current_stock' => $item->product->stock,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            CartItem::where('user_id', auth()->id())->delete();

            return $order;
        });

        $this->sendNotifications($order);
        $this->dispatch('cart-updated');

        return redirect()->route('orders.show', $order);
    }

    protected function sendNotifications($order)
    {
        $admins = User::where('is_admin', true)->get();
        
        foreach ($admins as $admin) {
            Notification::make()
                ->title('🛒 New Order Received!')
                ->body("Order #{$order->id} | {$order->full_name} | NPR.{$order->total}")
                ->sendToDatabase($admin);
        }

        Notification::make()
            ->title('✅ Order Confirmed!')
            ->body("Your order #{$order->id} has been placed successfully. Thank you!")
            ->sendToDatabase(auth()->user());
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
