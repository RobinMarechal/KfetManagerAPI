<?php

namespace App;

use App\Custom\Model;

class OrderProduct extends Model 
{

    protected $table = 'order_product';
    public $timestamps = false;
    protected $fillable = array('product_id', 'order_id', 'quantity');

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}