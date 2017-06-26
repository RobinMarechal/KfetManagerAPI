<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('customer_id', 'timestamps');

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function menus()
    {
        return $this->hasManyThrough('App\Menu', 'App\OrderProduct');
    }

    public function products()
    {
        return $this->hasManyThrough('App\Product', 'App\OrderProduct');
    }

}