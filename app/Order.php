<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
	protected $table = 'orders';

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
        'provider_id','user_id','status','letter','provider_name','provider_cuit','provider_address','subtotal','discount','taxes','total','company_id'
    ];
}
