<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MatrixControllerTest extends TestCase
{

    /**
     * Data for different scenarios.
     *
     * @return array
     */
    public function matrixDataProvider(): array
    {
        return [
            'unequal matrixA' => [
                [
                    [2,4],
                    [3,5,6]
                ],
                [
                    [5,6,7],
                    [4,3,6]
                ],
                422,
                [
                    'status' => false,
                    'message' => ["The first matrix must not contain null or empty values."],
                    'data'=>null
                ]
            ],
            'unequal matrixB' => [
                [
                    [3,6,5],
                    [6,8,7]
                ],
                [
                    [1],
                    [4,6,7],
                    [5,7,8]
                ],
                422,
                [
                    'status' => false,
                    'message' => ["The second matrix must not contain null or empty values."],
                    'data'=>null
                ]
            ],
            'unequal row to col' => [
                [
                    [2,4,5,6]
                ],
                [
                    [2],
                    [5],
                    [7]
                ],
                422,
                [
                    'status' => false,
                    'message' => ["The second must contain 4 items."],
                    'data'=>null
                ]
            ],
            'nonnumeric values MatrixA' => [
                [
                    [2,5,6,'K']
                ],
                [
                    [5],
                    [6],
                    [8],
                    [9]
                ],
                422,
                [
                    'status' => false,
                    'message' => ["The first matrix must only contain integers(whole numbers)."],
                    'data'=>null
                ]
            ],
            'out of range numeric values' => [
                [
                    [400,30,6]
                ],
                [
                    [70],
                    [7],
                    [6]
                ],
                422,
                [
                    'status' => false,
                    'message' => [
                        "The first matrix must only contain numbers between 1 and 26",
                        "The second matrix must only contain numbers between 1 and 26"
                    ],
                    'data'=>null
                ]
            ],
            'small complete matrices' => [
                [
                    [8,12]
                ],
                [
                    [25, 18],
                    [8,4]
                ],
                200,
                [
                    'status' => true,
                    'message' => 'success',
                    'data' => [["KJ", "GJ"]]
                ]
            ],
            'medium complete matrices' => [
                [
                    [10,20,10,15],
                    [5,6,7,15]
                ],
                [
                    [2,4],
                    [6,8],
                    [10,12],
                    [16,18]
                ],
                200,
                [
                    'status' => true,
                    'message' => 'success',
                    'data' => [[
                            "RL",
                            "VR"
                        ], [
                            "MR",
                            "PF"
                        ]]
                ]
            ]
        ];
    }


    /**
     * Tests the post call to retrieve
     * a matrix product from input.
     *
     * @dataProvider matrixDataProvider
     *
     * @param array $matrixA  The first input matrix
     * @param array $matrixB  The second input matrix
     * @param int   $status   The HTTP status expected from call
     * @param array $expected The expected array denoting
     * 						  response from call
     * @return void
     */
    public function testGetMatrixProduct(array $matrixA, array $matrixB, int $status, array $expected): void
    {
        $response = $this->call('POST','/api/matrix', [
            'first' => $matrixA,
            'second' => $matrixB
        ]);

        $this->assertEquals($status, $response->status());
        $response->assertJson($expected);
    }
}
