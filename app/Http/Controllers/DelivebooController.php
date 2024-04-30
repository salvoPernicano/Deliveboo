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
        // Creiamo la query base
        $query = Restaurant::query();
    
        // Applichiamo il filtro se presente
        if ($request->has('filterByType')) {
            $filterByTypes = $request->input('filterByType');
    
            // Controlla che il ristorante abbia esattamente il numero di tipologie selezionate
            $query->whereHas('typology', function ($typologyQuery) use ($filterByTypes) {
                $typologyQuery->whereIn('typologies.id', $filterByTypes);
            }, '=', count($filterByTypes));
        }
    
        // Eseguiamo la query paginata
        $restaurants = $query->with('typology')->get();
    
        // Ritorniamo la vista utilizzando Inertia
        return Inertia::render('Welcome', [
            'restaurants' => $restaurants,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
    

    public function show(Restaurant $restaurant)
    {
        // Carica il ristorante con le sue tipologie e il menu
        $restaurant = $restaurant->load('typology', 'dishes');

        // Ritorna la vista dei dettagli del ristorante e del menu
        return Inertia::render('RestaurantDetails', [
            'restaurant' => $restaurant,
            
        ]);
    }
}
