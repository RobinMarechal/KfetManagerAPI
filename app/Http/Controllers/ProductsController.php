<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\Order;
use App\Product;
use App\Restocking;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    public function getOrders ($id, $orderId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Product::class, $id, Order::class, 'orders', $orderId);

        return response()->json($resp->getData(), $resp->getCode());
    }


    public function addOrderProducts ($id)
    {
        // TODO
        return response()->json(null, Response::HTTP_NOT_IMPLEMENTED);
    }


    public function getSubcategory ($id)
    {
        $resp = $this->defaultGetRelationResult(Product::class, $id, 'subcategory');

        return response()->json($resp->getData(), $resp->getCode());
    }


    public function getCategory ($id)
    {
        $product = Product::with(['subcategory.category' => function ($query) {
            $this->request->applyUrlParams($query, Category::class);
        }])
                          ->find($id);

        if (!isset($product) || $product == null) {
            return \response()->json(null, Response::HTTP_NOT_FOUND);
        }

        if (!isset($product->subcategory) || $product->subcategory == null) {
            return \response()->json(null, Response::HTTP_OK);
        }

        return \response()->json($product->subcategory->category, Response::HTTP_OK);
    }


    public function getMenus ($id, $menuId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Product::class, $id, Menu::class, 'menus', $menuId);

        return response()->json($resp->getData(), $resp->getCode());
    }


    public function getRestockings ($id, $restockingId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Product::class, $id, Restocking::class, 'restockings', $restockingId);

        return response()->json($resp->getData(), $resp->getCode());
    }

    public function getEvents($id, $eventId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Product::class, $id, Restocking::class, 'events', $eventId);
        
        return response()->json($resp->getData(), $resp->getCode());
    }


}
