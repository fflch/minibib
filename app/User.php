<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */ 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function statusOptions(){
        return [
            'Ativo',
            'Inativo'
        ];
    }

    public function funcionario()
    {
        return $this->hasMany(Emprestimo::class);
    }

    /** public function emprestado(){
        return $this->hasOneThrough( 
            Instance::class,
            Emprestimo::class, 
            'instance_id',
            'n_usp');
    } */
}
