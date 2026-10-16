<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class CrudTest extends DuskTestCase
{
    //use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    //php artisan dusk:chrome-driver --detect-chromedriver
    public function testCrudMinibib()
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

                    // Record update

                    ->visit('/records')
                    ->pause(2000)
                    ->clicklink('Editar')
                    ->select('tipo','Livro')
                    ->assertSee('Edição de Cadastro')
                    ->clear('autores')
                    ->typeSlowly('autores','Jorge Amado')
                    ->clear('titulo')
                    ->typeSlowly('titulo','Gabriela, Cravo e Canela')
                    ->clear('desc_fisica')
                    ->typeSlowly('desc_fisica','Formato: 21x16x2 cm; Páginas: 336')
                    ->clear('editora')
                    ->type('editora','Companhia das Letras')
                    ->clear('assunto')
                    ->type('assunto','Literatura brasileira; romance; cultura baiana')
                    ->clear('local_publicacao')
                    ->type('local_publicacao','São Paulo')
                    ->clear('edicao')
                    ->type('edicao','1ª edição')
                    ->clear('ano')
                    ->typeSlowly('ano','2008')
                    ->select('idioma','pt_BR')
                    ->clear('isbn')
                    ->typeSlowly('isbn','978-85-359-1227-6')
                    ->clear('issn')
                    ->typeSlowly('issn','---')
                    ->pause(1000)
                    ->press('Salvar')
                    ->pause(300)
       
                  //Exemplar Test Create

                    ->clickLink('Cadastrar Exemplar')
                    ->pause(300)
                    ->typeSlowly('tombo','909090')
                    ->typeSlowly('localizacao','estante 3.v4')
                    ->pause(100)
                    ->press('Salvar')
                    
                   // Exemplar Test update
                    
                    ->visit('/records')
                    ->clickLink('Visualizar Material')
                    ->waitForLink('909090')
                    ->clickLink('909090')
                    ->clickLink('Editar Exemplar')
                    ->typeSlowly('tombo','12345678')
                    ->typeSlowly('localizacao','estante 3.v1')
                    ->press('Salvar')
                    ->pause(100)
                    ->visit('/records')
                    ->clickLink('Emprestar')
                    ->pause(100)
                    ->waitForText('Número USP')
                    ->typeSlowly("n_usp","16829032")
                    ->press('Confirmar Empréstimo')
                    ->pause(100)
                    ->visit('/emprestimos')
                    ->pause(100)
                    ->assertSee('Emprestados')
                    ->clickLink('Devolver')
                    ->pause(1000)
                    ->press('Confirmar Devolução de Material')
                    ->pause(1000)
                    ->visit('/records')
                
                    
                 //delete record

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