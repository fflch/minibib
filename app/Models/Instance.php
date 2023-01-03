<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Record;
use App\Models\Emprestimo;
use App\Utils\MapInstances;

class Instance extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = ['id'];

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
