<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(\App\Models\Project::class, function (Faker $faker) {
    return [
        'title' => $faker->word(3, true),
        'urgency' => $faker->numberBetween(1,3),
        'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
        'user_id' => $faker->numberBetween(2, 5),
    ];
});
