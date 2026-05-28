<?php

namespace App\Jobs;

use App\Mail\WelcomeCustomerEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class WelcomeEmailJob implements ShouldQueue
{
    use Dispatchable , Queueable , SerializesModels;

    /**
     * Create a new job instance.
     */
    public $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->customer->email)->send(new WelcomeCustomerEmail($this->customer));
    }
}
