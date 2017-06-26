<?php

namespace App\Http\Controllers;

use App\Kfet;
use Carbon\Carbon;
use Helpers\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KfetController extends Controller
{
    public function getById ($id)
    {
        $obj = Kfet::find($id);

        return $obj;
    }


    public function getFromTo ($from, $to)
    {
        $fromArr = explode('-', $from);
        $toArr = explode('-', $to);

        $fromCarbon = Carbon::createFromDate($fromArr[0], $fromArr[1], $fromArr[2]);
        $toCarbon = Carbon::createFromDate($toArr[0], $toArr[1], $toArr[2]);

        $array = Kfet::whereBetween('created_at', [$fromCarbon, $toCarbon])->get();

        return $array;
    }


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
