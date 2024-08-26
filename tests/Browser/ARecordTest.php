<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;


class ARecordTest extends DuskTestCase
{
    //use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateRecord()
    {
        $user = User::select('users.*')->first();
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records/create')
                    ->select('tipo','Livro')
                    ->type('autores','Natsume Soseki')
                    ->type('titulo','E depois')
                    ->type('desc_fisica','Tradutor: Lica Hashimoto; Formato: 23x16x2 cm; Páginas: 288')
                    ->type('editora','Estação Liberdade')
                    ->type('assunto','literatura japonesa; romance psicológico')
                    ->type('local_publicacao','São Paulo')
                    ->type('edicao','1ª edição')
                    ->type('ano','2011')
                    ->select('idioma','pt_BR')
                    ->type('isbn','978-85-7448-201-9')
                    ->type('issn','---')
                    ->press('@save_record')
                    ->assertPathIs('/records');
        });
    }

    public function testUpdateRecord(){
        $user = User::select('users.*')->first();
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records')
                    ->click('@edit_record')
                    ->select('tipo','Livro')
                    ->assertSee('Edição de Cadastro')
                    ->clear('autores')
                    ->type('autores','夏目 漱石 - Natsume Soseki')
                    ->clear('titulo')
                    ->type('titulo','吾輩は猫である - Eu sou um gato')
                    ->clear('desc_fisica')
                    ->type('desc_fisica','Tradutor: Jefferson José Teixeira; Formato: 23x16x2 cm; Páginas: 488')
                    ->clear('editora')
                    ->type('editora','Estação Liberdade')
                    ->clear('assunto')
                    ->type('assunto','Yoyûha; Anti-naturalismo')
                    ->clear('local_publicacao')
                    ->type('local_publicacao','São Paulo')
                    ->clear('edicao')
                    ->type('edicao','1ª edição')
                    ->clear('ano')
                    ->type('ano','2008')
                    ->select('idioma','pt_BR')
                    ->clear('isbn')
                    ->type('isbn','978-85-7448-138-8')
                    ->clear('issn')
                    ->type('issn','---')
                    ->press('@save_record');
        });
    }

    public function testDeleteRecord()
    {
        $user = User::select('users.*')->first();
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records')
                    ->click('@delete_record')
                    ->acceptDialog()
                    ->assertPathIs('/records');
        });
    }
}
