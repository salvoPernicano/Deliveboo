<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Typology;
use App\Models\Restaurant;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        $typologies = Typology::all();
        $user_id = Auth::id(); // Ottieni l'ID dell'utente autenticato
        
        return Inertia::render('Auth/Register', ['typologies' => $typologies, 'user_id' => $user_id]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        // Validazione dei dati dell'utente
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'restaurant_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'p_iva' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'selectedTypologies' => 'nullable|array',
            'selectedTypologies.*' => 'exists:typologies,id',
        ]);
        // Validazione dei dati del ristorante
        
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($request->password),
        ]);
   
        // Creazione dell'utente
        
        // Creazione del ristorante associato all'utente
        $restaurant = Restaurant::create([
            'name' => $validatedData['restaurant_name'],
            'address' => $validatedData['address'],
            'p_iva' => $validatedData['p_iva'],
            'image' => $request->file('image') ? $request->file('image')->store('restaurant_images', 'public') : null,
            'description' => $validatedData['description'],
            'user_id' => $user->id,
        ]);
        
        // Esegui il login dell'utente appena creato
        Auth::login($user);
    
        // Reindirizza alla home o ad altre pagine come necessario
        return redirect(RouteServiceProvider::HOME);
    }
    
}
