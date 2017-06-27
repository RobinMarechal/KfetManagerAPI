<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function getFromTo($from, $to)
    {
        return $this->defaultGetFromTo(Event::class, $from, $to, 'date');
    }
}
