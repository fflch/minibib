<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Instance;
use App\Utils\Idioma;
use App\Utils\MapRecords;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

    public static function camposMateriais(){
        $records = Schema::getColumnListing('records');
        $recordsCampos = array_slice($records, 3);

        return $recordsCampos;
    }

    public static function camposCompletos(){
        $recordCampos = Schema::getColumnListing('records'); //pega o as colunas/campos da DB
        $recordResto = array_slice($recordCampos, 3); //pula os 3 primeiros campos: id, created, updated

        $instancesCampos = Schema::getColumnListing('instances');
        $instancesResto = array_slice($instancesCampos, 4);

        $camposCompletos = array_merge($recordResto, $instancesResto); //junta os campos do records e instances
        return $camposCompletos;
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
