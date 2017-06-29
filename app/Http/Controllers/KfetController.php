<?php

namespace App\Http\Controllers;

use App\Kfet;
use Symfony\Component\HttpFoundation\Response;

class KfetController extends Controller
{
    public function getLast ()
    {
        $obj = Kfet::orderBy('id', 'DESC')->first();

        return \response()->json($obj, Response::HTTP_OK);
    }


    public function getFirst ()
    {
        $obj = Kfet::orderBy('id', 'asc')->first();

        return \response()->json($obj, Response::HTTP_OK);
    }
}
