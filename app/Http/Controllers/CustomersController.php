<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Menu;
use App\Order;
use Symfony\Component\HttpFoundation\Response;

class CustomersController extends Controller
{
    public function lastOrder ($id)
    {
        $orders = $this->request->getPreparedQuery(Order::class)
                                ->where('customer_id', $id)
                                ->orderBy('created_at', 'DESC')
                                ->first();

        return response()->json($orders, Response::HTTP_OK);
    }
}
