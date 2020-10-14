<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Emprestimo;
use App\Models\User;
use App\Models\Instance;

class EmprestimoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Emprestimo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $entrada = new Emprestimo;

        return [
            'instance_id'     => Instance::factory()->create()->id,
            'data_emprestimo' => $this->faker->dateTimeThisMonth->format('Y-m-d'),
            'data_devolucao'  => $this->faker->dateTimeBetween($startDate = '-1 month', $endDate = '+ 1 month')->format('Y-m-d'),
            'user_id'         => User::factory()->create()->id,
            'n_usp'           => $this->faker->graduacao(),
        ];
    }
}
