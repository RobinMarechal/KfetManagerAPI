<?php
namespace Helpers;

class JsonResponse
{

    private $code;
    private $data;


    /**
     * HTTP code 200
     * @param null $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success ($data = null)
    {
        $obj = new self();
        $obj->code = 200;

        if(isset($data))
        {
            $obj->data = $data;
            return $obj->send();
        }

        return $obj;
    }


    /**
     * HTTP code 204
     * @param null $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function noContent ($data = null) 
    {
        $obj = new self();
        $obj->code = 204;

        if(isset($data))
        {
            $obj->data = $data;
            return $obj->send();
        }

        return $obj;
    }


    /**
     * HTTP code 201
     * @param null $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function created ($data = null) 
    {
        $obj = new self();
        $obj->code = 201;

        if(isset($data))
        {
            $obj->data = $data;
            return $obj->send();
        }

        return $obj;
    }


    /**
     * HTTP code 202
     * @param null $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function accepted ($data = null) 
    {
        $obj = new self();
        $obj->code = 202;

        if(isset($data))
        {
            $obj->data = $data;
            return $obj->send();
        }

        return $obj;
    }

    /**
     * HTTP code 403
     * @param null $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function forbidden ($data = null) 
    {
        $obj = new self();
        $obj->code = 403;

        if(isset($data))
        {
            $obj->data = $data;
            return $obj->send();
        }

        return $obj;
    }


    /**
     * HTTP code 404
     * @param null $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function notFound ($data = null) 
    {
        $obj = new self();
        $obj->code = 404;

        if(isset($data))
        {
            $obj->data = $data;
            return $obj->send();
        }

        return $obj;
    }


    public function setData ($data) 
    {
        $this->data = $data;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getCode ()
    {
        return $this->code;
    }


    /**
     * @return mixed
     */
    public function getData ()
    {
        return $this->data;
    }


    public function send ()
    {
        $json = [
            'code' => $this->code,
            'data' => $this->data,
        ];

        return response("", "".$this->code)->json($json);
    }
}