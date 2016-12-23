<?php

use App\Models\Keywords;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Keywords::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->randomNumber(),
        'keyword' => $faker->words(5),
        'route' => $faker->words(5),
        'is_favourite' => 1
    ];
});
