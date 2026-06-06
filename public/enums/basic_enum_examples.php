<?php

require_once __DIR__.'/../../vendor/autoload.php';

use App8\Enums\Basic\Status;

echo "<h1>List All cases of any enum</h1>";
var_dump(Status::cases());
echo "<br />";
echo Status::Completed->toString();
echo "<br />";
echo Status::Pending->toString();
echo "<hr />";
echo '<code>gettype(Status::Pending): </code>'. gettype(Status::Pending);
echo "<br />";
echo '<code>get_class(Status::Pending): </code> '.get_class(Status::Pending);