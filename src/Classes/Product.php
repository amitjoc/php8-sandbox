<?php

namespace App8\Classes;

class Product
{
    protected int $id ;

    protected string $name;

    protected float $price =0.00;

    protected int $sku = 0;

    protected int $stock_quantity =0;

    public function __construct()
    {

    }

    /**
     * this is the doc comment for getId method
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @param bool $isNull
     */
    public function setId(int $id, bool $isNull=false): void
    {
        $this->id = $id;
    }


}