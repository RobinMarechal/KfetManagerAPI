<?php

namespace App\Http\Controllers;

use App\Kfet;
use Carbon\Carbon;
use Helpers\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KfetController extends Controller
{
    public function getLast ()
    {
        $obj = Kfet::orderBy('id', 'DESC')->first();

        return $obj;
    }


    public function getFirst ()
    {
        $obj = Kfet::orderBy('id', 'asc')->first();

        return $obj;
    }
}
