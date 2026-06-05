<?php

use App8\Classes\Person;

require_once __DIR__.'/../../vendor/autoload.php';

$perssonOne = new Person();
$perssonOne->name = 'Vinayak Joshi';
$perssonOne->age = 1;
$perssonOne->gender = 'male';
echo $perssonOne->greet();

echo "<br />";echo "<hr />";
$personTwo = new Person('Abhishek',10,'male');
echo $personTwo->greet();

echo "<hr />";
$personThree = new Person('Shree Lakshmi',20,'female');
echo $personThree->greet();