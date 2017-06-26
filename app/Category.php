<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = array('name');
    protected $hidden = ['pivot'];

    public function subcategories()
    {
        return $this->hasMany('App\Subcategory');
    }

    public function products()
    {
        return $this->hasManyThrough('App\Product', 'App\Subcategory');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Menu');
    }

}