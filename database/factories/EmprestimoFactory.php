<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Emprestimo;
use Faker\Generator as Faker;
use App\User;
use App\Instance;

$factory->define(Emprestimo::class, function (Faker $faker) {

    $entrada = new Emprestimo;

    return [
        'tombo'           => factory(Instance::class)->create()->tombo,
        'data_emprestimo' => $faker->dateTimeThisMonth->format('Y-m-d'),
        'data_devolucao'  => $faker->dateTimeBetween($startDate = '-1 month', $endDate = '+ 1 month')->format('Y-m-d'),
        'id_user'         => factory(User::class)->create()->id,
        'codpes'          => factory(User::class)->create()->codpes,
    ];
});
