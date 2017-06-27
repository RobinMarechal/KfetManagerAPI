<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    //    public function search ()
    //    {
    //        $field = $this->request->get('field');
    //        $value = $this->request->get('value');
    //
    //        if ($field != "id") {
    //            $cats = Category::where($field, "LIKE", "%" . $value . "%")->get();
    //        }
    //        else {
    //            $cats = Category::find($value);
    //        }
    //
    //        return \response()->json($cats, Response::HTTP_OK);
    //    }


    public function getMenus ($id)
    {
        $menus = Category::with('menus', 'menus.orderProducts.order')->find($id)->menus;

        $arrRes = [];

        foreach ($menus as $m) {
            $orderProds = $m->orderProducts;

            $orders = new Collection();
            foreach ($orderProds as $o) {
                $orders->add($o['order']);
            }

            $orders = $orders->unique();

            $arr = $m->toArray();
            unset($arr['order_products']);
            $arr['orders'] = $orders;

            $arrRes[] = $arr;
        }

        return $arrRes;
    }


    public function getSubcategories ($id)
    {
        $coll = $this->request->getPreparedQuery(Subcategory::class)->where('category_id', $id)->get();

        return $coll;
    }


    public function getProducts ($id)
    {
        $cat = Category::with(['subcategories.products' => function ($query) {
            $this->request->computeUrlParams($query);
        }])->find($id);

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

        $products = $coll;

        return $products;
    }
}
