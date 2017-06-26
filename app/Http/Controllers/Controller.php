<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $request;

    function __construct (UrlRequest $request)
    {
        $this->request = $request;
    }

    protected function getPreparedQuery($class)
    {
        return $this->request->getPreparedQuery($class);
    }

    protected function getRelationsQuery($class)
    {
        return $this->request->getRelationsQuery($class);
    }
}
