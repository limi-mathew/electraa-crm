<?php

namespace App\Services\Payments;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripePaymentServices implements PaymentInterface
{
    public function createPayment($invoice)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Invoice #'.$invoice->id,
                    ],
                    'unit_amount' => $invoice->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
            'metadata' => [
                'invoice_id' => $invoice->id,
            ],
        ]);

        return $session->url;
    }

    public function handleWebhook($event)
    {
        // 1. Only handle successful checkout
        if ($event->type !== 'checkout.session.completed') {
            return;
        }

        $session = $event->data->object;

        // 2. Validate metadata
        if (! isset($session->metadata->invoice_id)) {
            Log::warning('Stripe webhook missing invoice_id', ['event' => $event]);

            return;
        }

        $invoiceId = $session->metadata->invoice_id;

        DB::transaction(function () use ($invoiceId, $session) {

            // 3. Lock the invoice row
            $invoice = Invoice::where('id', $invoiceId)
                ->lockForUpdate()
                ->first();

            if (! $invoice) {
                Log::error('Invoice not found', ['invoice_id' => $invoiceId]);

                return;
            }

            // 4. Idempotency check (already paid)
            if ($invoice->status === 'paid') {
                return;
            }
            $transactionId = $session->payment_intent ?? $session->id;

            // 5. Prevent duplicate payment using transaction_id
            $existingPayment = Payment::where('transaction_id', $transactionId)
                ->first();

            if ($existingPayment) {
                return;
            }

            // 6. Update invoice
            $invoice->update([
                'status' => 'paid',
            ]);

            // 7. Store payment
            Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => $invoice->amount,
                'status' => 'success',
                'transaction_id' => $transactionId,
            ]);

        }, 3); // retry 3 times if deadlock
    }
}
