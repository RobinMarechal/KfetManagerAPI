<?php

namespace App;

use App\Custom\Model;

class Customer extends Model 
{

    protected $table = 'customers';
    public $timestamps = false;
    protected $fillable = array('firstname', 'lastname', 'staff_id', 'balance');

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }


    public function menus ()
    {
        return $this->belongsToMany('App\Menu', 'orders')->withPivot('id')->withTimestamps();
    }
}