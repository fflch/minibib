<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Record;
use Faker\Generator as Faker;

$factory->define(Record::class, function (Faker $faker) {

    $tipo = ['Livro',
        'Panfleto',
        'Tese',
        'Periódico',
        'Artigo de Periódico',
        'Manuscrito',
        'Iconográfico',
        'Audiovisual',
        'Música (Som)',
        'Partitura'];

    return [
        'autores' => $faker->name,
        'titulo' => $faker->sentence,
        'tipo' => $tipo[array_rand($tipo)],
        'ano' => $faker->year($max = 'now'),
        'editora' => $faker->word,
        'edicao' => $faker->randomDigit,
        'assunto' => $faker->word,
        'idioma' => $faker->sentence,
        'isbn' => $faker->isbn13,
        'localizacao' => $faker->company,
        'local_p' => $faker->state,
        'issn' => $faker->ean8,
        'desc_f' => $faker->text,
    ];
});
