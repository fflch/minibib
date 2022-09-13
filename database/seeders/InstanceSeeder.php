<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instance;
use App\Models\Record;

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
            'record_id'   => '1',
            'tombo'       => '4569852',
            'localizacao' => 'BS.X10/2'
        ];

        Instance::create($registro);

        Instance::factory(200)->create();
    }
}
