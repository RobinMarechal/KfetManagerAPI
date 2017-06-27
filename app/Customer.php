<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model 
{

    protected $table = 'customers';
    public $timestamps = false;
    protected $fillable = array('firstname', 'lastname', 'staff_id', 'balance');

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

}