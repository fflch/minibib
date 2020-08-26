<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Instance;
use Faker\Generator as Faker;

$factory->define(Instance::class, function (Faker $faker) {
    return [
        'record_id' => $faker->unique()->numberBetween($min = 01, $max = 90000),
        'tombo' => $faker->unique()->numberBetween($min = 1000, $max = 90000),
    ];
});
