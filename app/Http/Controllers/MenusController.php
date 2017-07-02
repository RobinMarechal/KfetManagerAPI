<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Menu;
use Symfony\Component\HttpFoundation\Response;

class MenusController extends Controller
{
    public function getCategories ($id, $categoryId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Menu::class, $id, Category::class, 'categories', $categoryId);

        return response()->json($resp->getData(), $resp->getCode());
    }


    public function getOrders ($id, $orderId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Menu::class, $id, Order::class, 'orders', $orderId);

        return response()->json($resp->getData(), $resp->getCode());
    }

    public function getCustomers ($id, $customerId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Menu::class, $id, Customer::class, 'customers', $customerId);
        return response()->json($resp->getData(), $resp->getCode());
    }


}