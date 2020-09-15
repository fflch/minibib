<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $guarded = ['id'];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function instances(){
        return $this->hasMany('App\Instance');
    }
}
