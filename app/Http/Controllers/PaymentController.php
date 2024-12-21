<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showForm(Request $request)
    {
        $totalPrice = $request->input('total_price');
        return view('payments.form')->with('totalPrice', $totalPrice);
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required'
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));
        $totalPrice = $request->input('totalPrice');
        $amount = $totalPrice; 
        $currency = 'usd'; 

        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => $currency,
            'payment_method' => $request->payment_method_id,
            'confirmation_method' => 'manual',
            'confirm' => true,
            'return_url' => route('payment.confirmation'), 
        ]);

        if ($paymentIntent->status === 'succeeded') {
            Order::create([
                'user_id' => Auth::id(), 
                'amount' => $amount, 
                'stripe_payment_id' => $paymentIntent->id,
                'status' => 'paid',
            ]);
            return redirect()->route('payment.confirmation');
        } else {
            return redirect()->route('payment.form')->with('error', 'Payment failed or requires additional steps.');
        }
    }

    public function confirmation()
    {
        return view('payments.confirmation');
    }
}