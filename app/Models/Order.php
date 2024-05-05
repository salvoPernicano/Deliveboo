<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_total_price',
        'name',
        'email',
        'phone',
        'address',
        'name_doorbell',
        'completed'
    ];

    protected static function boot()
    {
        parent::boot();

        // Utilizza il metodo 'creating' per impostare 'completed' a 'false' prima della creazione dell'ordine
        static::creating(function ($order) {
            $order->completed = false;
        });
    }

    public function dishes(){
        return $this->belongsToMany(Dish::class);
    }
}
