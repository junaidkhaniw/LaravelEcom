<?php

namespace App\Http\Controllers;
use Stripe;
use Session;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    /**
     * payment view
     */
    public function handleGet()
    {
        return view('stripe');
    }
  
    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        Stripe\Stripe::setApiKey( 'sk_test_EO1s4pZQSl4Cgu1BYxiW0Uqn00s1RWnD5q' );
        Stripe\Charge::create ([
                "amount" => 100 * 150,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Making test payment." 
        ]);
  
        Session::flash('success', 'Payment has been successfully processed.');
          
        return back();
    }
}