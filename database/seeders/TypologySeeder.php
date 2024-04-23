<?php

namespace Database\Seeders;

use App\Models\Typology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typologies = 
            ['Giapponese', 
            'Italiana', 
            'Cinese', 
            'Messicano',
            'Indiana'];

            foreach($typologies as $element){
                $new_typology = new Typology();
                $new_typology->typology_name = $element;
                $new_typology->save();
            }
    }
}
