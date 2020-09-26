<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function record(){
        return $this->belongsTo('App\Record');
    }  

    public function instance()
    {
        return $this->hasOne(Emprestimo::class);
    } 
}
