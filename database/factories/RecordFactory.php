<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Record;
use App\Models\Instance;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $record = new Record;
        $tipo = $record->tipoOptions();

        return [
            'autores' => $this->faker->name,
            'titulo' => $this->faker->sentence,
            'tipo' => $tipo[array_rand($tipo)],
            'ano' => $this->faker->year($max = 'now'),
            'editora' => $this->faker->word,
            'edicao' => $this->faker->randomDigit,
            'assunto' => $this->faker->word,
            'idioma' => $this->faker->sentence,
            'isbn' => $this->faker->isbn13,
            'localizacao' => $this->faker->company,
            'local_p' => $this->faker->state,
            'issn' => $this->faker->ean8,
            'desc_f' => $this->faker->text
        ];
    }
}

