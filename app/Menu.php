<?php

namespace App;

use App\Custom\Model;

class Menu extends Model
{

    protected $table = 'menus';
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'price'];


    public function categories ()
    {
        return $this->belongsToMany('App\Category')
                    ->withPivot('id');
    }


    public function orders ()
    {
        return $this->hasMany('App\Order');
    }


    public function customers ()
    {
        return $this->belongsToMany('App\Customer', 'orders')
                    ->withPivot('id')
                    ->withTimestamps();
    }


    public function scopeWithAll ($query)
    {
        return $query->with('customers', 'categories', 'orders');
    }

}