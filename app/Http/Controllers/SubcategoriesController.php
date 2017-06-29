<?php

namespace App\Http\Controllers;

use App\Order;
use App\Subcategory;
use Symfony\Component\HttpFoundation\Response;

class SubcategoriesController extends Controller
{
    public function getCategory ($id)
    {
        $resp = $this->defaultGetRelationResult(Subcategory::class, $id, 'category');

        return response()->json($resp->getData(), $resp->getCode());
    }


    public function getProducts ($id, $productId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Subcategory::class, $id, Product::class, 'products', $productId);

        return response()->json($resp->getData(), $resp->getCode());
    }
}
