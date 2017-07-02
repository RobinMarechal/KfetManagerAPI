<?php

namespace App;

use App\Custom\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    public $timestamps = false;
    protected $fillable = ['cost', 'quantity', 'date', 'description'];
    public $temporalField = 'date';


    public function scopeWithAll ($query)
    {
        // Nothing
    }

}