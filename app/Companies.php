<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Companies extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','fantasyName', 'email', 'place', 'address','telephone','cuit','web','new','codigoPostal','iib','pib','epib','codigoProvincia','excento','responsableMonotributo','ivaInscripto','precioLista','condicionDeVenta','limiteDeCredito','numeroDeInscripcionesIB','cuentasGenerales','percepcionDeGanancia',
    ];

    /**
     * Get the product that the company has.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}