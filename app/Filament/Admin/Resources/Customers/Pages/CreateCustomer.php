<?php

namespace App\Filament\Admin\Resources\Customers\Pages;

use App\Actions\Customer\CreateCustomerAction;
use App\Filament\Admin\Resources\Customers\CustomerResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        $data['created_by'] = auth()->id();

        return app(CreateCustomerAction::class)->execute($data);
    }
}
