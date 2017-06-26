<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function all()
    {
        $all = $this->getPreparedQuery(Order::class)->get();

        return $all;
    }
    

    public function post ()
    {
        // TODO
    }


    public function getById ($id)
    {
        // TODO
    }


    public function put ($id)
    {
        // TODO
    }


    public function delete ($id)
    {
        // TODO
    }


    public function getFromTo ($from, $to)
    {
        // TODO
    }
}
