<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;


class RecordTest extends DuskTestCase
{
    //use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateRecord()
    {
        $user = User::factory()->create();
        $user->setDefaultPermission();

        $user->givePermissionTo(['admin']);
        
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records/create')
                    ->select('tipo','Livro')
                    ->typeSlowly('autores','Natsume Soseki')
                    ->typeSlowly('titulo','E depois')
                    ->typeSlowly('desc_fisica','Tradutor: Lica Hashimoto; Formato: 23x16x2 cm; Páginas: 288')
                    ->typeSlowly('editora','Estação Liberdade')
                    ->typeSlowly('assunto','literatura japonesa; romance psicológico')
                    ->typeSlowly('local_publicacao','São Paulo')
                    ->typeSlowly('edicao','1ª edição')
                    ->typeSlowly('ano','2011')
                    ->select('idioma','pt_BR')
                    ->typeSlowly('isbn','978-85-7448-201-9')
                    ->typeSlowly('issn','---')
                    ->press('@save_record')
                    ->assertPathIs('/records');
        });
    }

    //public function testReadRecord()
    //{
    //    $user = User::factory()->create();
    //    $user->setDefaultPermission();
 
    //   $user->givePermissionTo(['admin']);
        
    //    $this->browse(function (Browser $browser) use($user) {
    //        $browser->loginAs($user)
    //                ->visit('/records')
    //                ->assertPathIs('/records')
    //                ->pause(2000);
    //    });
    //}

    public function testUpdateRecord(){
        $user = User::factory()->create();
        $user->setDefaultPermission();

        $user->givePermissionTo(['admin']);
        
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records')
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
                    ->typeSlowly('editora','Estação Liberdade')
                    ->clear('assunto')
                    ->typeSlowly('assunto','Yoyûha; Anti-naturalismo')
                    ->clear('local_publicacao')
                    ->typeSlowly('local_publicacao','São Paulo')
                    ->clear('edicao')
                    ->typeSlowly('edicao','1ª edição')
                    ->clear('ano')
                    ->typeSlowly('ano','2008')
                    ->select('idioma','pt_BR')
                    ->clear('isbn')
                    ->typeSlowly('isbn','978-85-7448-138-8')
                    ->clear('issn')
                    ->typeSlowly('issn','---')
                    ->press('@save_record')
                    ->assertSee('吾輩は猫である - EU SOU UM GATO');
        });
    }

    public function testDeleteRecord()
    {
        $user = User::factory()->create();
        $user->setDefaultPermission();

        $user->givePermissionTo(['admin']);
        
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records')
                    ->click('@delete_record')
                    ->acceptDialog()
                    ->assertPathIs('/records');
        });
    }
}
