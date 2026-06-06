<?php

namespace App8\Classes;

/**
 * Question: Create a BankAccount class with a private property balance.
 *  Add public methods deposit($amount), withdraw($amount), and getBalance().
 *  Ensure withdrawal doesn't allow negative balance.
 */
class BankAccount
{
    public float $balance = 0.0;

    /**
     * @param float $amount
     * @return float
     */
    public function deposit(float $amount): float
    {
        return $this->balance = $this->balance + $amount;
    }

    /**
     * @param float $amount
     * @return float
     */
    public function withDraw(float $amount): float
    {
        return $this->balance -= $amount;
    }

    /**
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

}