<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
{
    $record = $this->getRecord();
    $originalStatus = $record->getOriginal('status');
    $newStatus = $data['status'] ?? $originalStatus;

    // If the order is being cancelled, return the stock
    if ($originalStatus !== 'cancelled' && $newStatus === 'cancelled') {
        foreach ($record->items as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }
    }
    // If the order is being uncancelled (e.g., moved back to pending), decrement again
    elseif ($originalStatus === 'cancelled' && $newStatus !== 'cancelled') {
        foreach ($record->items as $item) {
            if ($item->product) {
                $item->product->decrement('stock', $item->quantity);
            }
        }
    }

    return $data;
}
}
