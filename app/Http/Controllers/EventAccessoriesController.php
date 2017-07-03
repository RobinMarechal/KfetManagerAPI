<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventAccessory;

class EventAccessoriesController extends Controller
{
    public function getEvent($id)
    {
        $resp = $this->defaultGetRelationResult(EventAccessory::class, $id, 'event');

        return response()->json($resp->getData(), $resp->getCode());
    }
}
