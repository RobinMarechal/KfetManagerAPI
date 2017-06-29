<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use Symfony\Component\HttpFoundation\Response;

class CustomersController extends Controller
{
    public function getStaff ($id)
    {
        $resp = $this->defaultGetRelationResult(Customer::class, $id, 'staff');

        return response()->json($resp->getData(), $resp->getCode());
    }


    public function lastOrder ($id)
    {
        $orders = $this->request->getPreparedQuery(Order::class)
                                ->where('customer_id', $id)
                                ->orderBy('created_at', 'DESC')
                                ->first();

        return response()->json($orders, Response::HTTP_OK);
    }


    public function getOrders ($id, $orderId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Customer::class, $id, Order::class, 'orders', $orderId);

        return response()->json($resp->getData(), $resp->getCode());
    }
}
