<?php

namespace App;

use App\Custom\Model;

class Menu extends Model 
{

    protected $table = 'menus';
    public $timestamps = false;
    protected $fillable = array('name', 'description', 'price');

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}