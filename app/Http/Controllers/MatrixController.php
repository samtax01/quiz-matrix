<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiResponseException;
use App\Helpers\ApiResponse;
use App\Http\Requests\MatrixRequest;
use App\Services\MatrixService;
use Illuminate\Http\JsonResponse;

class MatrixController extends Controller
{

    protected $matrixService;

    /**
     * Create a new controller instance.
     *
     * @param MatrixService $matrixService
     */
    public function __construct(MatrixService $matrixService)
    {
        $this->matrixService = $matrixService;
    }


    /**
     * matrix product endpoint
     *
     * @param MatrixRequest $request
     * @return JsonResponse
     * @throws ApiResponseException
     */
    public function getMatrixProduct(MatrixRequest $request): JsonResponse
    {
        //multiply the matrix
        $result = $this->matrixService->getMatrixProduct($request->first, $request->second, true);
        return response()->json(ApiResponse::trueData($result));
    }


}
