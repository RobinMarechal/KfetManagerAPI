<?php

namespace App;

use App\Custom\Model;

class ProductRestocking extends Model 
{

    protected $table = 'product_restocking';
    public $timestamps = false;
    protected $fillable = array('product_id', 'quantity', 'restocking_id');

    public function scopeWithAll($query)
    {
        // Nothing
    }

}