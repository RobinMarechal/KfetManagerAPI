<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventAccessory;
use App\EventProduct;
use App\Product;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    public function getAccessories ($id, $accessoryId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Event::class, $id, EventAccessory::class, 'accessories', $accessoryId);

        return response()->json($resp->getData(), $resp->getCode());
    }


    public function getProducts ($id, $productId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Event::class, $id, Product::class, 'products', $productId);

        return response()->json($resp->getData(), $resp->getCode());
    }


    public function getEventProducts ($id, $eventProductId = null)
    {
        $resp = $this->defaultGetRelationResultOfId(Event::class, $id, EventProduct::class, 'eventProducts', $eventProductId);

        return response()->json($resp->getData(), $resp->getCode());
    }
}
