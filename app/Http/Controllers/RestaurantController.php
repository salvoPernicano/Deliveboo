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


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::get(['id','name','address','p_iva','image','description']);


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
     
         if ($request->hasFile('image')) {
             $path = Storage::disk('public')->put('restaurant_images', $request->file('image'));
     
             $validatedData['image'] = $path;
         }
     
         $restaurant = new Restaurant($validatedData);
     
         $restaurant->save();
         dd($restaurant);
     
         return redirect()->route('Restaurants.AppRestaurants');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
