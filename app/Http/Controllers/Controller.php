<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use Carbon\Carbon;
use Helpers\ResponseData;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\Response;
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


    /*
     * ------------------------------------------------------------------
     * ------------------------------------------------------------------
     */

    public function defaultAll ($class)
    {
        $all = $this->getPreparedQuery($class)->get();

        return new ResponseData($all, Response::HTTP_OK);
    }


    public function defaultGetById ($class, $id)
    {
        $res = $this->getPreparedQuery($class)->find($id);

        return new ResponseData($res, Response::HTTP_OK);
    }


    public function defaultPut ($class, $id)
    {
        $cat = $class::find($id);

        if ($cat == null) {
            return new ResponseData(null, Response::HTTP_BAD_REQUEST);
        }

        $cat->update($this->request->all());

        $res = $cat;

        if ($this->request->userWantsAll()) {
            $res = $this->all();
        }

        return new ResponseData($res, Response::HTTP_OK);
    }


    public function defaultDelete ($class, $id)
    {
        $cat = $class::find($id);

        if ($cat == null) {
            return new ResponseData(null, Response::HTTP_BAD_REQUEST);
        }

        $cat->delete();

        $res = $cat;

        if ($this->request->userWantsAll()) {
            $res = $this->all();
        }

        return new ResponseData($res, Response::HTTP_OK);
    }


    public function defaultPost ($class)
    {
        $cat = $class::create($this->request->post);

        $res = $cat;

        if ($this->request->userWantsAll()) {
            $res = $this->all();
        }

        return new ResponseData($res, Response::HTTP_CREATED);
    }


    public function defaultGetFromTo ($class, $from, $to, $field = "created_at")
    {
        $fromCarbon = Carbon::parse($from);
        $toCarbon = Carbon::parse($to);


        $array = $this->request->getPreparedQuery($class)->whereBetween($field, [$fromCarbon, $toCarbon])->get();

        return new ResponseData($array, Response::HTTP_OK);
    }


    public function defaultGetRelationResult ($class, $id, $relationName)
    {
        $model = $class::with([$relationName => function ($query) use ($class) {
            $this->request->applyUrlParams($query, $class);
        }])->find($id);

        if (!isset($model)) {
            return new ResponseData(null, Response::HTTP_NOT_FOUND);
        }

        return new ResponseData($model->$relationName, Response::HTTP_OK);
    }


    public function defaultGetRelationResultOfId ($class, $id, $relationClass, $relationName, $relationId = null)
    {
        if ($relationId == null) {
            return $this->defaultGetRelationResult($class, $id, $relationName);
        }

        $tmp = $class::with([$relationName => function ($query) use ($relationId, $relationClass) {
            $this->request->applyUrlParams($query, $relationClass);
        }])->where((new $class())->getTable() . '.id', $id)->first();


        if (!isset($tmp)) {
            return new ResponseData(null, Response::HTTP_NOT_FOUND);
        }

        return new ResponseData($tmp->$relationName->where('id', "=", $relationId)->first(), Response::HTTP_OK);
    }


    // ---

    public function all ()
    {
        $class = getRelatedModelClassName($this);
        $resp = $this->defaultAll($class);

        return \response()->json($resp->getData(), $resp->getCode());
    }


    public function getById ($id)
    {
        $class = getRelatedModelClassName($this);
        $resp = $this->defaultGetById($class, $id);

        return \response()->json($resp->getData(), $resp->getCode());
    }


    public function getFromTo ($from, $to)
    {
        $class = getRelatedModelClassName($this);
        $resp = $this->defaultGetFromTo($class, $from, $to);

        return \response()->json($resp->getData(), $resp->getCode());
    }


    public function put ($id)
    {
        $class = getRelatedModelClassName($this);
        $resp = $this->defaultPut($class, $id);

        return \response()->json($resp->getData(), $resp->getCode());
    }


    public function delete ($id)
    {
        $class = getRelatedModelClassName($this);
        $resp = $this->defaultDelete($class, $id);

        return \response()->json($resp->getData(), $resp->getCode());
    }


    public function post ()
    {
        $class = getRelatedModelClassName($this);
        $resp = $this->defaultPost($class);

        return \response()->json($resp->getData(), $resp->getCode());
    }


}
