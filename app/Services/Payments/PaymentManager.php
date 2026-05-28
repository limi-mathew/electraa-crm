<?php

namespace App\Services\Payments;

class PaymentManager
{
    public static function driver($type)
    {

        return match ($type) {
            'stripe' => new StripePaymentServices,
            default => throw new \Exception('Payment driver not supported'),
        };
    }
}
