<?php

// 燃料の残量を設定
$fuel = 1;
// 三項演算子を使って燃料の残量を判定
$enough = $fuel <= 1 ? false : true;

echo $enough;