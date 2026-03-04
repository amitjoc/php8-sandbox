<?php

namespace App8\Classes;

use App8\Interfaces\IShape;

class Square implements IShape
{
    public float $side = 1;
    /**
     * @inheritDoc
     */
    public function calculateArea(): float
    {
        return ($this->side * $this->side);
    }
}