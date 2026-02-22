<?php

use App8\Classes\Product;

include_once __DIR__.'/../../vendor/autoload.php';


$productObject = new Product();

try {
    $reflectionApi = new ReflectionParameter(['App8\Classes\Product', 'setId'], 1);
    print_r($reflectionApi);
    echo "<hr />";

    echo $reflectionApi->isDefaultValueAvailable();
    echo "<br />";
    print_r((int)$reflectionApi->getDefaultValue());
    echo "<pre>";
    echo "Available Methods for Parameter Class";
    echo "<br />";
    print_r(get_class_methods($reflectionApi));

} catch (ReflectionException $e) {
    print_r($e);
}

