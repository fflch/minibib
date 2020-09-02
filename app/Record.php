<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function instances(){
        return $this->hasMany('App\Instance');
    }

}
