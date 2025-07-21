<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Record;

class ARecordTest extends DuskTestCase
{
    //use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    //php artisan dusk:chrome-driver --detect-chromedriver
    public function testCreateRecord()
    {
        $user = User::select('users.*')->first();
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records/create')
                    ->select('tipo','Livro')
                    ->typeSlowly('autores','Natsume Soseki')
                    ->typeSlowly('titulo','E depois')
                    ->typeSlowly('desc_fisica','Tradutor: Lica Hashimoto; Formato: 23x16x2 cm; Páginas: 288')
                    ->type('editora','Estação Liberdade')
                    ->type('assunto','literatura japonesa; romance psicológico')
                    ->type('local_publicacao','São Paulo')
                    ->type('edicao','1ª edição')
                    ->type('ano','2011')
                    ->select('idioma','pt_BR')
                    ->type('isbn','978-85-7448-201-9')
                    ->typeSlowly('issn','---')
                    ->press('@save_record')
                    ->assertPathIs('/records')
                    ->pause(3000);
        });
    }

    public function testUpdateRecord(){
        $user = User::select('users.*')->first();
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records')
                    ->pause(2000)
                    ->click('@edit_record')
                    ->select('tipo','Livro')
                    ->assertSee('Edição de Cadastro')
                    ->clear('autores')
                    ->typeSlowly('autores','夏目 漱石 - Natsume Soseki')
                    ->clear('titulo')
                    ->typeSlowly('titulo','吾輩は猫である - Eu sou um gato')
                    ->clear('desc_fisica')
                    ->typeSlowly('desc_fisica','Tradutor: Jefferson José Teixeira; Formato: 23x16x2 cm; Páginas: 488')
                    ->clear('editora')
                    ->type('editora','Estação Liberdade')
                    ->clear('assunto')
                    ->type('assunto','Yoyûha; Anti-naturalismo')
                    ->clear('local_publicacao')
                    ->type('local_publicacao','São Paulo')
                    ->clear('edicao')
                    ->type('edicao','1ª edição')
                    ->clear('ano')
                    ->typeSlowly('ano','2008')
                    ->select('idioma','pt_BR')
                    ->clear('isbn')
                    ->typeSlowly('isbn','978-85-7448-138-8')
                    ->clear('issn')
                    ->typeSlowly('issn','---')
                    ->pause(1000)
                    ->press('@save_record')
                    ->pause(3000);
        });
    }


    public function testExemplarCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->click('@cadastrar_exemplar')
                    ->pause(300)
                    ->typeSlowly('tombo','909090')
                    ->typeSlowly('localizacao','estante 3.v4')
                    ->pause(1000)
                    ->press("@save_instance")
                    ->pause(3000);
        });
    }

    public function testExemplarUpdate(){
        $user = User::select('users.*')->first();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->click('@instance')
                    ->click('@edit_instance')
                    ->typeSlowly('tombo','12345678')
                    ->typeSlowly('localizacao','estante 3.v1')
                    ->press("@save_instance")
                    ->pause(2000)
                    ->click('@instance')
                    ->click("@emprestar_material")
                    ->pause(2000)
                    ->typeSlowly("n_usp","$user->codpes")
                    ->pause(2000)
                    ->click("@confirmar_emprestimo")
                    ->click("@devolver_exemplar")
                    ->pause(1000)
                    ->click("@confirmar_devolucao")
                    ->pause(1000)
                    ->visit('/records')
                    ->pause(3000)
                    ->click("@delete_exemplar")
                    ->pause(2000)
                    ->acceptDialog()
                    ->pause(3000);
        });
    }

    public function testDeleteRecord()
    {
        $user = User::select('users.*')->first();
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records')
                    ->click('@delete_record')
                    ->pause(4000)
                    ->acceptDialog()
                    ->pause(3000)
                    ->assertPathIs('/records');
        });
    }
}
