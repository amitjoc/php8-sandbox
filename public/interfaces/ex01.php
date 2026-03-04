<?php

use App8\Classes\Circle;

include_once __DIR__ .'/../../vendor/autoload.php';


$circleObj = new Circle();
$circleObj->radius = 1;
print_r($circleObj->calculateArea());

echo "<hr />";
$circleObj->radius = 2;
print_r($circleObj->calculateArea());