<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = [
        'dish_id',
        'restaurant_id',
        'name',
        'description',
        'price',
        'visible',
        'category',
        'image'
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
