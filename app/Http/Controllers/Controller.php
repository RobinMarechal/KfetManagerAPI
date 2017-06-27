<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $request;


    function __construct (UrlRequest $request)
    {
        $this->request = $request;
    }


    protected function getPreparedQuery ($class)
    {
        return $this->request->getPreparedQuery($class);
    }


    protected function getRelationsQuery ($class)
    {
        return $this->request->getRelationsQuery($class);
    }


    /*
     * ------------------------------------------------------------------
     * ------------------------------------------------------------------
     */

    public function defaultAll ($class)
    {
        $all = $this->getPreparedQuery($class)->get();

        return $all;
    }


    public function defaultGetById ($class, $id)
    {
        $cat = $this->getRelationsQuery($class)->find($id);

        return $cat;
    }


    public function defaultPut ($class, $id)
    {
        $cat = $class::find($id);

        if ($cat == null) {
            return \response()->json(null, Response::HTTP_BAD_REQUEST);
        }

        $cat->update($this->request->all());

        $res = $cat;

        if ($this->request->userWantsAll()) {
            $res = $this->all();
        }

        return \response()->json($res, Response::HTTP_OK);
    }


    public function defaultDelete ($class, $id)
    {
        $cat = $class::find($id);

        if ($cat == null) {
            return \response()->json(null, Response::HTTP_BAD_REQUEST);
        }

        $cat->delete();

        $res = $cat;

        if ($this->request->userWantsAll()) {
            $res = $this->all();
        }

        return \response()->json($res, Response::HTTP_OK);
    }


    public function defaultPost ($class)
    {
        $cat = $class::create($this->request->post);

        $res = $cat;

        if ($this->request->userWantsAll()) {
            $res = $this->all();
        }

        return \response()->json($res, Response::HTTP_CREATED);
    }


    public function defaultGetFromTo ($class, $from, $to, $field = "created_at")
    {
        $fromCarbon = Carbon::parse($from);
        $toCarbon = Carbon::parse($to);

        $array = $class::whereBetween($field, [$fromCarbon, $toCarbon])->get();

        return $array;
    }


    // ---

    public function all ()
    {
        $class = getRelatedModelClassName($this);
        return $this->defaultAll($class);
    }


    public function getById ($id)
    {
        $class = getRelatedModelClassName($this);
        return $this->defaultGetById($class, $id);
    }


    public function getFromTo ($from, $to)
    {
        $class = getRelatedModelClassName($this);
        return $this->defaultGetFromTo($class, $from, $to);
    }


    public function put ($id)
    {
        $class = getRelatedModelClassName($this);
        return $this->defaultPut($class, $id);
    }


    public function delete ($id)
    {
        $class = getRelatedModelClassName($this);
        return $this->defaultDelete($class, $id);
    }


    public function post ()
    {
        $class = getRelatedModelClassName($this);
        return $this->defaultPost($class);
    }


}
