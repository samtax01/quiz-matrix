<?php

namespace App\Exceptions;

use App\Helpers\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiResponseException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function render($request)
    {
        return response()->json(ApiResponse::falseMessage($this->getMessage()), 400);
    }


    /**
     * Dump of log for debugging
     *
     * @param $data
     * @param false $prettify
     * @throws ApiResponseException
     */
    static function log($data, $prettify = false){
        throw new ApiResponseException("[Exception]".($prettify? print_r($data): json_encode($data)));
    }
}
