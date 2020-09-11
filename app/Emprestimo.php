<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $guarded = ['id'];

    public function emprestado()
    {
        return $this->belongsTo(Instance::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(User::class);
    } 

    /* public function emprestado(){
        return $this->hasOneThrough( 
            Instance::class,
            User::class, 
            'instance_id',
            'user_id');
    }        */

    public function getDataEmprestimoAttribute($value) {
        return implode('/',array_reverse(explode('-',$value)));
    }

    public function setDataEmprestimoAttribute($value) {
       $this->attributes['data_emprestimo'] = implode('-',array_reverse(explode('/',$value)));
    }

    public function getDataDevolucaoAttribute($value) {
        return implode('/',array_reverse(explode('-',$value)));
    }

    public function setDataDevolucaoAttribute($value) {
       $this->attributes['data_devolucao'] = implode('-',array_reverse(explode('/',$value)));
    }
}