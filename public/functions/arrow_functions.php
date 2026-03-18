<?php

// arrow functions

$input_numbers = [2,3,5,8,24];

// anonymous functions example
$double = function($x){
    return $x*2;
};
echo "<pre>";
print_r($input_numbers);
print_r(array_map($double,$input_numbers));

$multiply_by = 4;
// make multiple of $y functions
$multiple = function($x) use ($multiply_by) {
    return $x * $multiply_by;
};

print_r(array_map($multiple,$input_numbers));