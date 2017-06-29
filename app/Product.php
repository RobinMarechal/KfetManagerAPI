<?php

namespace App;

use App\Custom\Model;

class Product extends Model 
{

    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = array('name', 'description', 'price', 'quantity', 'subcategory_id');

    public function restockings()
    {
        return $this->belongsToMany('App\Restocking')->withPivot(['id', 'quantity']);
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    public function eventProducts()
    {
        return $this->hasMany('App\EventProduct');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function events()
    {
        return $this->belongsToMany('App\Event')->withPivot(['id', 'cost', 'price', 'quantity_sold', 'quantity_bought', 'name']);
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot(['id', 'quantity']);
    }

}