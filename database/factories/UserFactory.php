<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Uspdev\Replicado\Pessoa;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $codpes = $this->faker->docente;

        return [
            'name' => Pessoa::obterNome($codpes),
            'email' => Pessoa::email($codpes),
            'codpes' => $codpes
        ];
    }
}