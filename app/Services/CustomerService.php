<?php

namespace App\Services;

use App\Repositories\Contracts\CustomerRepositoryInterface;

class CustomerService
{
    public function __construct(protected CustomerRepositoryInterface $repo) {}

    public function getAllCustomers()
    {
        return $this->repo->getAllCustomers();
    }

    public function createCustomer(array $data)
    {
        return $this->repo->createCustomer($data);
    }

    public function getCustomerById($id)
    {
        return $this->repo->getCustomerById($id);
    }

    public function updateCustomer($id, array $data)
    {
        return $this->repo->updateCustomer($id, $data);
    }

    public function deleteCustomer($id)
    {
        return $this->repo->deleteCustomer($id);
    }
}
