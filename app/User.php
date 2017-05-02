<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\City;
use App\Message;
use App\Destinatario;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        //Descomentar primera linea para caso definitivo
        'name','lastname', 'email', 'password', 'username','birthday','adress'
        //'name','lastname','email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
