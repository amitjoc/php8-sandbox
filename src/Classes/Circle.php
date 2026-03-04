<?php

namespace App8\Classes;

use App8\Interfaces\IConstant;
use App8\Interfaces\IShape;

class Circle implements IShape, IConstant
{
    public float $radius = 1;

    public function calculateArea(): float
    {
        return (self::PIE * $this->radius * $this->radius);
    }
}