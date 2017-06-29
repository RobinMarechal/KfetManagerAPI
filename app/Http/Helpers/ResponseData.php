<?php
namespace Helpers;

class ResponseData
{

    private $code;
    private $data;


    /**
     * ResponseData constructor.
     *
     * @param $code
     * @param $data
     */
    public function __construct ($data, $code = 200)
    {
        $this->code = $code;
        $this->data = $data;
    }


    /**
     * @return mixed
     */
    public function getCode ()
    {
        return $this->code;
    }


    /**
     * @param mixed $code
     */
    public function setCode ($code)
    {
        $this->code = $code;
    }


    /**
     * @return mixed
     */
    public function getData ()
    {
        return $this->data;
    }


    /**
     * @param mixed $data
     */
    public function setData ($data)
    {
        $this->data = $data;
    }

}