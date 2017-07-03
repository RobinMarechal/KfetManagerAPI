<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use function array_last;
use function camel_case;
use Carbon\Carbon;
use function count;
use function explode;
use function getRelatedModelClassName;
use Helpers\ResponseData;
use Illuminate\Foundation\Bus\DispatchesJobs;
use function is_array;
use function is_null;
use function is_numeric;
use function str_singular;
use function strlen;
use function strpos;
use function strtolower;
use function strtoupper;
use function substr;
use Symfony\Component\Debug\Exception\UndefinedFunctionException;
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
        $all = $this->getPreparedQuery($class)
                    ->get();

        return new ResponseData($all, Response::HTTP_OK);
    }


    public function defaultGetById ($class, $id)
    {
        $res = $this->getPreparedQuery($class)
                    ->find($id);

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


        $array = $this->request->getPreparedQuery($class)
                               ->whereBetween($field, [$fromCarbon, $toCarbon])
                               ->get();

        return new ResponseData($array, Response::HTTP_OK);
    }


    /**
     * @param $class        string the model (usually associated with the current controller) class name
     * @param $id           int the id of the resource
     * @param $relationName string the relation name. This can be chained relations, separated with '.' character.
     *
     * @warning if chained relations, all of these (but the last) have to be BelongsTo relations (singular relations),
     *          otherwise this will fail
     * @return ResponseData the couple (json, Http code)
     */
    public function defaultGetRelationResult ($class, $id, $relationName)
    {
        $model = $class::with([$relationName => function ($query) use ($class) {
            $this->request->applyUrlParams($query, $class);
        }])
                       ->find($id);

        if (!isset($model)) {
            return new ResponseData(null, Response::HTTP_NOT_FOUND);
        }

        $res = $model;
        $rels = explode('.', $relationName);
        foreach ($rels as $r) {
            $res = $res->$r;
        }

        return new ResponseData($res, Response::HTTP_OK);
    }


    public function defaultGetRelationResultOfId ($class, $id, $relationClass, $relationName, $relationId = null)
    {
        if ($relationId == null) {
            return $this->defaultGetRelationResult($class, $id, $relationName);
        }


        $tmp = $class::with([$relationName => function ($query) use ($relationId, $relationClass) {
            $this->request->applyUrlParams($query, $relationClass);
        }])
                     ->where((new $class())->getTable() . '.id', $id)
                     ->first();


        if (!isset($tmp)) {
            return new ResponseData(null, Response::HTTP_NOT_FOUND);
        }

        $res = $tmp;
        $rels = explode('.', $relationName);
        foreach ($rels as $r) {
            $res = $res->$r;
        }

        $res = $res->where('id', "=", $relationId)
                   ->first();

        return new ResponseData($res, Response::HTTP_OK);
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


//    public function relations ($id, $params, $relatedId = null)
//    {
//        $relations = explode('/', $params);
//
//        $modelClassName = getRelatedModelClassName($this);
//        $relatedModel = str_singular(array_last($relations));
//        $relatedModel = 'App\\'.strtoupper(substr($relatedModel, 0, 1)) . substr($relatedModel, 1);
//        $relationStr = join('.', $relations);
//
//        $resp = $this->defaultGetRelationResultOfId($modelClassName, $id, $relatedModel, $relationStr, $relatedId);
//
//        return $resp->getData();
//    }


    public function __call ($method, $parameters)
    {
        if (strpos($method, "get") == 0 && strlen($method) > 3 && is_array($parameters) && isset($parameters[0])) {
            $relation = camel_case(substr($method, 3));

            $relatedModelClassName = str_singular($relation);
            $relatedModelClassName = strtoupper(substr($relatedModelClassName, 0, 1)) . substr($relatedModelClassName, 1);

            $thisModelClassName = getRelatedModelClassName($this);

            $id = $parameters[0];
            $relatedId = null;
            if (isset($parameters[1])) {
                $relatedId = $parameters[1];
            }

            if (!is_numeric($id) || (isset($relatedId) && !is_numeric($relatedId))) {
                GOTO FUNCTION_NOT_FOUND;
            }

            // Ok
            $resp = $this->defaultGetRelationResultOfId($thisModelClassName, $id, $relatedModelClassName, $relation, $relatedId);

            return response()->json($resp->getData(), $resp->getCode());
        }

        FUNCTION_NOT_FOUND:
        throw new UndefinedFunctionException();
    }
}
