<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','fantasyName', 'email', 'place', 'address','telephone','cuit','web','new','codigoPostal','iib','pib','epib','codigoProvincia','excento','responsableMonotributo','ivaInscripto','limiteDeCredito','numeroDeInscripcionesIB','cuentasGenerales','percepcionDeGanancia',
    ];
}
