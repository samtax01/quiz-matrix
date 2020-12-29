<?php

namespace App\Http\Requests;

use App\Rules\MatrixBlankOrNullRule;
use App\Rules\MatrixNumericRule;
use App\Rules\MatrixRangeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MatrixRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {

        $matrixIsBlankOrNull = new MatrixBlankOrNullRule();
        $matrixIsNumericRule = new MatrixNumericRule();
        $matrixRangeRule = new MatrixRangeRule(1,26);

        return  [
            'first' => ['bail', 'required', 'array', $matrixIsBlankOrNull, $matrixIsNumericRule, $matrixRangeRule],
            'second' => ['bail', 'required', 'array', $matrixIsBlankOrNull, $matrixIsNumericRule, $matrixRangeRule, "size:".count($request->first[0])],
        ];

    }
}
