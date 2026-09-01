<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'district_id', 'full_name', 'phone', 'address', 'notes',
        'subtotal', 'delivery_charge', 'total', 'payment_method', 'status',
        'payment_status', 'payment_reference', 
    ];

   
    protected static function booted(): void
    {
        static::created(function ($order) {
            foreach ($order->items as $item) {
                if ($item->product) {
                    // Decrease stock when order is created
                    $item->product->decrement('stock', $item->quantity);
                }
            }
        });

        static::updated(function ($order) {
            // Check if status changed to cancelled
            if ($order->isDirty('status') && $order->status === 'cancelled') {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        // Increase stock back when order is cancelled
                        $item->product->increment('stock', $item->quantity);
                    }
                }
            }
        });
    }

    protected $casts = [
        'subtotal' => 'decimal:2',
        'delivery_charge' => 'decimal:2',
        'total' => 'decimal:2',
        'payment_status' => 'string', // ✅ Add this
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
