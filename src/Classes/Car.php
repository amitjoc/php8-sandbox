<?php

/**
 * Question:
 *      Create a simple Car class with properties make, model, and year.
 *      Add methods startEngine() and stopEngine() that print appropriate messages.
 *      Instantiate the class and call both methods.
 *
 *  */

namespace App8\Classes;

class Car
{

    /**
     * Brand / Manufacturer name
     *
     * For example (Toyota, Honda, BMW, Mercedes, Tata, Mahindra, Hyundai, etc.)
     *
     * @var string|mixed
     */
    public string $make;
    /**
     * Model = Specific name of the car
     *
     * For example (Fortuner, Civic, i20, Creta, Innova, etc.)
     *
     * @var string|mixed
     */
    public string $model;
    /**
     * Year = Manufacturing year
     *
     * For example (2020, 2021, 2022, etc.)
     *
     * @var int
     */
    public int $year;

    /**
     * @param string|mixed $make
     * @param string|mixed $model
     * @param int $year
     */
    public function __construct($make = "Toyota", $model = "Corolla", $year = 2020)
    {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function startEngine(): string
    {
        return "The engine of the {$this->make} {$this->model} made in {$this->year} is starting.";
    }

    /**
     * @return string
     */
    public function stopEngine(): string
    {
        return "The engine of the {$this->make} {$this->model} made in {$this->year} is stopping.";
    }

}