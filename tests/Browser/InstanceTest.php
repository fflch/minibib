<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;


class InstanceTest extends DuskTestCase{

    //use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateInstance()
    {
        $user = User::factory()->create();
        $user->setDefaultPermission();

        $user->givePermissionTo(['admin']);
        
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records')
                    ->press('@create_instance')
                    ->assertSee('Acervo')
                    ->typeSlowly('tombo','801 L881 v.1')
                    ->typeSlowly('localizacao','31856')
                    ->press('@save_instance')
                    ->assertSee('Tombos Patrimoniados:')
                    ->assertSee('8018811');
        });
    }

    public function testUpdateInstance(){
        $user = User::factory()->create();
        $user->setDefaultPermission();

        $user->givePermissionTo(['admin']);
        
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records')
                    ->click('@edit_instance')
                    ->press('@edit_tombo')
                    ->assertSee('Edição de Registro')
                    ->clear('tombo')
                    ->typeSlowly('tombo','801.5 H86g')
                    ->clear('localizacao')
                    ->typeSlowly('localizacao','11111')
                    ->press('@save_instance')
                    ->assertSee('Tombos Patrimoniados:')
                    ->assertSee('801586');
        });
    }

    public function testDeleteInstance()
    {
        $user = User::factory()->create();
        $user->setDefaultPermission();

        $user->givePermissionTo(['admin']);
        
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/records')
                    ->click('@delete_instance')
                    ->acceptDialog()
                    ->assertPathIs('/records');
        });
    }
}
