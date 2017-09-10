<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
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
        'company_id','name','code','description','cost_price','sale_price','category_id'
    ];


    /**
     * Get the category record associated with the company.
     */
    public function category()
    {
        return $this->hasOne('App\Categories');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function companies()
    {
        return $this->hasOne('App\Companies');
    }
}
