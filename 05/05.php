<?php

// globalキーワードを使うと、関数内でグローバル変数を操作できる

// グローバル変数
$a1 = "WILLIAM";
$a2 = "henry";
$a3 = "gatES";

// 元の文字列を表示
echo $a1 . " " . $a2 . " " . $a3 . "\n";

// 関数を呼び出す
fix_names();

// 変更後の文字列を表示
echo $a1 . " " . $a2 . " " . $a3;

function fix_names()
{
    global $a1;
    $a1 = ucfirst(strtolower($a1));
    global $a2;
    $a2 = ucfirst(strtolower($a2));
    global $a3;
    $a3 = ucfirst(strtolower($a3));
}
