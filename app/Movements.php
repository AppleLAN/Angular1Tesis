<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movements extends Model
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
        'product_id','company_id','order_id','sale_id','quantity','type'
    ];


    // Luego iran relaciones con la venta o la orden de compra
}
