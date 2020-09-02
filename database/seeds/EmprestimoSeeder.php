<?php

use Illuminate\Database\Seeder;
use App\Emprestimo;

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
            'tombo' => '4578125',
            'data_emprestimo' => '2020-08-25',
            'data_devolucao' => '2020-09-25',
            'id_user' => '56',
            'codpes' => '11170411',
        ];

        Emprestimo::create($entrada);

        factory(Emprestimo::class, 50)->create();
    }
}
