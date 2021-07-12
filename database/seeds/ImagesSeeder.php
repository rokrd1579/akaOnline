<?php

use App\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        $products = Product::get();
        $contador = count($products);

        for ($i=0; $i < $contador; $i++) { 
            for ($j=0; $j < 6; $j++) { 
                $url = $faker->imageUrl($width = 600, $height = 400);
                $prueba = Product::find($i+1);
                $prueba->images()->create(['url'=>$url]);
            }
        }
    }
}
