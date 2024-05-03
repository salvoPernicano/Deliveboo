<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $restaurant = Restaurant::where('user_id', $userId)->first();

        $dishes = Dish::where('restaurant_id', $restaurant->id)->latest()->get();

        return Inertia::render('Restaurants/Dishes/ViewMenu', [
            'restaurant' => $restaurant,
            'dishes' => $dishes,


        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        return Inertia::render('Restaurants/Dishes/CreateDish', [
            'restaurant' => $restaurant,
            'colorFull' => false,
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {

        $validatedData = $request->validated();


        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('restaurant_images', 'public');


            $validatedData['image'] = $imagePath;
        }
        $newDish = Dish::create($validatedData);

        $restaurantId = $validatedData['restaurant_id'];

       $dishes = Dish::where('restaurant_id', $restaurantId)->get();

        $dishes->prepend($newDish);

        return Redirect::route('dishes.index', ['restaurant' => $restaurantId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant, Dish $dish )
    {


  return Inertia::render('Restaurants/Dishes/EditDish', ['restaurant' => $restaurant, 'dish' => $dish]);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Restaurant $restaurant, Dish $dish)
    {

        $validatedData = $request->validated();

        $validatedData['visible'] = $validatedData['visible'] === 'true' ? 1 : 0;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurant_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Aggiorna i dati del piatto con i dati inviati dalla richiesta
        $dish->update($validatedData);
         dd($request->all());
        // Reindirizza l'utente alla pagina di indice dei ristoranti
        return redirect()->route('dishes.index');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish, Restaurant $restaurant)
    {
        $restaurant_id = $dish->restaurant_id;

        $dish->delete();

        return Redirect::route('dishes.index', ['restaurant' => $restaurant_id]);
    }
}
