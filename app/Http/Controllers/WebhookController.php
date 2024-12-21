<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\Order;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent(
                $payload, 
                $sigHeader, 
                $endpointSecret
            );
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object; 

                Order::where('stripe_payment_id', $paymentIntent->id)
                    ->update(['status' => 'completed']);
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                
                Order::where('stripe_payment_id', $paymentIntent->id)
                    ->update(['status' => 'failed']);
                break;
        }

        return response('Webhook handled', 200);
    }
}
