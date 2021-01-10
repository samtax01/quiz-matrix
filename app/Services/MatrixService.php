<?php

namespace App\Services;



use App\Exceptions\ApiResponseException;

class MatrixService
{


    /**
     * Matrix multiplication
     * You can confirm calculation online from: https://matrix.reshish.com/multiplication.php
     *
     * @param array $first
     * @param array $second
     * @param bool $responseAsAlphabet
     * @return array
     * @throws ApiResponseException
     */
    public function getMatrixProduct(array $first, array $second, bool $responseAsAlphabet = false)
    {
        $result = [];
        for($i=0; $i<count($first); $i++){
            for($j=0; $j<count($second[0]); $j++){
                $sum = 0;
                for($k=0; $k<count($first[0]); $k++){
                    $sum += $first[$i][$k] * $second[$k][$j];
                }
                $result[$i][$j] = $responseAsAlphabet? $this->parseToColumnName($sum): $sum;
            }
        }
        return $result;
    }



    /**
     * Retrieves the alpha representation for
     * the parameter.
     *
     * @param int $columnNumber
     *
     * @return string
     * @throws ApiResponseException
     */
    public function parseToColumnName(int $columnNumber): string
    {
        $columnNumber = intval($columnNumber);
        if ($columnNumber <= 0) return '';

        $letter = '';
        while($columnNumber != 0){
            $p = ($columnNumber - 1) % 26;
            $columnNumber = intval(($columnNumber - $p) / 26);
            $letter = chr(65 + $p) . $letter;
        }
        return $letter;
    }



}
