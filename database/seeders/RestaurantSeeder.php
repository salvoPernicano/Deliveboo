<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $restaurants = [
            // Italiani
            [
                'name' => 'Trattoria La Tavernetta',
                'slug' => Str::slug('Trattoria La Tavernetta'),
                'address' => 'Via Roma',
                'p_iva' =>  mt_rand(10000000000, 99999999999),
                'image' => 'ristorante2.jpg',
                'description' => "Un'atmosfera accogliente e piatti tradizionali preparati con ingredienti freschi e di alta qualità.",
                'typologies' => [2,4],
            ],
            [
                'name' => 'Ristorante Al Dente',
                'slug' => Str::slug('Ristorante Al Dente'),
                'address' => 'Via Garibaldi',
                'p_iva' =>  mt_rand(10000000000, 99999999999),
                'image' => 'ristorante.jpg',
                'description' => "Specialità della cucina italiana, con un'ampia selezione di pasta fresca e deliziosi piatti di carne e pesce.",
                'typologies' => [2],
            ],
            [
                'name' => 'Osteria del Sole',
                'slug' => Str::slug('Osteria del Sole'),
                'address' => 'Corso Vittorio Emanuele',
                'p_iva' =>  mt_rand(10000000000, 99999999999),
                'image' => 'ristorante3.jpg',
                'description' => "Un'osteria tradizionale con un menu stagionale che celebra i sapori locali e le ricette della nonna.",
                'typologies' => [2,4],
            ],
            // Giapponesi
            [
                'name' => 'Sakura Sushi Bar',
                'slug' => Str::slug('Sakura Sushi Bar'),
                'address' =>  'Via Dante',
                'p_iva' =>  mt_rand(10000000000, 99999999999),
                'image' => 'ristoranteGiappo.jpg',
                'description' => "Atmosfera tradizionale giapponese con una vasta selezione di sushi e sashimi.",
                'typologies' => [1],
            ],
            [
                'name' => 'Ramén Izakaya',
                'slug' => Str::slug('Ramén Izakaya'),
                'address' => 'Viale Kennedy',
                'p_iva' =>  mt_rand(10000000000, 99999999999),
                'image' => 'ristoranteGiappo2.jpg',
                'description' => "Ristorante izakaya con ramen autentico e piatti fusion giapponesi.",
                'typologies' => [1,5],
            ],
            [
                'name' => 'Tempura House',
                'slug' => Str::slug('Tempura House'),
                'address' => 'Corso Buenos Aires',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'ristoranteGiappo3.jpg',
                'description' => "Specializzato in tempura fresca e croccante con accompagnamenti tradizionali giapponesi.",
                'typologies' => [1,5],
            ],
            // Cinesi
            [
                'name' => 'Drago Rosso',
                'slug' => Str::slug('Drago Rosso'),
                'address' => 'Piazza San Marco',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'ristoranteCinese.jpg',
                'description' => "Autentica cucina cinese con una vasta selezione di piatti regionali e dim sum.",
                'typologies' => [3,5],
            ],
            [
                'name' => 'La Grande Muraglia',
                'slug' => Str::slug('La Grande Muraglia'),
                'address' => 'Via Milano',
                'p_iva' => '89012345678',
                'image' => 'ristoranteCinese2.jpg',
                'description' => "Ristorante cinese con un'ampia varietà di piatti alla griglia e zuppe tradizionali.",
                'typologies' => [3,4],
            ],
            [
                'name' => 'Fortuna del Dragone',
                'slug' => Str::slug('Fortuna del Dragone'),
                'address' => 'Corso Italia',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'ristoranteCinese3.jpg',
                'description' => "Cucina cinese raffinata con specialità regionali e piatti a base di frutti di mare.",
                'typologies' => [3],
            ],
            // Indiani
            [
                'name' => 'Taj Mahal',
                'slug' => Str::slug('Taj Mahal'),
                'address' => 'Piazza Duomo',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'ristoranteIndiano.jpg',
                'description' => "Atmosfera esotica e autentica cucina indiana con una vasta gamma di curry e tandoori.",
                'typologies' => [5,1],
            ],
            [
                'name' => 'Ganga Ristorante',
                'slug' => Str::slug('Ganga Ristorante'),
                'address' => 'Piazzetta San Pietro',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'ristoranteIndiano2.jpg',
                'description' => "Cucina indiana del Nord e del Sud con piatti vegetariani e non vegetariani.",
                'typologies' => [5,3],
            ],
            [
                'name' => 'Maharaja Palace',
                'slug' => Str::slug('Maharaja Palace'),
                'address' => 'Via Aurelia',
                'p_iva' => '87654321098',
                'image' => 'ristoranteIndiano3.jpg',
                'description' => "Atmosfera regale e autentica cucina indiana con piatti ricchi di spezie e aromi.",
                'typologies' => [5,2],
            ],
            // Messicani
            [
                'name' => 'El Sombrero',
                'slug' => Str::slug('El Sombrero'),
                'address' => 'Via del Corso',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'ristoranteMassicano.jpg',
                'description' => "Atmosfera vivace e autentica cucina messicana con una vasta selezione di taco, burrito e margarita.",
                'typologies' => [4,5],
            ],
            [
                'name' => 'La Hacienda',
                'slug' => Str::slug('La Hacienda'),
                'address' => 'Largo Argentina',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'ristoranteMassicano2.jpg',
                'description' => "Ristorante messicano con un'ampia varietà di piatti tradizionali, nachos e guacamole.",
                'typologies' => [4],
            ],
            [
                'name' => 'Tequila Sunrise',
                'slug' => Str::slug('Tequila Sunrise'),
                'address' => 'Via Veneto',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'ristoranteMassicano3.jpg',
                'description' => "Atmosfera festosa e autentici piatti messicani con una vasta selezione di tequila e cocktail.",
                'typologies' => [4,1],
            ],
        ];



        $originalImagePath = base_path('public/img');


        $storagePath = public_path('storage/public/restaurant_images');

        $imageFiles = File::files($originalImagePath);

        foreach ($imageFiles as $imageFile) {

            $imageName = $imageFile->getFilename();
            $imageFullPath = $imageFile->getPathname();

            $newImagePath = $storagePath . '/' . $imageName;
            File::copy($imageFullPath, $newImagePath);
        }
        foreach ($restaurants as $restaurantData) {
            $restaurant = Restaurant::create([
                'name' => $restaurantData['name'],
                'slug' => Str::slug($restaurantData['name']),
                'address' => $restaurantData['address'],
                'p_iva' => $restaurantData['p_iva'],
                'image' => $restaurantData['image'],
                'description' => $restaurantData['description'],
            ]);

            foreach ($restaurantData['typologies'] as $typologyId) {
                $restaurant->typology()->attach($typologyId);
            }
        }
    }
}
