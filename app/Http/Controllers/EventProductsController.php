<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventProduct;

class EventProductsController extends Controller
{
    public function getEvent($id)
    {
        $resp = $this->defaultGetRelationResult(EventProduct::class, $id, 'event');

        return response()->json($resp->getData(), $resp->getCode());
    }


    public function getProduct($id)
    {
        $resp = $this->defaultGetRelationResult(EventProduct::class, $id, 'product');

        return response()->json($resp->getData(), $resp->getCode());
    }
}
