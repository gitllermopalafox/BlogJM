<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class BlogSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
        for($cont = 1; $cont <= 40; $cont++){

            $faker = Faker::create();

            DB::table('blog')->insert(array(
            	'visitas' 	 => $faker->numberBetween(1, 30),      
                'created_at' => $faker->dateTimeBetween( 	$startDate = 'now', 
                											$endDate = '1 year', 
                											$timezone = date_default_timezone_get()
                										)
            ));
        }

         for($cont = 1; $cont <= 40; $cont++){

            $faker = Faker::create();

            DB::table('blog_translations')->insert(array(  
                'blog_id'       => $cont,         
                'titulo'        => $faker->sentence($nbWords = 3, $variableNbWords = true),
                'slug'          => $faker->slug(),
                'descripcion'   => $faker->sentence($nbWords = 30, $variableNbWords = true),
                'previo'        => $faker->sentence($nbWords = 10, $variableNbWords = true),
                'image_banner'  => '/uploads/blog/blog-vista.png',
                'locale'        => 'es',
                'created_at' => $faker->dateTimeBetween(    $startDate = '-9 month', 
                                                            $endDate = 'now', 
                                                            $timezone = date_default_timezone_get()
                                                        )
            ));
        }

        for($cont = 1; $cont <= 40; $cont++){

            $faker = Faker::create();

            DB::table('blog_translations')->insert(array(  
                'blog_id'       => $cont,         
                'titulo'        => $faker->sentence($nbWords = 3, $variableNbWords = true),
                'slug'          => $faker->slug(),
                'descripcion'   => $faker->sentence($nbWords = 30, $variableNbWords = true),
                'previo'        => $faker->sentence($nbWords = 10, $variableNbWords = true),
                'image_banner'  => '/uploads/blog/blog-vista.png',
                'locale'        => 'en',
                'created_at' => $faker->dateTimeBetween(    $startDate = '-9 month', 
                                                            $endDate = 'now', 
                                                            $timezone = date_default_timezone_get()
                                                        )
            ));
        }

        for($cont = 1; $cont <= 40; $cont++)
        {
            $faker = Faker::create();

            DB::table('blog_has_tag')->insert(array(
                'tag_id'   => $faker->numberBetween(1, 7),
                'blog_id'  => $cont,
            ));
        }

        for($cont = 0; $cont <= 8; $cont++){

            $faker = Faker::create();
                
            DB::table('tag')->insert(array(
                'created_at' => $faker->dateTimeBetween(   $startDate = '-9 month', 
                                                            $endDate = 'now', 
                                                            $timezone = date_default_timezone_get()
                                                        )
            ));
        }

        $array_tags = [ 'Ciudad', 
                        'Playa', 
                        'Pueblo', 
                        'Tips', 
                        'Eventos', 
                        'Aventura', 
                        'Negocios', 
                        'Familia', 
                        'Romance'
                      ];
        $tag_id = 1;
        
        for($cont = 0; $cont <= 8; $cont++)
        {
            DB::table('tag_translations')->insert(array(
                'nombre'     => $array_tags[$cont],
                'tag_id'     => $tag_id,
                'slug'       => strtolower($array_tags[$cont]),
                'locale'     => 'es'
            ));

            DB::table('tag_translations')->insert(array(
                'nombre'     => $array_tags[$cont],
                'tag_id'     => $tag_id,
                'slug'       => strtolower($array_tags[$cont]),
                'locale'     => 'en'
            ));
            
            $tag_id++;
        }
    }
}
