<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model 
{

    protected $table = 'events';
    public $timestamps = false;
    protected $fillable = array('date', 'description');

    public function accessories()
    {
        return $this->hasMany('App\EventAccessory');
    }

    public function eventProducts()
    {
        return $this->hasMany('App\EventProduct');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

}