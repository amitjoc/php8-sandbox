<?php

use App8\Classes\Square;

require_once __DIR__. '/../../vendor/autoload.php';

$squareObject  = new Square();

print_r($squareObject->calculateArea());

echo "<hr />";
$squareObject->side = 8;
print_r($squareObject->calculateArea());

echo "<hr />";
$squareObject->side = 3.2;
print_r($squareObject->calculateArea());

