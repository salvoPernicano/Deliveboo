<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DelivebooController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Restaurant::query();

        
        if ($request->has('filterByType')) {
            $filterByType = $request->input('filterByType');
            $query->whereHas('typology', function ($typologyQuery) use ($filterByType) {
                $typologyQuery->where('typologies.id', $filterByType);
            });
        }

       
        $restaurants = $query->with('typology')->paginate(5);

       
        return Inertia::render('WebsiteHome', [
            'restaurants' => $restaurants,
        ]);
    }
}
