<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRestaurantRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::get(['id', 'name', 'address', 'p_iva', 'image', 'description']);


        return Inertia::render('Restaurants/AppRestaurants', ['restaurants' => $restaurants]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Restaurants/CreateRestaurant');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreRestaurantRequest $request)
    {


        $validatedData = $request->validated();

        // Caricamento dell'immagine
        if ($request->hasFile('image')) {
            // Salva l'immagine nella cartella 'public/restaurant_images' e ottieni il percorso
            $imagePath = $request->file('image')->store('restaurant_images', 'public');

            // Aggiungi il percorso dell'immagine ai dati validati
            $validatedData['image'] = $imagePath;
        }

        // Aggiungi l'id dell'utente autenticato

        // Creazione di una nuova istanza di Restaurant e salvataggio nel database
        Restaurant::create($validatedData);

        // Reindirizzamento alla pagina degli ristoranti
        return Redirect::route('restaurants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return Inertia::render('Restaurants/EditRestaurant', [
            'restaurant' => $restaurant
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRestaurantRequest $request, Restaurant $restaurant)
    {
        $validatedData = $request->validated();


        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('restaurant_images', 'public');

            $validatedData['image'] = $imagePath;
        }

        $restaurant->update($validatedData);

        return Redirect::route('restaurants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
       $restaurant->delete();
       
       return Redirect::route('restaurants.index');
    }
}
