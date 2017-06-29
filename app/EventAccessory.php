<?php

namespace App;

use App\Custom\Model;

class EventAccessory extends Model 
{

    protected $table = 'event_accessories';
    public $timestamps = false;
    protected $fillable = array('event_id', 'name', 'cost', 'quantity');

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

}