<?php

// array_combine関数が存在するかどうかをチェックする
// array_combine関数は2つの配列を1つの配列に結合するPHPの標準関数
// array_combine関数は第一引数にキーとなる配列、第二引数にバリューとなる配列を渡す
// このコードはPHPのバージョンによって動作が異なる可能性がある
// PHP 5.5以降ではarray_combine関数が存在する
// PHP 5.4以前ではarray_combine関数が存在しない

if (function_exists("array_combine")) {
    echo "Function exists<br>";
} else {
    echo "Function does not exist - better write our own<br>";
}
