<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Instance;
use Faker\Generator as Faker;
//use App\Record;

$factory->define(Instance::class, function (Faker $faker) {
    //$record_ids = Record::where('id', '>', 0)->pluck('id')->toArray();
    return [
        //'record_id' => $record_ids[array_rand($record_ids)],
        'record_id' => function () {
            return factory(App\Record::class)->create()->id;
        },
        'tombo' => $faker->unique()->numberBetween($min = 1000, $max = 90000),
    ];
});
