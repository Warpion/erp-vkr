<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->words(2, true),
        'price' => $faker->numberBetween(10, 20),
        'rating' => $faker->numberBetween(1000, 2000),
        'time' => gmdate('H:i', $faker->numberBetween(1000, 10000)),
        'time_avg' => gmdate('H:i', $faker->numberBetween(1000, 10000)),
        'tasks_complete' => $faker->numberBetween(10, 15),
    ];
});
