<?php


namespace App\Helpers;


/**
 * ApiResponse serves as a response wrapper to guarantee a consistence Api response
 * @version v1.5
 * use case
 * $result = ApiResponse::make(true, 'Pending', ['some data']);
 * or Simply
 * $result = ApiResponse::trueData($user)
 * e.g
 * if($result->getStatus())
 *      echo 'Working...';
 *  else
 *      echo $result->getMessage();
 * @author Samson Oyetola <hello@samsonoyetola.com>
 */
class ApiResponse{
    public $status = false;
    public $message = "";
    public $data = "";

    public function __construct($status = true, $message="", $data="")
    {
        $this->status   = (bool) $status;
        $this->message  = $message;
        $this->data     = $data;
    }

    static function make($status = true, $message = "", $data = null )
    {
        return new self($status, $message, $data);
    }

    static function data($data = null)
    {
        return static::make(!!$data, null, $data);
    }

    static function trueData($data = null, $message = "success")
    {
        return new self(true, $message, $data);
    }

    static function falseMessage($message = '')
    {
        return new self(false, $message, null);
    }

    static function trueMessage($message = '')
    {
        return new self(true, $message, null);
    }


    public function toArray()
    {
        return [ 'status' => $this->status, 'message' => $this->message, 'data' => $this->data];
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getMessage()
    {
        return $this->message;
    }

    function getData()
    {
        return $this->data;
    }
}
