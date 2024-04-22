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
            [
                'name' => 'King Kebab',
                'address' => 'Via Lungomare 2',
                'p_iva' => '23456789012',
                'image' => '#',
                'description' => 'Chiosco kebab, 100% carne Halal, cucina tipica regionale',
            ],

        ];


        foreach ($restaurants as $restaurantData) {
            Restaurant::create($restaurantData);
        }
    }
}
