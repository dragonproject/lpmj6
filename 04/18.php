<?php

$finished = 0;  // または 1

// getnext() は関数が定義されている場合のみ呼び出される
if (function_exists('getnext')) {
    $gn = getnext();
} else {
    $gn = 0;
}

// 終了判定
if ($finished == 1 or $gn == 1) {
    exit;
}

// ここに継続する場合の処理を記述
