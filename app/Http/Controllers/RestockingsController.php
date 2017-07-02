<?php

namespace App\Http\Controllers;

use App\Product;
use App\Restocking;
use Symfony\Component\HttpFoundation\Response;

class RestockingsController extends Controller
{
    public function getProducts ($id, $productId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Restocking::class, $id, Product::class, 'products', $productId);

        return response()->json($resp->getData(), $resp->getCode());
    }
}
