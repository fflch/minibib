<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function instances(){
        return $this->hasMany('App\Instance');
    }
}
