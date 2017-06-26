<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
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

    public function getOrders()
    {
        $orderProducts = OrderProduct::where('menu_id', $this->id)->with('order')->get();

        $coll = new Collection();

        foreach ($orderProducts as $o) {
            $coll->add($o->order);
        }

        return $coll->unique();
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }
}