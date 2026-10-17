<?php

$bank_balance = 50;
$savings      = 0;
$money        = 0;

if ($bank_balance < 100) {
    $money         = 1000;
    $bank_balance += $money;
} else {
    $savings      += 50;
    $bank_balance -= 50;
}

echo $money;
echo "<br>";
echo $bank_balance;
echo "<br>";
echo $savings;
echo "<br>";
