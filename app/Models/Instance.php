<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function record(){
        return $this->belongsTo(Record::class);
    }  

    public function instance()
    {
        return $this->hasOne(Emprestimo::class);
    } 
}
