<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('customer_id', 'timestamps');
    protected $hidden = ['pivot'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function orderProducts()
    {
        return $this->hasOne('App\OrderProduct');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Menu', 'order_product');
    }

}