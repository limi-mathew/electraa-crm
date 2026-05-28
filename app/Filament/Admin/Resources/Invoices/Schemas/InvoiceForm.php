<?php

namespace App\Filament\Admin\Resources\Invoices\Schemas;

use App\Models\Customer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->label('Customer')
                    ->required()
                    ->options(Customer::pluck('name', 'id')),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'paid' => 'Paid'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
