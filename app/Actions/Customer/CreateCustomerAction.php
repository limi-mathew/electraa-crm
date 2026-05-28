<?php

namespace App\Actions\Customer;

use App\Events\CustomerCreated;
use App\Services\CustomerService;

class CreateCustomerAction
{
    public function __construct(protected CustomerService $service) {}

    public function execute(array $data)
    {
        $customer = $this->service->createCustomer($data);
        event(new CustomerCreated($customer));

        return $customer;

    }
}
