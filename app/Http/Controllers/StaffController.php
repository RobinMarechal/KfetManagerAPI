<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Staff;

class StaffController extends Controller
{
    public function getCustomer ($id)
    {
        $resp = $this->defaultGetRelationResult(Staff::class, $id, 'customer');

        return response()->json($resp->getData(), $resp->getCode());
    }
}
