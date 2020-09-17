<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    protected $guarded = ['id'];

    public function record(){
        return $this->belongsTo('App\Record');
    }  

    public function instance()
    {
        return $this->hasOne(Emprestimo::class);
    } 
}
