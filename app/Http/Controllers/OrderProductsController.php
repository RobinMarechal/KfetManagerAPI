<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderProduct;

class OrderProductsController extends Controller
{
    public function getOrder($id)
    {
        $resp = $this->defaultGetRelationResult(OrderProduct::class, $id, 'order');

        return response()->json($resp->getData(), $resp->getCode());
    }

    public function getProduct($id)
    {
        $resp = $this->defaultGetRelationResult(OrderProduct::class, $id, 'product');

        return response()->json($resp->getData(), $resp->getCode());
    }
}
