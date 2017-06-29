<?php

namespace App;

use App\Custom\Model;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = array('name');

    public function subcategories()
    {
        return $this->hasMany('App\Subcategory');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Menu')->withPivot('id');
    }

}