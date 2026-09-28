<?php

$a = 1;
$b = 0;

// AND 演算子
echo($a and $b);  // 0 (両方が true の場合のみ true)
print("\n");

// OR 演算子
echo($a or $b);   // 1 (どちらかが true の場合 true)
print("\n");

// XOR 演算子
echo($a xor $b);  // 1 (排他的論理和: どちらか一方のみが true の場合 true)
print("\n");

// NOT 演算子
echo(!$a);         // 0 (値を反転する)
