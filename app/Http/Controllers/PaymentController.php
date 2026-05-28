<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\Payments\PaymentManager;

class PaymentController extends Controller
{
    public function pay($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);

        $paymentService = PaymentManager::driver('stripe');

        $url = $paymentService->createPayment($invoice);

        return redirect($url);
    }
}
