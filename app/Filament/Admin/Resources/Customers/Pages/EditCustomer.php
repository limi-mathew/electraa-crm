<?php

namespace App\Filament\Admin\Resources\Customers\Pages;

use App\Actions\Customer\EditCustomerAction;
use App\Filament\Admin\Resources\Customers\CustomerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(EditCustomerAction::class)->execute($record, $data);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
