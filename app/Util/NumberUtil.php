<?php

namespace App\Util;

class NumberUtil
{
    public $number;

    public function __construct($number)
    {
        if (preg_match('/^\$/', $number)) {
            $this->number = (float) substr($number, 1);
        } else {
            $this->number = (float) $number;
        }
    }

    public function round()
    {
        return number_format($this->number, 2);
    }

    public function raw()
    {
        return $this->number;
    }

    public function toCurrency(String $symbol = '$')
    {
        return $symbol . number_format($this->number, 2);
    }

    public function toPercentage()
    {
        if (!$this->number) {
            return null;
        }

        return $this->number * 100;
    }

    public function toPercentageString()
    {
        if (!$this->toPercentage()) {
            return null;
        }

        return (string) $this->toPercentage() . '%';
    }
}
