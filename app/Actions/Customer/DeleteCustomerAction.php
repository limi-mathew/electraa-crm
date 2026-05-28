<?php

namespace App\Actions\Customer;

use App\Services\CustomerService;

class DeleteCustomerAction
{
    public function __construct(protected CustomerService $service) {}

    public function execute($id)
    {
        return $this->service->deleteCustomer($id);
    }
}
