<?php

namespace App\Services;



use App\Exceptions\ApiResponseException;

class MatrixService
{


    /**
     * Matrix multiplication
     *
     * @param array $first
     * @param array $second
     * @param bool $responseAsAlphabet
     * @return array
     * @throws ApiResponseException
     */
    public function getMatrixProduct(array $first, array $second, bool $responseAsAlphabet = false): array
    {
        $final = [];
        $total = count($second[0]);

        foreach($first as $key => $currentRow){
            for($i=0; $i < $total; $i++) {
                $currentColumn = $this->arrayShiftKey($second, $i);
                $cellSum = $this->sumTheProductOf($currentRow,$currentColumn);

                $final[$key][] = ($responseAsAlphabet)
                    ? $this->parseToColumnName($cellSum)
                    : $cellSum;
            }
        }
        return $final;
    }


    /**
     * Returns an array of keys for
     * an array of arrays.
     *
     * @param array $arr   The array of arrays.
     * @param int   $index The index to use for
     *                     each array.
     *
     * @return array
     */
    private function arrayShiftKey(array $arr, int $index): array
    {
        $buffer = [];
        foreach($arr as $array)
            $buffer[] = $array[$index];
        return $buffer;
    }

    /**
     * Sums the product of two
     * equally-length arrays.
     *
     * @param  array $first
     * @param  array $second
     *
     * @return int
     */
    private function sumTheProductOf(array $first, array $second): int
    {
        $total = 0;
        for($i=0; $i<count($first); $i++)
            $total += $first[$i] *  $second[$i];
        return $total;
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
        $columnNumber--;
        if($columnNumber >= 0 && $columnNumber < 26){
            return chr((ord('A') + $columnNumber));
        }else if ($columnNumber > 25){
            return $this->parseToColumnName( $columnNumber / 26) . $this->parseToColumnName( $columnNumber % 26 + 1);
        }else
            throw new ApiResponseException("InvalidColumn #".($columnNumber + 1));
    }



}
