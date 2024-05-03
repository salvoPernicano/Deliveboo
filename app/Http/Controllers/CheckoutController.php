<?php

namespace App\Http\Controllers;
use Braintree\Gateway;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Braintree;

class CheckoutController extends Controller
{
    public function processPayment(Request $request)
    {
        $nonceFromTheClient = $request->paymentMethodNonce;

        // Inizializza Braintree con le tue credenziali
        $gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '44sxcnc6mrqrspwc',
            'publicKey' => '6pnxs5797x5dd2vz',
            'privateKey' => 'e52023be41c415883ea845ebc2a29005'
        ]);

        // Crea una transazione di vendita con Braintree
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return Redirect::route('checkout.success');
        } else {
            return response()->json(['error' => 'Transazione di pagamento fallita'], 400);
        }
    }
}
