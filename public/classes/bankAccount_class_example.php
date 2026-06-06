<?php

use App8\Classes\BankAccount;

require_once __DIR__ .'/../../vendor/autoload.php';

$bankAccount = new BankAccount();
echo "<hr />";
echo $bankAccount->balance;
echo "<hr />";
echo $bankAccount->deposit(100.4);
echo "<hr />";
echo $bankAccount->withDraw(30.3);
echo "<hr />";
echo "<h1>Final balance of Account: <b>". $bankAccount->balance ."</b></h1>";