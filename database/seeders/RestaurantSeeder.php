<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                'address' => 'Via Roma 23',
                'p_iva' =>  mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristorante2.png',
                'description' => "Un'atmosfera accogliente e piatti tradizionali preparati con ingredienti freschi e di alta qualità.",
                'user_id' => '0',
                'typologies' => [2,4,],
                'dishes' => [
                    [
                        'name' => 'Spaghetti alla Carbonara',
                        'price' => 10.99,
                        'image' => 'restaurant_images/carbonara.jpg',
                        'description' => 'Spaghetti con Uovo Guanciale e Pecorino',
                    ],
                    [
                        'name' => 'Tagliata di Manzo',
                        'price' => 15.99,
                        'image' => 'restaurant_images/tagliataCarne.jpg',
                        'description' => 'Carne Privilegiata con un cortono a scelta',
                    ],
                    [
                        'name' => 'Lasagna',
                        'price' => 8.99,
                        'image' => 'restaurant_images/lasagna.jpg',
                        'description' => 'Con Ragù e Besciamella',
                    ],
                    [
                        'name' => 'Pizza',
                        'price' => 7.00,
                        'image' => 'restaurant_images/pizza.jpg',
                        'description' => 'Pizza Margherita',
                    ],
                ],

            ],
            [
                'name' => 'Ristorante Al Dente',
                'slug' => Str::slug('Ristorante Al Dente'),
                'address' => 'Via Garibaldi 44',
                'p_iva' =>  mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristorante.jpg',
                'description' => "Specialità della cucina italiana, con un'ampia selezione di pasta fresca e deliziosi piatti di carne e pesce.",
                'user_id' => '0',
                'typologies' => [2],
                'dishes' => [
                    [
                        'name' => 'Spaghetti alla Carbonara',
                        'price' => 10.99,
                        'image' => 'restaurant_images/carbonara.jpg',
                        'description' => 'Spaghetti con Uovo Guanciale e Pecorino',
                    ],
                    [
                        'name' => 'Tagliata di Manzo',
                        'price' => 15.99,
                        'image' => 'restaurant_images/tagliataCarne.jpg',
                        'description' => 'Carne Privilegiata con un cortono a scelta',
                    ],
                    [
                        'name' => 'Lasagna',
                        'price' => 8.99,
                        'image' => 'restaurant_images/lasagna.jpg',
                        'description' => 'Con Ragù e Besciamella',
                    ],
                    [
                        'name' => 'Pizza',
                        'price' => 7.00,
                        'image' => 'restaurant_images/pizza.jpg',
                        'description' => 'Pizza Margherita',
                    ],
                ],

            ],
            [
                'name' => 'Osteria del Sole',
                'slug' => Str::slug('Osteria del Sole'),
                'address' => 'Corso Vittorio Emanuele 76',
                'p_iva' =>  mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristorante3.jpg',
                'description' => "Un'osteria tradizionale con un menu stagionale che celebra i sapori locali e le ricette della nonna.",
                'user_id' => '0',
                'typologies' => [2, 5],
                'dishes' => [
                    [
                        'name' => 'Spaghetti alla Carbonara',
                        'price' => 10.99,
                        'image' => 'restaurant_images/carbonara.jpg',
                        'description' => 'Spaghetti con Uovo Guanciale e Pecorino',
                    ],
                    [
                        'name' => 'Tagliata di Manzo',
                        'price' => 15.99,
                        'image' => 'restaurant_images/tagliataCarne.jpg',
                        'description' => 'Carne Privilegiata con un cortono a scelta',
                    ],
                    [
                        'name' => 'Lasagna',
                        'price' => 8.99,
                        'image' => 'restaurant_images/lasagna.jpg',
                        'description' => 'Con Ragù e Besciamella',
                    ],
                    [
                        'name' => 'Pizza',
                        'price' => 7.00,
                        'image' => 'restaurant_images/pizza.jpg',
                        'description' => 'Pizza Margherita',
                    ],
                ],
            ],
            // Giapponesi
            [
                'name' => 'Sakura Sushi Bar',
                'slug' => Str::slug('Sakura Sushi Bar'),
                'address' =>  'Via Dante',
                'p_iva' =>  mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristoranteGiappo.jpg',
                'description' => "Atmosfera tradizionale giapponese con una vasta selezione di sushi e sashimi.",
                'user_id' => '0',
                'typologies' => [1],
                'dishes' => [
                    [
                        'name' => 'Sashimi',
                        'price' => 12.99,
                        'image' => 'restaurant_images/sashimi.jpg',
                        'description' => 'Fettine di salmano ',
                    ],
                    [
                        'name' => 'Nigiri',
                        'price' => 6.00,
                        'image' => 'restaurant_images/nighiri.jpg',
                        'description' => 'Riso con una Fettina di pesce sopra',
                    ],
                    [
                        'name' => 'Tiger roll',
                        'price' => 7.00,
                        'image' => 'restaurant_images/tigerRoll.jpg',
                        'description' => 'Morbido salmone e fresco pesce bianco anticipano un cuore croccante di gambero fritto',
                    ],
                    [
                        'name' => 'Uramaki',
                        'price' => 6.00,
                        'image' => 'restaurant_images/uramaki .jpg',
                        'description' => 'Philadelphia Maki',
                    ],
                ],
            ],
            [
                'name' => 'Ramén Izakaya',
                'slug' => Str::slug('Ramén Izakaya'),
                'address' => 'Viale Kennedy',
                'p_iva' =>  mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristoranteGiappo2.jpg',
                'description' => "Ristorante izakaya con ramen autentico e piatti fusion giapponesi.",
                'user_id' => '0',
                'typologies' => [1,3],
                'dishes' => [
                    [
                        'name' => 'Sashimi',
                        'price' => 17.99,
                        'image' => 'restaurant_images/sashimi.jpg',
                        'description' => 'Fettine di salmano ',
                    ],
                    [
                        'name' => 'Nigiri',
                        'price' => 6.00,
                        'image' => 'restaurant_images/nighiri.jpg',
                        'description' => 'Riso con una Fettina di pesce sopra',
                    ],
                    [
                        'name' => 'Tiger roll',
                        'price' => 7.00,
                        'image' => 'restaurant_images/tigerRoll.jpg',
                        'description' => 'Morbido salmone e fresco pesce bianco anticipano un cuore croccante di gambero fritto',
                    ],
                    [
                        'name' => 'Uramaki',
                        'price' => 6.00,
                        'image' => 'restaurant_images/uramaki .jpg',
                        'description' => 'Philadelphia Maki',
                    ],
                ],
            ],
            [
                'name' => 'Tempura House',
                'slug' => Str::slug('Tempura House'),
                'address' => 'Corso Buenos Aires',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristoranteGiappo3.jpg',
                'description' => "Specializzato in tempura fresca e croccante con accompagnamenti tradizionali giapponesi.",
                'user_id' => '0',
                'typologies' => [2,5],
                'dishes' => [
                    [
                        'name' => 'Sashimi',
                        'price' => 17.99,
                        'image' => 'restaurant_images/sashimi.jpg',
                        'description' => 'Fettine di salmano ',
                    ],
                    [
                        'name' => 'Nigiri',
                        'price' => 6.00,
                        'image' => 'restaurant_images/nighiri.jpg',
                        'description' => 'Riso con una Fettina di pesce sopra',
                    ],
                    [
                        'name' => 'Tiger roll',
                        'price' => 7.00,
                        'image' => 'restaurant_images/tigerRoll.jpg',
                        'description' => 'Morbido salmone e fresco pesce bianco anticipano un cuore croccante di gambero fritto',
                    ],
                    [
                        'name' => 'Uramaki',
                        'price' => 6.00,
                        'image' => 'restaurant_images/uramaki .jpg',
                        'description' => 'Philadelphia Maki',
                    ],
                ],
            ],
            // Cinesi
            [
                'name' => 'Drago Rosso',
                'slug' => Str::slug('Drago Rosso'),
                'address' => 'Piazza San Marco',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristoranteCinese.jpg',
                'description' => "Autentica cucina cinese con una vasta selezione di piatti regionali e dim sum.",
                'user_id' => '0',
                'typologies' => [3,1],
                'dishes' => [
                    [
                        'name' => 'Riso Cantonese',
                        'price' => 6.99,
                        'image' => 'restaurant_images/risoCantonese.jpg',
                        'description' => 'Riso con Uovo Pisellini e Prosciutto',
                    ],
                    [
                        'name' => 'Ramen',
                        'price' => 12.00,
                        'image' => 'restaurant_images/ramen.jpg',
                        'description' => 'Spaghetti con Brodo Della nostra cultura',
                    ],
                    [
                        'name' => 'Ravioli a Vapore',
                        'price' => 4.00,
                        'image' => 'restaurant_images/ravioliVapore.jpg',
                        'description' => 'Ravioli con ripieni di carne a vapore',
                    ],
                    [
                        'name' => 'Involtini Primavera ',
                        'price' => 4.00,
                        'image' => 'restaurant_images/involtiniPrimavera.jpg',
                        'description' => 'Fagottini di pasta con un ripieno di verdure, di carne o misto',
                    ],
                ],
            ],
            [
                'name' => 'La Grande Muraglia',
                'slug' => Str::slug('La Grande Muraglia'),
                'address' => 'Via Milano',
                'p_iva' => '89012345678',
                'image' => 'restaurant_images/ristoranteCinese2.jpg',
                'description' => "Ristorante cinese con un'ampia varietà di piatti alla griglia e zuppe tradizionali.",
                'user_id' => '0',
                'typologies' => [3,4],
                'dishes' => [
                    [
                        'name' => 'Riso Cantonese',
                        'price' => 6.99,
                        'image' => 'restaurant_images/risoCantonese.jpg',
                        'description' => 'Riso con Uovo Pisellini e Prosciutto',
                    ],
                    [
                        'name' => 'Ramen',
                        'price' => 12.00,
                        'image' => 'restaurant_images/ramen.jpg',
                        'description' => 'Spaghetti con Brodo Della nostra cultura',
                    ],
                    [
                        'name' => 'Ravioli a Vapore',
                        'price' => 4.00,
                        'image' => 'restaurant_images/ravioliVapore.jpg',
                        'description' => 'Ravioli con ripieni di carne a vapore',
                    ],
                    [
                        'name' => 'Involtini Primavera ',
                        'price' => 4.00,
                        'image' => 'restaurant_images/involtiniPrimavera.jpg',
                        'description' => 'Fagottini di pasta con un ripieno di verdure, di carne o misto',
                    ],
                ],
            ],
            [
                'name' => 'Fortuna del Dragone',
                'slug' => Str::slug('Fortuna del Dragone'),
                'address' => 'Corso Italia',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristoranteCinese3.jpg',
                'description' => "Cucina cinese raffinata con specialità regionali e piatti a base di frutti di mare.",
                'user_id' => '0',
                'typologies' => [3],
                'dishes' => [
                    [
                        'name' => 'Riso Cantonese',
                        'price' => 6.99,
                        'image' => 'restaurant_images/risoCantonese.jpg',
                        'description' => 'Riso con Uovo Pisellini e Prosciutto',
                    ],
                    [
                        'name' => 'Ramen',
                        'price' => 12.00,
                        'image' => 'restaurant_images/ramen.jpg',
                        'description' => 'Spaghetti con Brodo Della nostra cultura',
                    ],
                    [
                        'name' => 'Ravioli a Vapore',
                        'price' => 4.00,
                        'image' => 'restaurant_images/ravioliVapore.jpg',
                        'description' => 'Ravioli con ripieni di carne a vapore',
                    ],
                    [
                        'name' => 'Involtini Primavera ',
                        'price' => 4.00,
                        'image' => 'restaurant_images/involtiniPrimavera.jpg',
                        'description' => 'Fagottini di pasta con un ripieno di verdure, di carne o misto',
                    ],
                ],
            ],
            // Indiani
            [
                'name' => 'Taj Mahal',
                'slug' => Str::slug('Taj Mahal'),
                'address' => 'Piazza Duomo',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristoranteIndiano.jpg',
                'description' => "Atmosfera esotica e autentica cucina indiana con una vasta gamma di curry e tandoori.",
                'user_id' => '0',
                'typologies' => [5,2],
                'dishes' => [
                    [
                        'name' => 'Samosa',
                        'price' => 3.99,
                        'image' => 'restaurant_images/samosa.jpg',
                        'description' => 'Ripieno salato e speziato, a base di carne, a un involucro di croccante pasta fritta',
                    ],
                    [
                        'name' => 'Pollo Tandori',
                        'price' => 8.00,
                        'image' => 'restaurant_images/polloTandori.jpg',
                        'description' => 'Pollo arrosto, condito con spezie e yogurt ',
                    ],
                    [
                        'name' => 'Riso e Pollo al Curry',
                        'price' => 14.00,
                        'image' => 'restaurant_images/polloCurry.jpg',
                        'description' => 'Pollo in salsa Curry con Riso',
                    ],
                    [
                        'name' => 'Tikka Masala ',
                        'price' => 9.00,
                        'image' => 'restaurant_images/tikkaMasala.jpg',
                        'description' => 'Pollo cotto in una profumata e speziata salsa ',
                    ],
                ],
            ],
            [
                'name' => 'Ganga Ristorante',
                'slug' => Str::slug('Ganga Ristorante'),
                'address' => 'Piazzetta San Pietro',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristoranteIndiano2.jpg',
                'description' => "Cucina indiana del Nord e del Sud con piatti vegetariani e non vegetariani.",
                'user_id' => '0',
                'typologies' => [5,3],
                'dishes' => [
                    [
                        'name' => 'Samosa',
                        'price' => 3.99,
                        'image' => 'restaurant_images/samosa.jpg',
                        'description' => 'Ripieno salato e speziato, a base di carne, a un involucro di croccante pasta fritta',
                    ],
                    [
                        'name' => 'Pollo Tandori',
                        'price' => 8.00,
                        'image' => 'restaurant_images/polloTandori.jpg',
                        'description' => 'Pollo arrosto, condito con spezie e yogurt ',
                    ],
                    [
                        'name' => 'Riso e Pollo al Curry',
                        'price' => 14.00,
                        'image' => 'restaurant_images/polloCurry.jpg',
                        'description' => 'Pollo in salsa Curry con Riso',
                    ],
                    [
                        'name' => 'Tikka Masala ',
                        'price' => 9.00,
                        'image' => 'restaurant_images/tikkaMasala.jpg',
                        'description' => 'Pollo cotto in una profumata e speziata salsa ',
                    ],

                ],
            ],
            [
                'name' => 'Maharaja Palace',
                'slug' => Str::slug('Maharaja Palace'),
                'address' => 'Via Aurelia',
                'p_iva' => '87654321098',
                'image' => 'restaurant_images/ristoranteIndiano3.jpg',
                'description' => "Atmosfera regale e autentica cucina indiana con piatti ricchi di spezie e aromi.",
                'user_id' => '0',
                'typologies' => [5,4],
                'dishes' => [
                    [
                        'name' => 'Samosa',
                        'price' => 3.99,
                        'image' => 'restaurant_images/samosa.jpg',
                        'description' => 'Ripieno salato e speziato, a base di carne, a un involucro di croccante pasta fritta',
                    ],
                    [
                        'name' => 'Pollo Tandori',
                        'price' => 8.00,
                        'image' => 'restaurant_images/polloTandori.jpg',
                        'description' => 'Pollo arrosto, condito con spezie e yogurt ',
                    ],
                    [
                        'name' => 'Riso e Pollo al Curry',
                        'price' => 14.00,
                        'image' => 'restaurant_images/polloCurry.jpg',
                        'description' => 'Pollo in salsa Curry con Riso',
                    ],
                    [
                        'name' => 'Tikka Masala ',
                        'price' => 9.00,
                        'image' => 'restaurant_images/tikkaMasala.jpg',
                        'description' => 'Pollo cotto in una profumata e speziata salsa ',
                    ],
                ],
            ],
            // Messicani
            [
                'name' => 'El Sombrero',
                'slug' => Str::slug('El Sombrero'),
                'address' => 'Via del Corso',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristoranteMassicano.jpg',
                'description' => "Atmosfera vivace e autentica cucina messicana con una vasta selezione di taco, burrito e margarita.",
                'user_id' => '0',
                'typologies' => [4,5],
                'dishes' => [
                    [
                        'name' => 'Tacos',
                        'price' => 5.99,
                        'image' => 'restaurant_images/tacos.jpg',
                        'description' => 'Tortilla di circa 10/15 cm di diametro,con carne, pesce oppure verdure',
                    ],
                    [
                        'name' => 'Tostadas',
                        'price' => 8.00,
                        'image' => 'restaurant_images/tostadas.jpg',
                        'description' => 'Tortillas che vengono fritte, servite croccanti e accompagnate con i più svariati condimenti',
                    ],
                    [
                        'name' => 'Quesadillas',
                        'price' => 11.00,
                        'image' => 'restaurant_images/quesadillas.jpg',
                        'description' => 'Involucri sottili ottenuti con un impasto a base di farina di mais bianca con un ripieno a base di formaggio, pollo speziato, peperoni e mais',
                    ],
                    [
                        'name' => 'Tortas ',
                        'price' => 8.00,
                        'image' => 'restaurant_images/tortas.jpg',
                        'description' => 'Dolce normalmente cotto in forno e generalmente di forma rotonda e piatta',
                    ],
                ],
            ],
            [
                'name' => 'La Hacienda',
                'slug' => Str::slug('La Hacienda'),
                'address' => 'Largo Argentina',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristoranteMassicano2.jpg',
                'description' => "Ristorante messicano con un'ampia varietà di piatti tradizionali, nachos e guacamole.",
                'user_id' => '0',
                'typologies' => [4,2],
                'dishes' => [
                    [
                        'name' => 'Tacos',
                        'price' => 5.99,
                        'image' => 'restaurant_images/tacos.jpg',
                        'description' => 'Tortilla di circa 10/15 cm di diametro,con carne, pesce oppure verdure',
                    ],
                    [
                        'name' => 'Tostadas',
                        'price' => 8.00,
                        'image' => 'restaurant_images/tostadas.jpg',
                        'description' => 'Tortillas che vengono fritte, servite croccanti e accompagnate con i più svariati condimenti',
                    ],
                    [
                        'name' => 'Quesadillas',
                        'price' => 11.00,
                        'image' => 'restaurant_images/quesadillas.jpg',
                        'description' => 'Involucri sottili ottenuti con un impasto a base di farina di mais bianca con un ripieno a base di formaggio, pollo speziato, peperoni e mais',
                    ],
                    [
                        'name' => 'Tortas ',
                        'price' => 8.00,
                        'image' => 'restaurant_images/tortas.jpg',
                        'description' => 'Dolce normalmente cotto in forno e generalmente di forma rotonda e piatta',
                    ],
                ],
            ],
            [
                'name' => 'Tequila Sunrise',
                'slug' => Str::slug('Tequila Sunrise'),
                'address' => 'Via Veneto',
                'p_iva' => mt_rand(10000000000, 99999999999),
                'image' => 'restaurant_images/ristoranteMassicano3.jpg',
                'description' => "Atmosfera festosa e autentici piatti messicani con una vasta selezione di tequila e cocktail.",
                'user_id' => '0',
                'typologies' => [4,1],
                'dishes' => [
                    [
                        'name' => 'Tacos',
                        'price' => 5.99,
                        'image' => 'restaurant_images/tacos.jpg',
                        'description' => 'Tortilla di circa 10/15 cm di diametro,con carne, pesce oppure verdure',
                    ],
                    [
                        'name' => 'Tostadas',
                        'price' => 8.00,
                        'image' => 'restaurant_images/tostadas.jpg',
                        'description' => 'Tortillas che vengono fritte, servite croccanti e accompagnate con i più svariati condimenti',
                    ],
                    [
                        'name' => 'Quesadillas',
                        'price' => 11.00,
                        'image' => 'restaurant_images/quesadillas.jpg',
                        'description' => 'Involucri sottili ottenuti con un impasto a base di farina di mais bianca con un ripieno a base di formaggio, pollo speziato, peperoni e mais',
                    ],
                    [
                        'name' => 'Tortas ',
                        'price' => 8.00,
                        'image' => 'restaurant_images/tortas.jpg',
                        'description' => 'Dolce normalmente cotto in forno e generalmente di forma rotonda e piatta',
                    ],
                ],
            ],
        ];

        $originalImagePath = storage_path('app/public/restaurant_images');
        $storagePath = public_path('storage/restaurant_images');

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
                'user_id' => $restaurantData['user_id'],
                'description' => $restaurantData['description'],
            ]);

            foreach ($restaurantData['typologies'] as $typologyId) {
                $restaurant->typology()->attach($typologyId);
            }
            foreach ($restaurantData['dishes'] as $dish) {

                $restaurant->dishes()->create([
                    'name' => $dish['name'],
                    'price' => $dish['price'],
                    'image' => $dish['image'],
                    'description' => $dish['description'],
                ]);
            }
        }

    }
}


