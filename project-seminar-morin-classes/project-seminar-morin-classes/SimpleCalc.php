<?php

declare(strict_types = 1);

class SimpleCalc
{
    static function add(float $num1, float $num2): ?float
    {
        return $num1 + $num2;
    }

    static function multiply(float $num1, float $num2): ?float
    {
        return $num1 * $num2;
    }

    static function substract(float $num1, float $num2): ?float
    {
        return $num1 - $num2;
    }

    static function divide(float $num1, float $num2): ?float
    {
        return round($num1 / $num2, 2);
    }
}
