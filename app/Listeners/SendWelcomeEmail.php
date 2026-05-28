<?php

namespace App\Listeners;

use App\Events\CustomerCreated;
use App\Jobs\WelcomeEmailJob;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CustomerCreated $event): void
    {
        WelcomeEmailJob::dispatch($event->customer);
        $customer = $event->customer;

        // Logic to send welcome email to the customer
        // For example, you can use Laravel's Mail facade to send an email
        // Mail::to($customer->email)->send(new WelcomeEmail($customer));
    }
}
