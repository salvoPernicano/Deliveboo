<?php

namespace App\Http\Controllers;
use App\Models\Order ;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function processPayment(Request $request)
    {
        // Retrieve cart from session
        $cart = session('cart');
        // dd($request,$cart);
        $nonceFromTheClient = $request->paymentMethodNonce;

        // Initialize Braintree with your credentials
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '44sxcnc6mrqrspwc',
            'publicKey' => '6pnxs5797x5dd2vz',
            'privateKey' => 'e52023be41c415883ea845ebc2a29005'
        ]);

        // Create a sale transaction with Braintree
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $order = new Order();
        $order->cart_total_price = $request->amount;
        $order->name = $request->orderDetails['name'];
        $order->email = $request->orderDetails['email'];
        $order->phone = $request->orderDetails['phone'];
        $order->address = $request->orderDetails['address'];
        $order->name_doorbell = $request->orderDetails['name_doorbell'];
        $order->save();


        $cartIds = collect($cart)->pluck('id')->toArray();

        // Esegui l'attach degli ID alla relazione many-to-many
        $order->dishes()->attach($cartIds);
            
            $orderDetails = $request->orderDetails;
            $orderTotal = $request->amount;
            return Redirect::route('checkout.success',['orderDetails' => $orderDetails, 'cart' => $cart, 'total' => $orderTotal]);
        } else {
            return response()->json(['error' => 'Payment transaction failed'], 400);
        }
    }

    public function index(Request $request) {
        $orderDetails = $request->orderDetails;
        $orderTotal = $request->total;
        $cart = $request->cart;


        return Inertia::render('Checkout', ['orderDetails' => $orderDetails,'cart' => $cart, 'orderTotal' => $orderTotal]);
    }
}
