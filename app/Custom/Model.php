<?php

namespace App\Custom;

use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    public $temporalField = null;


    /**
     * @return the temporal field
     */
    public function getTemporalField ()
    {
        return $this->temporalField;
    }

    public abstract function scopeWithAll($query);
}