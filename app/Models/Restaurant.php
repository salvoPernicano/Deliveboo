<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'p_iva',
        'image',
        'description',
        'user_id'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function typology(){
        return $this->belongsToMany(Typology::class,'restaurant_typology');
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public static function generaterSlug($name){
        return Str::slug($name, '-');
    }

    // Per mostrare lo slug da tutorial, non sembra servire
    // public function getRouteKey(){
    //     return 'slug';
    // }
}
