<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = [
            'codpes' => '11170411',
            'name'   => 'Joaquim Navarro',
            'email'  => 'joaquim@usp.br',
        ];

        User::create($usuario);

        User::factory(5)->create();
    }
}
