<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'price', 'quantity', 'subcategory_id'];


    public function category ()
    {
        return $this->hasManyThrough('App\Category', 'App\Subcategory', 'category_id', 'id');
    }


    public function orders ()
    {
        return $this->hasManyThrough('App\Order', 'App\OrderProduct');
    }


    public function restockings ()
    {
        return $this->belongsToMany('App\Restocking');
    }


    public function events ()
    {
        return $this->hasManyThrough('App\Event', 'App\EventProduct');
    }


    public function subcategory ()
    {
        return $this->belongsTo('App\Subcategory');
    }


    public function eventProducts ()
    {
        return $this->hasMany('App\EventProduct');
    }


    public function orderProducts ()
    {
        return $this->hasMany('App\OrderProduct');
    }

}