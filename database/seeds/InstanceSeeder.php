<?php

use Illuminate\Database\Seeder;
use App\Instance;

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
            'record_id' => '65',
            'tombo' => '4569852',
        ];

        Instance::create($registro);

        factory(Instance::class, 100)->create();
    }
}
