<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        return Inertia::render('Orders', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
