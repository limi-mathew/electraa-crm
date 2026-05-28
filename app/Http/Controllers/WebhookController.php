<?php

namespace App\Http\Controllers;

use App\Services\Payments\PaymentManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        try {
            $payload = $request->getContent();
            if (empty($payload)) {
                Log::error('Stripe Webhook Error', [
                    'message' => 'Empty payload received',
                ]);

                return response('Invalid payload', 400);
            }
            $sigHeader = $request->header('Stripe-Signature');

            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                config('services.stripe.webhook_secret')
            );

            $service = PaymentManager::driver('stripe');
            $service->handleWebhook($event);

            return response('OK', 200);

        } catch (\Throwable $e) {
            Log::error('Stripe Webhook Error', [
                'message' => $e->getMessage(),
            ]);

            return response('Error', 500);
        }
    }
}
