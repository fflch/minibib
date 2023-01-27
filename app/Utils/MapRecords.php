<?php

namespace App\Utils;

use App\Models\Record;

class MapRecords
{
    public static function map($chave){
        $mapeamento = [
            'id' => 'ID',
            'autores' => 'Autores',
            'titulo' => 'Título',
            'desc_fisica' => 'Descrição física',
            'editora' => 'Editora',
            'assunto' => 'Assunto',
            'local_publicacao' => 'Local de publicação',
            'edicao' => 'Edição',
            'ano' => 'Ano',
            'idioma' => 'Idioma',
            'isbn' => 'ISBN',
            'issn' => 'ISSN',
            'tipo' => 'Categoria',
        ];

        return $mapeamento[$chave];
    }
}