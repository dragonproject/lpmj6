<?php

$bank_balance = 100;
$money = 1000;

if ($bank_balance < 100) {
    $bank_balance += $money;
}

echo $money;
echo "\n";
echo $bank_balance;
echo "\n";

$message = $bank_balance < 100 ? "不足しています" : "足りています";
echo "$message";
echo "\n";
