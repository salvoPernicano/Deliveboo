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
    public function addToCart($product_id) {
        $product = Dish::findOrFail($product_id);

        $cart = session()->get('cart');

        $isValidRestaurant = !$cart ? true : $this->isValidRestaurantForCart($product->restaurant_id, $cart);
        if ($isValidRestaurant){
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
            } else {
                $cart[$product->id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => 1,
                    'restaurantId' => $product->restaurant_id,
                ];
            }
            session()->put('cart', $cart);
            return response()->json(['cart' => $cart]);
        } else return response()->json("Ciao");
    }

    public function isValidRestaurantForCart($restaurantId, $cart) {
        foreach ($cart as $item) {
            if ($item['restaurantId'] !== $restaurantId) {
                return false;
            }
        }
        return true;
    }

    public function clearCart()
{
    // Rimuovi il carrello dalla sessione
    Session::forget('cart');
    
    // Restituisci una risposta JSON per indicare che il carrello è stato svuotato con successo
   
}

    public function removeFromCart($product_id) {
        $cart = Session::get('cart');
        if(isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
            // Restituisci i dati del carrello aggiornati sotto forma di JSON
            return response()->json(['cart' => $cart]);
        }
        // Restituisci una risposta vuota se l'elemento non è stato trovato nel carrello
        return response()->json([]);
    }

    public function changeQuantity(Request $request){
        // dd($request);
        $localCartList = $request->all();
    
        // Aggiorna la sessione del carrello con i nuovi dati
        session()->put('cart', $localCartList);
        
        // Reindirizza alla vista del carrello
        return redirect()->route('cartView');
    }

    public function cartView() {
        // Ottieni il contenuto del carrello dalla sessione
        $cart = session('cart');
    
        // Restituisci la vista del carrello passando i dati del carrello come prop
        return Inertia::render('Cart', ['cartList' => $cart]);
    }
}
