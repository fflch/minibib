<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Instance;
use App\Utils\Idioma;

class Record extends Model
{
    protected $guarded = ['id'];

    public function tipoOptions(){
        return [
            'Livro',
            'Panfleto',
            'Tese',
            'Periódico',
            'Artigo de Periódico',
            'Manuscrito',
            'Iconográfico',
            'Audiovisual',
            'Música (Som)',
            'Partitura'
        ];
    }

    public function idiomasOptions(){
        return Idioma::lista();
    }

    public function instances(){
        return $this->hasMany('App\Instance');
    }

}
