<?php

namespace App;

use App\Custom\Model;

class EventProduct extends Model
{

    protected $table = 'event_products';
    public $timestamps = false;
    protected $fillable = ['product_id', 'event_id', 'cost', 'price', 'quantity_sold', 'quantity_bought', 'name'];


    public function event ()
    {
        return $this->belongsTo('App\Event');
    }


    public function product ()
    {
        return $this->belongsTo('App\Product');
    }


    public function scopeWithAll ($query)
    {
        return $query->with('event', 'product');
    }

}