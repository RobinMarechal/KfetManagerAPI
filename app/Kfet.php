<?php

namespace App;

use App\Custom\Model;

class Kfet extends Model
{
    protected $table = 'kfet';
    public $timestamps = true;
    protected $fillable = ['timestamps', 'balance', 'reason_id', 'reason_table', 'reason_type'];
    public $temporalField = 'created_at';


    public function scopeWithAll ($query)
    {
        // Nothgin
    }

}