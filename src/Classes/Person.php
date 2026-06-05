<?php

namespace App8\Classes;

/**
 * Question: Write a Person class with public properties name and age. Add a method greet() that
 *   returns "Hello, my name is [name] and I am [age] years old."
 *   Create two different Person objects and call the method on both.
 *
 */
class Person
{
    /**
     * Person's Name (First Name Last Name)
     *
     * @var string|mixed
     */
    public string $name;

    /**
     * Age of Person
     *
     * @var float|int|mixed
     */
    public float $age;

    /**
     * Gender of Person (Male, Female, Third Gender)
     * @var string|mixed
     */
    public string $gender;  // later improvement of ENUM can be added

    public function __construct($name = 'Amit', $age = 5, $gender = 'male')
    {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
    }

    /**
     * Greets a client with a welcome message
     *
     * @return string
     */
    public function greet(): string
    {
        return "Hello, my name is {$this->name} and I am {$this->age} years old and I am a {$this->gender}.";
    }



}