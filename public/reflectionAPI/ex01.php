<?php

use App8\Classes\Product;

include_once "../../vendor/autoload.php";


$productClass = new Product();
$refAPI = new ReflectionClass($productClass);

/**
 * Examine the class
 */

echo "<pre>";
print_r($productClass);
echo "<hr />";
print_r($refAPI->getName());
echo "<br />";
print_r($refAPI->getShortName());
echo "<br />";



