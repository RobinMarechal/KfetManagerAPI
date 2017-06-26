<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kfet extends Model 
{

    protected $table = 'kfet';
    public $timestamps = true;
    protected $fillable = array('timestamps', 'balance', 'reason');

}