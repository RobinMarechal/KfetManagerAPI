<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model 
{

    protected $table = 'order_product';
    public $timestamps = false;
    protected $fillable = array('product_id', 'order_id', 'menu_id', 'quantity');

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}