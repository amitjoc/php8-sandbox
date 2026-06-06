<?php

namespace App8\Enums\Basic;

enum Status
{
    case Pending;
    case Completed;
    case Successful;
    case Failed;

    public function toString(): string
    {
        // return as per match expression
        return $this->name;
    }
}