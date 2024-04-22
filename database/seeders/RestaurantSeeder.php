<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $restaurants = [
            [
                'name' => 'Ristorante da Gaetano',
                'address' => 'Via Roma 11',
                'p_iva' => '12345678901',
                'image' => '#',
                'description' => 'Ristorante specializzato in cucina tipica napoletana',
            ],
        ];

    }
}
