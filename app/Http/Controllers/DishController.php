<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $dishes = Dish::where('restaurant_id', $restaurantId)->get();
        
        return Inertia::render('Restaurants/Dishes/ViewMenu', [
            'restaurant' => $restaurant,
            'dishes' => $dishes
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        return Inertia::render('Restaurants/Dishes/CreateDish', ['restaurant' => $restaurant]);
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
    
       
        Dish::create($validatedData);

    
        
        $restaurantId = $validatedData['restaurant_id'];
    
        
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
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
