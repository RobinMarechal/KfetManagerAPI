<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Product;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends Controller
{
    public function getCustomer ($id)
    {
        $resp = $this->defaultGetRelationResult(Order::class, $id, 'customer');
        return response()->json($resp->getData(), $resp->getCode());
    }

    public function getMenu ($id)
    {
        $resp = $this->defaultGetRelationResult(Order::class, $id, 'menu');
        return response()->json($resp->getData(), $resp->getCode());
    }

    public function getProducts ($id, $productId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Order::class, $id, Product::class, 'products', $productId);
        return response()->json($resp->getData(), $resp->getCode());
    }


    public function addOrderProduct ($id)
    {
        // TODO
        return response()->json(null, Response::HTTP_NOT_IMPLEMENTED);
    }

    public function getOrderProducts ($id, $orderProductId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Order::class, $id, OrderProduct::class, 'orderProducts', $orderProductId);
        return response()->json($resp->getData(), $resp->getCode());
    }


    
    
    
    


}
