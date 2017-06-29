<?php

namespace App;

use App\Custom\Model;

class Purchase extends Model 
{

    protected $table = 'purchases';
    public $timestamps = false;
    protected $fillable = array('cost', 'quantity', 'date', 'description');
    public $temporalField = 'date';

}