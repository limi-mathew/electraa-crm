<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Models\User;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerRepository implements CustomerRepositoryInterface
{
    private const CACHE_KEY = 'customers';

    public function getAllCustomers()
    {

        return Cache::remember(self::CACHE_KEY, 60, function () {
            Log::info('Redis');

            return Customer::with('creator:id,name')->get()->toArray();
        });
    }

    public function getCustomerById($id)
    {

        return Customer::with('creator')->find($id);
    }

    public function createCustomer(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('123456'),
        ]);

        $user->assignRole('Customer');

        $data['user_id'] = $user->id;

        return Customer::create($data);
        $this->clearCache();

    }

    public function updateCustomer($customer, array $data)
    {
        if (! $customer instanceof Customer) {
            $customer = Customer::find($customer);
        }

        if (! $customer) {
            return null;
        }

        $customer->update($data);

        $this->clearCache();

        return $customer;
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            $this->clearCache();

            return true;
        }

        return false;
    }

    public function paginateCustomers($perPage = 15)
    {
        return Customer::paginate($perPage);
    }

    public function clearCache()
    {
        Cache::forget(self::CACHE_KEY);
    }
}
