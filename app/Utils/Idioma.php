<?php

namespace App\Utils;

use App\Models\Record;

class Idioma
{
    public static function lista(){
        return [
            'af' => 'Africâner',
            'am' => 'Amárico',
            'ar' => 'Árabe',
            'bg' => 'Búlgaro',
            'ca' => 'Catalão',
            'cs' => 'Tcheco',
            'da' => 'Dinamarquês',
            'de' => 'Alemão',
            'el' => 'Grego',
            'en' => 'Inglês',
            'es' => 'Espanhol',
            'fr' => 'Francês',
            'hi' => 'Híndi',
            'hu' => 'Húngaro',
            'id' => 'Indonésio',
            'it' => 'Italiano',
            'ja' => 'Japonês',
            'ko' => 'Coreano',
            'ms' => 'Malaio',
            'pt' => 'Português',
            'pt_BR' => 'Português do Brasil',
            'pt_PT' => 'Português Europeu',
            'ru' => 'Russo',
            'th' => 'Tailandês',
            'tl' => 'Tagalo',
            'vi' => 'Vietnamita',
            'zh' => 'Chinês',
        ];
    }
}