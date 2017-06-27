<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = array('name', 'description', 'price', 'quantity', 'subcategory_id');
    protected $hidden = ['pivot'];

    public function restockings()
    {
        return $this->belongsToMany('App\Restocking');
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
        return $this->belongsToMany('App\Event');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

}