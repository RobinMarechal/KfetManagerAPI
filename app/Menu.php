<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model 
{

    protected $table = 'menus';
    public $timestamps = false;
    protected $fillable = array('name', 'description', 'price');
    protected $hidden = ['pivot'];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order', 'order_product');
    }

}