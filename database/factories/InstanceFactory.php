<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Instance;
use Faker\Generator as Faker;
use App\Record;

$factory->define(Instance::class, function (Faker $faker) {
    return [
        'record_id' => factory(Record::class)->create()->id,
        'tombo' => $faker->unique()->numberBetween($min = 1000, $max = 90000),
    ];
});
