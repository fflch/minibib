<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Record;
use App\Models\Instance;
use Illuminate\Support\Facades\Auth;


class InstanceTest extends DuskTestCase{

    //use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateInstance()
    {
        // $user = User::factory()->create();
        $user = User::select('users.*')->first();
        // $user->setDefaultPermission();

        // $user->givePermissionTo(['admin']);
        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit("/records")
                    ->press('@create_instance')
                    ->assertSee('Acervo')
                    ->type('tombo','801 L881 v.1')
                    ->type('localizacao','31856')
                    ->press('@save_instance');
        });
    }

    public function testUpdateInstance(){
        
        $user = User::select('users.*')->first();

        $this->browse(function (Browser $browser) use($user) {
            // $record = Record::find(1);
            $instance = Instance::select('instances.*')->first();
            $browser->loginAs($user)
                    
                    ->visit("/instances/$instance->id")
                    ->press('@edit_instance')
                    ->assertSee('Edição de Registro')
                    ->clear('tombo')
                    ->typeSlowly('tombo','801.5 H86g')
                    ->clear('localizacao')
                    ->typeSlowly('localizacao','11111')
                    ->press('@save_instance')
                    ->assertSee('Exemplares Patrimoniados:')
                    ->assertSee('801586');
        });
    }

    public function testDeleteInstance()
    {
        $user = User::find(1);
        $this->browse(function (Browser $browser) use($user) {
            // $record = Record::find(1);
            $instance = Instance::select('instances.*')->first();
            $browser->loginAs($user)
                    ->visit("/instances/$instance->id")
                    ->pause(1000)
                    ->press('@delete_instance')
                    ->acceptDialog()
                    ->assertPathIs('/records');
        });
    }
}
