<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restocking extends Model 
{

    protected $table = 'restockings';
    public $timestamps = false;
    protected $fillable = array('date', 'cost', 'description');

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

}