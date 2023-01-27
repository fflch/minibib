<?php

namespace App\Utils;

use App\Models\Instance;

class MapInstances
{
    public static function map($chave){
        $mapeamento = [
            'id' => 'ID',
            'record_id' => 'ID do material',
            'tombo' => 'Tombo',
            'localizacao' => 'Localização',
        ];

        return $mapeamento[$chave];
    }
}