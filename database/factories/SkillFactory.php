<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Skill::class, function (Faker $faker) {
    return [
        'skill' => $faker->word(),
    ];
});
