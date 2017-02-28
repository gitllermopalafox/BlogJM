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
        for($cont = 1; $cont <= 20; $cont++){

            $faker = Faker::create();

            DB::table('blog')->insert(array(
            	'visitas' 	 => $faker->numberBetween(1, 30),      
                'created_at' => $faker->dateTimeBetween( 	$startDate = 'now', 
                											$endDate = '1 year', 
                											$timezone = date_default_timezone_get()
                										)
            ));
        }

         for($cont = 1; $cont <= 20; $cont++){

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

        for($cont = 1; $cont <= 20; $cont++){

            $faker = Faker::create();

            DB::table('blog_translations')->insert(array(  
                'blog_id'       => $cont,         
                'titulo'        => $faker->sentence($nbWords = 3, $variableNbWords = true),
                'slug'          => $faker->slug(),
                'descripcion'   => $faker->sentence($nbWords = 30, $variableNbWords = true),
                'previo'        => $faker->sentence($nbWords = 10, $variableNbWords = true),
                'image_banner'  => 'blog-vista.png',
                'locale'        => '/uploads/blog/en',
                'created_at' => $faker->dateTimeBetween(    $startDate = '-9 month', 
                                                            $endDate = 'now', 
                                                            $timezone = date_default_timezone_get()
                                                        )
            ));
        }
    }
}
