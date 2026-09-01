<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', Order::count())
                ->description(Order::where('status', 'pending')->count() . ' pending')
                ->color('primary')
                ->icon('heroicon-m-shopping-bag'),
            
            Stat::make('Revenue', 'NPR ' . number_format(Order::where('status', 'delivered')->sum('total') ?? 0, 0))
                ->color('success')
                ->icon('heroicon-m-currency-rupee'),
            
            Stat::make('Products', Product::count())
                ->color('warning')
                ->icon('heroicon-m-squares-2x2'),
            
            Stat::make('Users', User::count())
                ->color('info')
                ->icon('heroicon-m-users'),
        ];
    }
}
