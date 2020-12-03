<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;
use App\Models\Emprestimo;

class Instance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function record(){
        return $this->belongsTo(Record::class);
    }  

    public function instances()
    {
        return $this->hasMany(Emprestimo::class);
    } 
}
