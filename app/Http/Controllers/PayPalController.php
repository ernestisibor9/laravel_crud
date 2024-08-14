<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use Illuminate\Http\Request;

class PayPalController extends Controller
{
    // PayPal
    public function PayPal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->price
                    ]
                ]
            ]
        ]);
        // dd($response);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    session()->put('product_name', $request->product_name);
                    session()->put('quantity', '1');
                    return redirect()->away($link['href']);
                }
            }
        }
        else{
            return redirect()->route('cancel');
        }
    }
    // success
    public function Success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        // dd($response);
        if (isset($response['status']) && $response['status']=== 'COMPLETED')   {
            // Insert the payment order into the database
            $payment = new Payment;
            // $payment->user_id = auth()->user()->id;
            $payment->payment_id = $response['id'];
            $payment->product_name = session()->get('product_name');
            $payment->quantity = session()->get('quantity');
            $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $payment->payer_name = $response['payer']['name']['given_name'];
            $payment->payer_email = $response['payer']['email_address'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = 'PayPal';
            $payment->save();
            // success
            return "Payment is successfully";

            unset($_SESSION['product_name']);
            unset($_SESSION['quantity']);
        }
        else{
            // fail
            return redirect()->route('cancel');
        }
    }
    // cancel
    public function Cancel()
    {
        return "Payment is cancelled";
    }
}
