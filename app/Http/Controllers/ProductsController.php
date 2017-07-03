<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\Order;
use App\Product;
use App\Restocking;
use function explode;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    public function getCategory ($id)
    {
        $resp = $this->defaultGetRelationResult(Product::class, $id, 'subcategory.category');

        return \response()->json($resp->getData(), $resp->getCode());
    }
}
