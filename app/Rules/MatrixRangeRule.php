<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Rule that determines if a matrix
 * numeric values are within a set range.
 */
class MatrixRangeRule implements Rule
{
    /** @var int */
    protected $min;

    /** @var int */
    protected $max;

    /**
     * Creates a new rule instance.
     *
     * @param int $min The minimum for the range
     * @param int $max The maximum for the range
     *
     * @return void
     */
    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @inheritdoc
     */
    public function passes($attribute, $value): bool
    {
        foreach($value as $val) {
            $chk = array_filter($val, [$this, 'checkRange']);
            if(count($chk))
                return false;
        }
        return true;
    }

    /**
     * Checks the range for an inputted value.
     * The value to check against the range.
     *
     * @param int $value
     *
     * @return void|int
     */
    public function checkRange(int $value)
    {
        if(($value < $this->min) || ($value > $this->max))
            return $value;
    }

    /**
     * @inheritdoc
     */
    public function message(): string
    {
        return "The :attribute matrix must only contain numbers between {$this->min} and {$this->max}";
    }
}
