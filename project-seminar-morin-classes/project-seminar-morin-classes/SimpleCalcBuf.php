<?php

declare(strict_types = 1);

class SimpleCalcBuf
{
    public float $result;

    public function __construct(float $result)
    {
        $this->result = $result;
    }

    public function add(float $num)
    {
        $this->result += $num;
        return $this;
    }

    public function multiply(float $num)
    {
        $this->result *= $num;
        return $this;
    }

    public function substract(float $num)
    {
        $this->result -= $num;
        return $this;
    }

    public function divide(float $num, int $sign)
    {
        $this-> result = round($this-> result / $num, $sign);
        return $this;
    }

    public function getResult(): ?float
    {
        return $this-> result;
    }
}
