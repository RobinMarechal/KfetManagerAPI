<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Http\Request;

class UrlRequest extends Request
{
    public $post = [];


    public function __construct (array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->post = $this->json()->all();
    }


    public function post ($key)
    {
        return $this->post[ $key ];
    }


    public function getPreparedQuery ($class)
    {
        $query = $this->getRelationsQuery($class);

        if ($this->has("limit")) {
            $query = $query->take($this->get("limit"));
        }

        if ($this->has("offset")) {
            $query = $query->skip($this->get("offset"));
        }

        if ($this->has("orderby")) {
            if ($this->has("order")) {
                $query = $query->orderBy($this->get("orderby"), $this->get("order"));
            }
            else {
                $query = $query->orderBy($this->get("orderby"));
            }
        }

        $modelClassName = '\\' . $class;
        $temporalField = (new $modelClassName())->temporalField;

        if (isset($temporalField) && $temporalField != null) {
            $from = $this->has("()from") ? Carbon::parse($this->get("from")) : null;
            $to = $this->has("to") ? Carbon::parse($this->get("to")) : null;

            if (isset($from) && isset($to)) {
                $query = $query->whereBetween($temporalField, [$from, $to]);
            }
            else if ($this->has("from")) {
                $query = $query->where($temporalField, '>=', $from);
            }
            else if ($this->has("to")) {
                $query = $query->where($temporalField, '<=', $to);
            }
        }

        return $query;
    }


    public function getRelationsQuery ($class)
    {
        $query = $class::query();

        if ($this->has("with")) {
            $withArr = explode(",", $this->get('with'));
            $query->with($withArr);
        }

        return $query;
    }


    public function applyUrlParams (&$query, $class)
    {
        if ($this->has("with")) {
            $withArr = explode(",", $this->get('with'));
            $query->with($withArr);
        }

        if ($this->has("limit")) {
            $query = $query->take($this->get("limit"));
        }

        if ($this->has("offset")) {
            $query = $query->skip($this->get("offset"));
        }

        if ($this->has("orderby")) {
            if ($this->has("order")) {
                $query = $query->orderBy($this->get("orderby"), $this->get("order"));
            }
            else {
                $query = $query->orderBy($this->get("orderby"));
            }
        }

        $modelClassName = '\\' . $class;
        $temporalField = (new $modelClassName())->temporalField;

        if (isset($temporalField) && $temporalField != null) {
            $from = $this->has("from") ? Carbon::parse($this->get("from")) : null;
            $to = $this->has("to") ? Carbon::parse($this->get("to")) : null;

            if (isset($from) && isset($to)) {
                $query = $query->whereBetween($temporalField, [$from, $to]);
            }
            else if ($this->has("from")) {
                $query = $query->where($temporalField, '>=', $from);
            }
            else if ($this->has("to")) {
                $query = $query->where($temporalField, '<=', $to);
            }
        }
    }


    public function userWantsAll ()
    {
        return $this->has("all") && $this->get("all") == "true";
    }
}
