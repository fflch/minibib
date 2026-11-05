<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExemplarCrudTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_exemplar_crud(): void
    {
       $this->browse(function (Browser $browser) {
            //login do usuário
            $browser->visit('/')
                    ->clickLink('Entrar')
                    ->waitForText('Usuário')
                    ->type('#loginUsuario', '11111')
                    ->press('Login')
                    ->AssertSee('Sair')

                //Create Record
                    ->visit('/records/create')
                    ->select('tipo','Livro')
                    ->typeSlowly('autores','Jorge Amado')
                    ->typeSlowly('titulo','Capitães da Areia')
                    ->typeSlowly('desc_fisica','Formato: 14.00x21.00 cm; Páginas: 296')
                    ->type('editora','Companhia das Letras')
                    ->type('assunto','literatura brasileira; romance; crítica social')
                    ->type('local_publicacao','São Paulo')
                    ->type('edicao','1ª edição')
                    ->type('ano','2009')
                    ->select('idioma','pt_BR')
                    ->type('isbn','978-85-359-1403-4')
                    ->typeSlowly('issn','---')
                    ->press('Salvar')
                    ->assertPathIs('/records')
                    ->pause(3000)

       
                  // Create Exemplar

                    ->clickLink('Cadastrar Exemplar')
                    ->pause(300)
                    ->typeSlowly('tombo','909090')
                    ->typeSlowly('localizacao','estante 3.v4')
                    ->pause(100)
                    ->press('Salvar')

                // Read Exemplar

                    ->visit('/records')
                    ->clickLink('Visualizar Material')
                    ->waitForLink('909090')
                    ->clickLink('909090')
                    ->assertSee('909090')
                    ->pause(400)
                    
                   // Update Exemplar
                    
                    ->visit('/records')
                    ->clickLink('Visualizar Material')
                    ->waitForLink('909090')
                    ->clickLink('909090')
                    ->clickLink('Editar Exemplar')
                    ->typeSlowly('tombo','12345678')
                    ->typeSlowly('localizacao','estante 3.v1')
                    ->press('Salvar')
                    ->pause(100)
             
                   // Delete Exemplar

                    ->visit('/records')
                    ->pause(3000)
                    ->press('Deletar exemplar')
                    ->acceptDialog()
                    ->pause(3000)
                    ->press('Excluir')
                    ->acceptDialog()
                    ->pause(3000)
                    ->assertSeeIn('.alert-warning', 'Registro deletado');
        });
    }
}