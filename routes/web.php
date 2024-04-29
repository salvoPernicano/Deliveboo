<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DelivebooController;
use App\Http\Controllers\DishController;
use App\Models\Restaurant;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/Deliveboo', [DelivebooController::class, 'index'])->name('home');





Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/restaurant', [RestaurantController::class,'index'])->name('restaurants.index');
Route::get('/restaurant/create', [RestaurantController::class,'create'])->name('restaurants.create');
Route::post('/restaurant', [RestaurantController::class,'store'])->name('restaurants.store');
Route::get('/restaurant/{restaurant}/edit',[RestaurantController::class,'edit']);
Route::put('/restaurant/{restaurant}',[RestaurantController::class,'update']);
Route::delete('/restaurant/{restaurant}',[RestaurantController::class,'destroy']);



Route::get('/dishes', [DishController::class,'index'])->name('dishes.index');
Route::get('/restaurant/{restaurant}/dishes/create', [DishController::class,'create'])->name('dishes.create');
Route::post('/restaurant/{restaurant}/dishes', [DishController::class,'store'])->name('dishes.store');

Route::get('/restaurant/{restaurant}/dishes/{dish}/edit', [DishController::class,'edit'])->name('dishes.edit');

Route::put('/restaurant/{restaurant}/dishes/{dish}', [DishController::class,'update']);

Route::delete('dishes/{dish}',[DishController::class,'destroy']);

require __DIR__.'/auth.php';
