<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrderStatusChart extends ChartWidget
{
    protected ?string $heading = 'Order Status';
    
    protected int | string | array $columnSpan = '1/2';

    protected function getData(): array
    {
        $statusCounts = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        $labels = [];
        $data = [];
        $colors = [];

        foreach ($statusCounts as $status => $count) {
            if ($count > 0) {
                $labels[] = ucfirst($status);
                $data[] = $count;
                $colors[] = match ($status) {
                    'pending' => '#f59e0b',
                    'processing' => '#3b82f6',
                    'shipped' => '#8b5cf6',
                    'delivered' => '#22c55e',
                    'cancelled' => '#ef4444',
                    default => '#6b7280',
                };
            }
        }

        if (empty($data)) {
            return [
                'datasets' => [
                    [
                        'data' => [1],
                        'backgroundColor' => ['#d1d5db'],
                    ],
                ],
                'labels' => ['No Orders'],
            ];
        }

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => $colors,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
