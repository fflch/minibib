<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Instance;
use App\Utils\Idioma;
use App\Utils\MapRecords;
use Illuminate\Support\Facades\Schema;

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
            'Dissertação',
            'Periódico',
            'Artigo de Periódico',
            'Manuscrito',
            'Iconográfico',
            'Audiovisual',
            'Música (Som)',
            'Partitura'
        ];
    }

    public static function campos(){
        $recordCampos = Schema::getColumnListing('records'); //pega o as colunas/campos da DB
        $colunasRestantes = array_slice($recordCampos, 3); //pula os 3 primeiros campos: id, created, updated
        return $colunasRestantes;
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
<<<<<<< HEAD
=======
        return 'Sem Idioma Cadastrado';
>>>>>>> dd09408f5cd95a951443cc50829f89b330c2688c
    }

    public function mapeamento($chave) {
        return MapRecords::map($chave);
    }
}
