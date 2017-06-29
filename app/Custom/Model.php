<?php

namespace App\Custom;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    public $temporalField = null;


    /**
     * @return the temporal field
     */
    public function getTemporalField ()
    {
        return $this->temporalField;
    }
}