<?php

namespace App\Services\Payments;

interface PaymentInterface
{
    public function createPayment($invoice);

    public function handleWebhook($data);
}
