<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    public function viewAny(User $user): bool
    {
        return true; // both admin & customer can see list
    }

    public function view(User $user, Invoice $invoice): bool
    {
        return $user->hasRole('Admin')
            || $invoice->customer_id === $user->id;
    }

    public function create(User $user): bool
    {

        return $user->hasRole('Admin');
    }

    public function update(User $user, Invoice $invoice): bool
    {
        return $user->hasRole('Admin');
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        return $user->hasRole('Admin');
    }
}
