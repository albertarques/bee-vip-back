<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function __construct()
    {
      $this->middleware('api');
    }

    public function process(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $token = $request->input('stripeToken');
        $email = $request->input('email');
        $amount = $request->input('amount');
        $description = $request->input('description');

        try {
            Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'email' => $email,
                'description' => $description,
                'source' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        return response()->json(['success' => true]);
    }
}
