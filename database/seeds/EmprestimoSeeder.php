<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Emprestimo;

class EmprestimoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entrada = [
            'instance_id' => '1',
            'data_emprestimo' => '2020-08-25',
            'data_devolucao' => '2020-09-25',
            'user_id' => '1',
            'n_usp' => '11170411',
        ];

        Emprestimo::create($entrada);

        factory(Emprestimo::class, 50)->create();
    }
}
