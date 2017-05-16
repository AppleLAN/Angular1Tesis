<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        //Descomentar primera linea para caso definitivo
        'name','fantasyName', 'email', 'place', 'address','telephone','cuit','web'
        //'name','lastname','email', 'password', 'username',
    ];
}
