<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopProducts extends BaseWidget
{
    protected int | string | array $columnSpan = '1/2';
    
    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return OrderItem::query()
            ->selectRaw('product_id, product_name, sum(quantity) as total_sold')
            ->groupBy('product_id', 'product_name')
            ->orderByDesc('total_sold')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('product_name')
                ->label('Product'),
            
            Tables\Columns\TextColumn::make('total_sold')
                ->label('Units Sold')
                ->numeric()
                ->sortable(),
        ];
    }
}
