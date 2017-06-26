<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventProduct extends Model 
{

    protected $table = 'event_products';
    public $timestamps = false;
    protected $fillable = array('product_id', 'event_id', 'cost', 'price', 'quantity_sold', 'quantity_bought', 'name');

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}