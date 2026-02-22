<?php

// creating an array
//
echo "array_all() and array_any() function examples ";
echo "<hr />";

$newArray = array();

$newArrayShortHand = [];

print_r($newArray);echo "<br />";
print_r($newArrayShortHand);echo "<br />";

$numbers = [10, 25, 37, 42, 58, 63, 71, 84, 99];
$fruits = ['apple'=>5, 'banana'=>3, 'orange'=>8, 'mango'=>6, 'grape'=>4];
$countries = [
    'US' => 'United States',
    'GB' => 'United Kingdom',
    'CA' => 'Canada',
    'AU' => 'Australia',
    'IN' => 'India',
    'JP' => 'Japan',
    'CN' => 'China',
    'FR' => 'France',
    'DE' => 'Germany',
    'IT' => 'Italy'
];

$callbackFunction = function($value) { return is_string($value);};
echo function_exists('array_all');
echo "<br />";
var_dump(array_all($numbers,$callbackFunction));
echo "<br />";
var_dump(array_all($fruits,$callbackFunction));
echo "<br />";
var_dump(array_all($countries,$callbackFunction));

echo "<hr />";

var_dump(array_any($fruits,function($value, $key) {return is_string($value);}));