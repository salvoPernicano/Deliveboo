<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DelivebooController extends Controller
{
    public function index(Request $request)
    {
        // Creiamo la query base
        $query = Restaurant::query();

        // Applichiamo il filtro se presente
        if ($request->has('filterByType')) {
            $filterByType = $request->input('filterByType');
            $query->whereHas('typology', function ($typologyQuery) use ($filterByType) {
                $typologyQuery->where('typologies.id', $filterByType);
            });
        }

        // Eseguiamo la query paginata
        $restaurants = $query->with('typology')->paginate(5);

        // Ritorniamo la vista utilizzando Inertia
        return Inertia::render('WebsiteHome', [
            'restaurants' => $restaurants,
        ]);
    }
}
