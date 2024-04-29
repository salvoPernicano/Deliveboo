<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Inertia\Inertia;


class DelivebooController extends Controller
{
    public function index()
    {
        // Recupera una lista di 5 ristoranti a caso dal database
        $restaurants = Restaurant::inRandomOrder()->limit(5)->get();

        // Passa i ristoranti alla vista e renderizza la homepage
        return Inertia::render('WebsiteHome', ['restaurants' => $restaurants]);
    }
}
