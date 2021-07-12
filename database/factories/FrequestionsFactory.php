<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Frequestions;
use Faker\Generator as Faker;

$factory->define(Frequestions::class, function (Faker $faker) {
    
    return [
        'question' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'answer' => $faker->sentence($nbWords = 25, $variableNbWords = true)
    ];
});
