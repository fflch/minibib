<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Instance;
use App\Utils\Idioma;
use App\Utils\MapRecords;

class Record extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

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
        return $this->hasMany(Instance::class);
    }

    public function getIdiomaCompletoAttribute()
    {
        if(array_key_exists($this->idioma,Idioma::lista())){
            return Idioma::lista()[$this->idioma];
        }
        return 'Sem Idioma Cadastrado';
    }

    public function mapeamento($chave) {
        return MapRecords::map($chave);
    }
}
