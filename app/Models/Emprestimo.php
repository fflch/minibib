<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instance;

class Emprestimo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function getDataEmprestimoAttribute($value) {
        return implode('/',array_reverse(explode('-',$value)));
    }

    public function setDataInicialAttribute($value) {
       $this->attributes['data_emprestimo'] = implode('-',array_reverse(explode('/',$value)));
    }

    public function getDataDevolucaoAttribute($value) {
        return implode('/',array_reverse(explode('-',$value)));
    }

    public function setDataDevolucaoAttribute($value) {
       $this->attributes['data_devolucao'] = implode('-',array_reverse(explode('/',$value)));
    }
}
