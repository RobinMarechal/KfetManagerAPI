<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model 
{

    protected $table = 'purchases';
    public $timestamps = false;
    protected $fillable = array('cost', 'quantity', 'date', 'description');

}