<?php

namespace App;

use App\Custom\Model;

class Restocking extends Model 
{

    protected $table = 'restockings';
    public $timestamps = false;
    protected $fillable = array('date', 'cost', 'description');
    public $temporalField = 'date';

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot(['id', 'quantity']);
    }

}