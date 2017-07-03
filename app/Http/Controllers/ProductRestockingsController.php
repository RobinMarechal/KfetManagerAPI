<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductRestocking;

class ProductRestockingsController extends Controller
{
    public function getProduct($id)
    {
        $resp = $this->defaultGetRelationResult(ProductRestocking::class, $id, 'product');

        return response()->json($resp->getData(), $resp->getCode());
    }


    public function getRestocking($id)
    {
        $resp = $this->defaultGetRelationResult(ProductRestocking::class, $id, 'restocking');

        return response()->json($resp->getData(), $resp->getCode());
    }
}
