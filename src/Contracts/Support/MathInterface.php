<?php

namespace Rabsana\Sialk\Contracts\Support;

use DivisionByZeroError;

interface MathInterface
{
    /**
     * Add two arbitrary precision numbers
     * $num1 + $num2
     *
     * @param  string  $num1  The left operand, as a string.
     * @param  string  $num2  The right operand, as a string.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return string The result of the subtraction, as a string
     */
    public function add(string $num1, string $num2, int $scale): string;

    /**
     * Subtract one arbitrary precision number from another
     * $num1 - $num2
     *
     * @param  string  $num1  The left operand, as a string.
     * @param  string  $num2  The right operand, as a string.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return string The result of the subtraction, as a string
     */
    public function sub(string $num1, string $num2, int $scale): string;

    /**
     * Multiply two arbitrary precision numbers
     * $num1 * $num2
     *
     * @param  string  $num1  The left operand, as a string.
     * @param  string  $num2  The right operand, as a string.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return string The result of the subtraction, as a string
     */
    public function mul(string $num1, string $num2, int $scale): string;

    /**
     * Raise an arbitrary precision number to another
     * $num1 ^ $num2
     *
     * @param  string  $num  The base, as a string.
     * @param  string  $exponent  The exponent, as a string. If the exponent is non-integral,
     *                            it is truncated. The valid range of the exponent is platform specific,
     *                            but is at least -2147483648 to 2147483647.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return string The result of the subtraction, as a string
     */
    public function pow(string $num, string $exponent, int $scale): string;

    /**
     * Divide two arbitrary precision numbers
     * $num1 / $num2
     *
     * @param  string  $num1  The dividend, as a string.
     * @param  string  $num2  The divisor, as a string.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return string the result of the division as a string.
     *
     * @throws DivisionByZeroError
     */
    public function div(string $num1, string $num2, int $scale): string;

    /**
     * Compare two arbitrary precision numbers
     *
     * @param  string  $num1  The dividend, as a string.
     * @param  string  $num2  The divisor, as a string.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return int 0 if the two operands are equal, 1 if the $num1 is larger than the $num2, -1 otherwise.
     */
    public function comp(string $num1, string $num2, int $scale): int;

    /**
     * Compare two arbitrary precision numbers
     * $num1 > $num2 ? true : false
     *
     * @param  string  $num1  The dividend, as a string.
     * @param  string  $num2  The divisor, as a string.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return bool true if the $num1 is larger than the $num2, false otherwise.
     */
    public function gt(string $num1, string $num2, int $scale): bool;

    /**
     * Compare two arbitrary precision numbers
     * $num1 >= $num2 ? true : false
     *
     * @param  string  $num1  The dividend, as a string.
     * @param  string  $num2  The divisor, as a string.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return bool true if the $num1 is larger than or equal the $num2, false otherwise.
     */
    public function gte(string $num1, string $num2, int $scale): bool;

    /**
     * Compare two arbitrary precision numbers
     * $num1 < $num2 ? true : false
     *
     * @param  string  $num1  The dividend, as a string.
     * @param  string  $num2  The divisor, as a string.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return bool true if the $num1 is less than the $num2, false otherwise.
     */
    public function lt(string $num1, string $num2, int $scale): bool;

    /**
     * Compare two arbitrary precision numbers
     * $num1 <= $num2 ? true : false
     *
     * @param  string  $num1  The dividend, as a string.
     * @param  string  $num2  The divisor, as a string.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return bool true if the $num1 is less than or equal the $num2, false otherwise.
     */
    public function lte(string $num1, string $num2, int $scale): bool;

    /**
     * Compare two arbitrary precision numbers
     * $num1 == $num2 ? true : false
     *
     * @param  string  $num1  The dividend, as a string.
     * @param  string  $num2  The divisor, as a string.
     * @param  int  $scale  The number of digits after the decimal place in the result
     * @return bool true if the $num1 is equal the $num2, false otherwise.
     */
    public function eq(string $num1, string $num2, int $scale): bool;

    /**
     * Format a number with grouped thousands
     *
     * @param  string  $num  The number being formatted.
     * @param  int  $decimals  Sets the number of decimal points.
     * @return string A formatted version of number.
     */
    public function format(string $num, int $decimals): string;
}
