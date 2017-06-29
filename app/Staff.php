<?php

namespace App;

use App\Custom\Model;

class Staff extends Model 
{

    protected $table = 'staff';
    public $timestamps = false;
    protected $fillable = array('firstname', 'lastname', 'email', 'role');

    public function customer()
    {
        return $this->hasOne('App\Customer');
    }

}