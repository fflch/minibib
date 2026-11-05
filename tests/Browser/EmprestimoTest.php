<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EmprestimoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_emprestimo(): void
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
       
                  //Exemplar Test Create

                    ->clickLink('Cadastrar Exemplar')
                    ->pause(300)
                    ->typeSlowly('tombo','909090')
                    ->typeSlowly('localizacao','estante 3.v4')
                    ->pause(100)
                    ->press('Salvar')

                    // Exemplar emprestimo

                    ->visit('/records')
                    ->clickLink('Emprestar')
                    ->pause(100)
                    ->waitForText('Número USP')
                    ->typeSlowly("n_usp","16829032")
                    ->press('Confirmar Empréstimo')
                    ->pause(100)

                    // Exemplar devolução

                    ->visit('/emprestimos')
                    ->pause(100)
                    ->assertSee('Emprestados')
                    ->clickLink('Devolver')
                    ->pause(1000)
                    ->press('Confirmar Devolução de Material')
                    ->pause(1000)
                    ->visit('/records')

                    // Exemplar delete

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
