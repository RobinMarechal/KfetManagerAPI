<?php

namespace App;

use App\Custom\Model;

class OrderProduct extends Model
{

    protected $table = 'order_product';
    public $timestamps = false;
    protected $fillable = ['product_id', 'order_id', 'quantity'];


    public function order ()
    {
        return $this->belongsTo('App\Order');
    }


    public function product ()
    {
        return $this->belongsTo('App\Product');
    }


    public function scopeWithAll ($query)
    {
        return $query->with('order', 'product');
    }

}