<?php

use App8\Classes\Car;

require_once __DIR__.'/../../vendor/autoload.php';

$hondaCar = new Car("Honda", "Civic", 2021);
echo $hondaCar->startEngine();
echo "<br />";
echo $hondaCar->stopEngine();

echo "<br /><br />";
$unkonwModel = new Car();
echo $unkonwModel->startEngine();
echo "<br />";
echo $unkonwModel->stopEngine();