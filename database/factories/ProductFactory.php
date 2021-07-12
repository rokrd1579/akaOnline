<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
   /* $name = $faker->sentence($nbWords = 4, $variableNbWords = true);
    $new_price = null;
    $promotion_id = null;
    return [
        //
            'name' => $name,
            'slug' => Str::slug($name),
            'characteristics' => $faker->sentence($nbWords = 12, $variableNbWords = true)  ,
            'description' => $faker->sentence($nbWords = 40, $variableNbWords = true)  ,
            'user_id' => $faker->randomElement([3,6]),
            'promotion_id' => $promotion_id,
            'price' =>  $price = $faker->numberBetween($min = 100, $max = 19000),
            'new_price' => $new_price,
            'price_shipping' => $faker->numberBetween($min = 50, $max = 99),
            'state' => $this->faker->randomElement(['Disponible','Agotado','Nuevo','En importación']),
            'stock' => $faker->numberBetween($min = 10, $max = 100),
            'active' => 1
    ];*/
});
