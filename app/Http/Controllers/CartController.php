<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cartView() {
       $cart = session()->get('cart');
        return Inertia::render('Cart', [
            'cartList' => $cart,
        ]);
    }

    public function addToCart($product_id) {
        $product = Dish::findOrFail($product_id);
    
        $cart = session()->get('cart');
    
        if (!$cart) {
            // Se il carrello è vuoto, aggiungi il primo prodotto con quantità 1
            $cart = [
                $product->id => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => 1,
                ]
            ];
            session()->put('cart', $cart);
        } else {
            // Se il prodotto è già nel carrello, aumenta la quantità
            if (isset($cart[$product->id])) {
                if (isset($cart[$product->id]['quantity'])) {
                    $cart[$product->id]['quantity']++;
                } else {
                    $cart[$product->id]['quantity'] = 1;
                }
            } else {
                // Altrimenti, aggiungi il prodotto con quantità 1
                $cart[$product->id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => 1,
                ];
            }
            
            session()->put('cart', $cart);
        }
    
        return redirect()->route('cartView');
    }

    public function removeFromCart($product_id) {
        $cart = Session::get('cart');
        if(isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
            return redirect()->route('cartView');
        }
    }

    public function changeQuantity(Request $request){
        $cart = Session::get('cart');
        // Ottieni l'ID del prodotto dalla richiesta invece di $request->product_id
        $productId = $request->input('product_id');
        // Verifica se l'ID del prodotto è presente nell'array del carrello
        if(isset($cart[$productId])) {
            // Aggiorna la quantità del prodotto con il valore fornito nella richiesta
            $cart[$productId]['quantity'] = $request->input('quantity');
            // Aggiorna la sessione del carrello con il nuovo array
            session()->put('cart', $cart);
        }
        // Reindirizza alla vista del carrello
        return redirect()->route('cartView');
    }
}
