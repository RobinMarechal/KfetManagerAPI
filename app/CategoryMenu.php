<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryMenu extends Model 
{

    protected $table = 'category_menu';
    public $timestamps = false;
    protected $fillable = array('menu_id', 'category_id');

}