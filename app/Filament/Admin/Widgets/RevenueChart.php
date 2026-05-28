<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Revenue Chart';

    protected int|string|array $columnSpan = 'half';

    protected function getData(): array
    {
        $monthlyData = collect(range(1, 12))->map(function ($month) {
            return Invoice::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->where('status', 'paid')
                ->sum('amount');
        });

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $monthlyData,
                ],
            ],
            'labels' => [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
