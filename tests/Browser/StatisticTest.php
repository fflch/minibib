<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StatisticTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_statistics(): void
    {
        $this->browse(function (Browser $browser) {
                //login do usuário
                    $browser->visit('/')
                    ->clickLink('Entrar')
                    ->waitForText('Usuário')
                    ->type('#loginUsuario', '11111')
                    ->press('Login')
                    ->AssertSee('Sair')

                //Criando Records e exemplares para testar a geração de excel

                    ->visit('/records/create')
                    ->select('tipo','Livro')
                    ->type('autores','Socorro Acioli')
                    ->type('titulo','A cabeça do Santo')
                    ->type('desc_fisica','Formato: 14.00x21.00 cm; Páginas: 296')
                    ->type('editora','Companhia das Letras')
                    ->type('assunto','literatura brasileira; romance; crítica social')
                    ->type('local_publicacao','São Paulo')
                    ->type('edicao','1ª edição')
                    ->type('ano','2009')
                    ->select('idioma','pt_BR')
                    ->type('isbn','978-85-359-1403-4')
                    ->type('issn','---')
                    ->press('Salvar')
                    ->pause(3000)
                    ->visit('/records')
                   
                    ->clickLink('Cadastrar Exemplar')
                    ->pause(300)
                    ->type('tombo','909090')
                    ->type('localizacao','estante 3.v4')
                    ->pause(100)
                    ->press('Salvar')


                    ->visit('/records/create')
                    ->select('tipo','Livro')
                    ->type('autores','Itamar Vieira Junior')
                    ->type('titulo','Torto Arado')
                    ->type('desc_fisica','Formato: 14.00x21.00 cm; Páginas: 296')
                    ->type('editora','Editora Todavia')
                    ->type('assunto','literatura brasileira; romance; crítica social')
                    ->type('local_publicacao','São Paulo')
                    ->type('edicao','1ª edição')
                    ->type('ano','2009')
                    ->select('idioma','pt_BR')
                    ->type('isbn','978-85-359-1403-4')
                    ->type('issn','---')
                    ->press('Salvar')
                    ->pause(3000)

                    ->clickLink('Cadastrar Exemplar')
                    ->pause(300)
                    ->type('tombo','101010')
                    ->type('localizacao','estante 4.v4')
                    ->pause(100)
                    ->press('Salvar')
                    ->pause(1000)
                 

                // verificar a geração de excel de materiais

                    ->visit('/statistics') 
                    ->clickLink('Exportar Materiais')
                    ->pause(1000);
                    $response = $this->get('/statistics/excel/materiais');
                    $response->assertStatus(200);
                    $response->assertHeader('content-disposition', 'attachment; filename="Materiais: .xlsx"');
               
                 // verifica a geração de excel de exemplares

                    $browser->visit('statistics/excel/exemplares');
                    $response = $this->get('/statistics/excel/exemplares');
                    $response->assertStatus(200);
                    $response->assertHeader('content-disposition', 'attachment; filename="Exemplares: .xlsx"');
                
                 // verifica a geração de excel dos materiais completos

                    $browser->visit('statistics/excel/materiais_completos');
                    $response = $this->get('/statistics/excel/materiais_completos');
                    $response->assertStatus(200);
                    $response->assertHeader('content-disposition', 'attachment; filename="Materiais_Completos:  .xlsx"');
                    $browser->pause(1000);

        });
    }
}

