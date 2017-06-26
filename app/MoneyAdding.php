<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyAdding extends Model 
{

    protected $table = 'money_addings';
    public $timestamps = false;
    protected $fillable = array('date', 'amount', 'reason', 'description');

}