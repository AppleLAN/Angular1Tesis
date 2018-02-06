<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

	protected $table = 'sales';

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
        'client_id','user_id','type','letter','client_name','client_cuit','client_address','pos','notes', 'number', 'discount','sale', 'payments', 'subtotal','taxes','total','perceptions', 'response', 'warehouse_id', 'date'
    ];
}
