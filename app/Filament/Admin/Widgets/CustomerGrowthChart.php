<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Customer;
use Filament\Widgets\ChartWidget;

class CustomerGrowthChart extends ChartWidget
{
    protected ?string $heading = 'Customer Growth Chart';

    protected int|string|array $columnSpan = 'half';

    protected function getData(): array
    {
        $monthlyCustomers = collect(range(1, 12))->map(function ($month) {
            return Customer::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'Customers',
                    'data' => $monthlyCustomers,
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
        return 'bar';
    }
}
