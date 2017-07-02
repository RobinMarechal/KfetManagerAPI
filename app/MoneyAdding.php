<?php

namespace App;

use App\Custom\Model;

class MoneyAdding extends Model 
{

    protected $table = 'money_addings';
    public $timestamps = false;
    protected $fillable = array('date', 'amount', 'reason', 'description');
    public $temporalField = 'date';

    public function scopeWithAll($query)
    {
        // Nothing
    }

}