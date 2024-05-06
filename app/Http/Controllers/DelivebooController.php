<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Typology;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DelivebooController extends Controller
{
    public function index(Request $request)
    {
        // Ottieni 5 ristoranti casuali dal database
        $restaurants = Restaurant::inRandomOrder()->with('typology')->get();

        // Ritorna la vista utilizzando Inertia
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'restaurants' => $restaurants,
        ]);
    }


    public function show(Restaurant $restaurant)
    {
        // Carica il ristor
        $cart = session()->get('cart');
        $restaurant = $restaurant->load('typology', 'dishes');

        $isValidRestaurant = !$cart ? true : $this->isValidRestaurantForCart($restaurant->id, $cart);

        // Ritorna la vista dei dettagli del ristorante e del menu
        return Inertia::render('RestaurantDetails', [
            'restaurant' => $restaurant,
            'cartList' => $cart,
            'isValidForCart' => $isValidRestaurant,
        ]);
    }

    public function isValidRestaurantForCart($restaurantId, $cart) {
        foreach ($cart as $item) {
            if ($item['restaurantId'] !== $restaurantId) {
                return false;
            }
        }
        return true;
    }
}
