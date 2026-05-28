<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Customer;
use App\Models\Invoice;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Customers', Customer::count())
                ->description('All registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Total Payments', Invoice::where('status', 'paid')->sum('amount'))
                ->description('Completed payments')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Pending Payments', Invoice::where('status', 'pending')->sum('amount'))
                ->description('Pending invoice amount')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),
        ];
    }
}
