<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
/*
    $name = $faker->sentence($nbWords = 3);
    return [
        'category_name' => $name,
        'slug' => Str::slug($name),
        'image' => $faker->imageUrl($width = 600, $height = 400)
    ];*/
});
