<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Instance;
use App\Models\Record;

class InstanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'record_id' => Record::factory()->create()->id,
            'tombo' => $this->faker->unique()->numberBetween($min = 1000, $max = 90000),
            'localizacao' => $this->faker->localIpv4,
        ];
    }
}
