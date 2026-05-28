<?php

namespace App\Actions\Customer;

use App\Services\CustomerService;

class EditCustomerAction
{
    public function __construct(protected CustomerService $service) {}

    public function execute($id, array $data)
    {
        return $this->service->updateCustomer($id, $data);
    }
}
