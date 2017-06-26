<?php

namespace App\Http\Controllers;

use App\Menu;

class MenusController extends Controller
{
    public function all ()
    {
        // TODO
    }


    public function post ()
    {
        // TODO
    }


    public function getById ($id)
    {
        $withOrder = false;

        $menu = Menu::where('id', $id);

        if ($this->request->has("with")) {
            $withArr = explode(",", $this->request->get("with"));
            $withArr = array_filter($withArr, function ($v) {
                return $v != "orders";
            });

            $withOrder = str_contains($this->request->get('with'), 'orders');

            $menu = $menu->with($withArr);
        }

        $menu = $menu->first();
        $array = $menu->toArray();

        if ($withOrder === true) {
            $array['orders'] = $menu->getOrders();
        }

        return response()->json($array);
    }


    public function put ($id)
    {
        // TODO
    }


    public function delete ($id)
    {
        // TODO
    }


    public function getCategories ($id)
    {
        // TODO
    }


    public function getOrders ($id)
    {
        // TODO
    }
}
