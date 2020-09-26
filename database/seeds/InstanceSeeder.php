<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instance;

class InstanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $registro = [
            'record_id' => '1',
            'tombo' => '4569852',
        ];

        Instance::create($registro);

        factory(Instance::class, 200)->create();
    }
}
