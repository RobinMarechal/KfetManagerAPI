<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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