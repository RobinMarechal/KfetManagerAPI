<?php

namespace App;

use App\Custom\Model;

class CategoryMenu extends Model 
{

    protected $table = 'category_menu';
    public $timestamps = false;
    protected $fillable = array('menu_id', 'category_id');

    public function scopeWithAll($query)
    {
        // Nothing
    }


    public function category ()
    {
        return $this->belongsTo('App\Category');
    }

    public function menu ()
    {
        return $this->belongsTo('App\Menu');
    }

}