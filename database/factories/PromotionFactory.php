<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Promotion;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Promotion::class, function (Faker $faker) {
    /*$name = $faker->sentence($nbWords=4);
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'description' => $faker->sentence($nbWords=6, $variableNbWords=true),
        'products_id' => $faker->numberBetween($min=1, $max=500),
        'image' => $faker->imageUrl($width = 1450, $height = 750),
        'discount' => $faker->numberBetween($min = 10, $max = 99),
        'stard_date'=>$faker->dateTimeBetween($startDate = '2021-06-02', $endDate = '2021-06-04'),
        'finish_date'=>$faker->dateTimeBetween($startDate = '2021-06-20', $endDate = '2021-06-21')

    ];*/
});
