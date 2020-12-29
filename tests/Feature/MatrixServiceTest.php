<?php

namespace Tests\Feature;

use App\Exceptions\ApiResponseException;
use App\Services\MatrixService;
use Tests\TestCase;

class MatrixServiceTest extends TestCase
{

    /**
     * Test the value to column name algorithm
     *
     * @throws ApiResponseException
     */
    function testValueEquals(){

        $matrixService = new MatrixService;

        $this->assertEquals("A", $matrixService->parseToColumnName(1));

        $this->assertEquals("Z", $matrixService->parseToColumnName(26));

        $this->assertEquals("AA", $matrixService->parseToColumnName(27));

        $this->assertEquals("AB", $matrixService->parseToColumnName(28));

    }
}
