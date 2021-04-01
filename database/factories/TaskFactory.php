<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(\App\Models\Task::class, function (Faker $faker) {
    return [
        'project_id' => $faker->numberBetween(1, 10),
        'category_id' => $faker->numberBetween(1, 8),
        'title' => $faker->words(3, true),
        'user_id' => $faker->numberBetween(2, 5),
        'description' => $faker->text('150'),
        'order' => $faker->numberBetween(1, 5),
    ];
});
