<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Emprestimo;
use Faker\Generator as Faker;
use App\User;
use App\Instance;

$factory->define(Emprestimo::class, function (Faker $faker) {

    $entrada = new Emprestimo;

    return [
        'instance_id'     => factory(Instance::class)->create()->id,
        'data_emprestimo' => $faker->dateTimeThisMonth->format('Y-m-d'),
        'data_devolucao'  => $faker->dateTimeBetween($startDate = '-1 month', $endDate = '+ 1 month')->format('Y-m-d'),
        'user_id'         => factory(User::class)->create()->id,
        'n_usp'           => $faker->graduacao(),
    ];
});
