<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Record;
use App\Models\Emprestimo;
use App\Utils\MapInstances;
use Illuminate\Support\Facades\Schema;

class Instance extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = ['id'];

    //tombo e localizacao das instances (é chamado no model Record)
    public static function camposDasInstances(){
        $instances = Schema::getColumnListing('instances');
        $instancesCampos = array_slice($instances, 4);
        return $instancesCampos;
    }

    //titulo do records com tombo e localizacao das instances
    public static function camposExemplares(){
        $records = Schema::getColumnListing('records');
        $titulo = array_filter($records, function($value){
            return $value === 'titulo';
        });
        $camposExemplares = array_merge($titulo, Instance::camposDasInstances());
        return $camposExemplares;
    }
    
    public function record(){
        return $this->belongsTo(Record::class);
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function mapeamento($chave) {
        return MapInstances::map($chave);
    }
}
