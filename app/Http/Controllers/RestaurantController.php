<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Typology;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ottieni l'id dell'utente autenticato
        $userId = Auth::id();

        // Recupera i ristoranti associati all'utente autenticato
        $restaurants = Restaurant::where('user_id', $userId)->get();

        // Recupera gli ordini associati ai ristoranti dell'utente autenticato
        $orders = DB::table('dish_order')
            ->select('orders.*') // Seleziona tutti i campi dalla tabella orders
            ->join('orders', 'dish_order.order_id', '=', 'orders.id') // Esegui il join con la tabella orders
            ->whereIn('dish_order.dish_id', function ($query) use ($userId) {
                $query->select('id')
                    ->from('dishes')
                    ->whereIn('restaurant_id', function ($innerQuery) use ($userId) {
                        $innerQuery->select('id')
                            ->from('restaurants')
                            ->where('user_id', $userId);
                    });
            })
            ->orderByDesc('orders.created_at')->groupBy('orders.id') // Ordina gli ordini per data di creazione, più recenti per primi
            ->get();


        return Inertia::render('Dashboard', [
            'restaurants' => $restaurants,
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typologies = Typology::all();
        $userId = Auth::id(); // Ottieni l'id dell'utente autenticato
        return Inertia::render('Restaurants/CreateRestaurant', ['typologies' => $typologies, 'userId' => $userId]);
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

        // Creazione slug

        $slug = Restaurant::generaterSlug($request->name);

        $validatedData['slug'] = $slug;

        // Aggiungi l'id dell'utente autenticato

        // Creazione di una nuova istanza di Restaurant e salvataggio nel database
        $restaurant = Restaurant::create($validatedData);

        if ($request->has('selectedTypologies')) {
            $restaurant->typology()->attach($request->selectedTypologies);
        }

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
        $typologies = Typology::all();
        return Inertia::render('Restaurants/EditRestaurant', [
            'restaurant' => $restaurant,
            'typologies' => $typologies
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurant_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $restaurant->update($validatedData);


        if ($request->has('selectedTypologies')) {
            $restaurant->typology()->sync($request->selectedTypologies);
        }

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

    public function getAll(Request $request)
    {
        $filters = $request->query('filterByType');

        $query = Restaurant::query();

        if ($filters) {
            $array = explode(',', $filters);
            $query->whereHas('typology', function ($typologyQuery) use ($array) {
                $typologyQuery->whereIn('typologies.id', $array);
            }, '=', count($array));
        }

        // Se non ci sono filtri, restituisci tutti i ristoranti
        if (!$filters) {
            return Restaurant::with('typology')->get();
        }

        $restaurants = $query->with('typology')->get();
        return response()->json($restaurants);
    }
}
