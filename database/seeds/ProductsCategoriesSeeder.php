<?php

use App\CategoryProduct;
use App\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $products = Product::get();

        for ($i=0; $i < count($products); $i++) { 
            $number = $faker->numberBetween($min = 1, $max = 3);
            for ($j=1; $j <= $number; $j++) { 
                $numberCateg = $faker->numberBetween($min = 1, $max = 60);
                CategoryProduct::create([
                    'category_id' => $numberCateg,
                    'product_id' => $i+1
                ]);
            }
        }
    }
}
