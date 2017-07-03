<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\Product;
use App\Subcategory;
use function getRelatedModelClassName;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

/**
 * All the routes directly related to the categories table and its relations
 * @url .../api/categories/...
 */
class CategoriesController extends Controller
{
    public function getProducts ($id, $productId = null)
    {
        $cat = Category::with(['subcategories.products' => function ($query) {
            $this->request->applyUrlParams($query, Product::class);
        }])
                       ->find($id);

        if (!isset($cat)) {
            return null;
        }

        $subs = $cat->subcategories;

        $coll = new Collection();

        foreach ($subs as $s) {
            $prods = $s->products;

            foreach ($prods as $prod) {
                if ($this->request->has('with')) {
                    $prod->load(explode(',', $this->request->get('with')));
                }
                $coll->add($prod);
            }
        }

        if ($productId != null) {
            $res = $coll->where('id', $productId)
                        ->first();
        }
        else {
            $res = $coll;
        }

        return \response()->json($res, Response::HTTP_OK);
    }
}
