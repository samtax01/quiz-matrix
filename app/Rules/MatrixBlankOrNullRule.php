<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Rule that checks if the matrix has any
 * blank or null values.
 */
class MatrixBlankOrNullRule implements Rule
{
    /**
     * @inheritdoc
     */
    public function passes($attribute, $value): bool
    {
        // If there is only one row no need to make check
        if( count($value) !== 1) {
            // set a length value
            $currentLength = count($value[0]);
            for($i=0; $i < count($value); $i++) {
                if( count($value[$i]) !== $currentLength) return false;
            }
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function message(): string
    {
        return "The :attribute matrix must not contain null or empty values.";
    }

}
