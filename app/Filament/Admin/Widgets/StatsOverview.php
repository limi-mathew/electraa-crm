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
        $customer = auth()->user()->customer;
        $user = auth()->user();

        $stats = [];

        // Admin only
        if ($user->hasRole('Admin')) {

            $stats[] = Stat::make('Total Customers', Customer::count())
                ->description('All registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('success');

            $paidAmount = Invoice::where('status', 'paid')->sum('amount');

            $pendingAmount = Invoice::where('status', 'pending')->sum('amount');

        } else {

            // Customer only sees own invoices
            $paidAmount = Invoice::where('customer_id', $customer->id)
                ->where('status', 'paid')
                ->sum('amount');

            $pendingAmount = Invoice::where('customer_id', $customer->id)
                ->where('status', 'pending')
                ->sum('amount');
        }

        $stats[] = Stat::make('Total Payments', $paidAmount)
            ->description('Completed payments')
            ->descriptionIcon('heroicon-m-banknotes')
            ->color('success');

        $stats[] = Stat::make('Pending Payments', $pendingAmount)
            ->description('Pending invoice amount')
            ->descriptionIcon('heroicon-m-clock')
            ->color('danger');

        return $stats;
    }
}
