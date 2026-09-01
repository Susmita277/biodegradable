<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

protected function mutateFormDataBeforeCreate(array $data): array
{
    // Save the order first (without this, $order->items might be empty)
    $order = static::getModel()::create($data);
    
    // Decrement stock for each item in the order
    foreach ($order->items as $item) {
        if ($item->product) {
            $item->product->decrement('stock', $item->quantity);
        }
    }

    return $data;
}
}