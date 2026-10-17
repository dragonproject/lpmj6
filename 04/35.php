<?php
// ../text.txtファイルに100回 "data" という文字列を書き込む
// 失敗した場合はループを抜ける
// w: write, wb: write binary, r: read, rb: read binary, a: append
// + : r+ w+ a+

$fp = fopen("../text.txt", 'wb');

for ($j = 0; $j < 100; ++$j) {
    // fwrite() は書き込まれたバイト数を返す
    // 失敗した場合は false を返す
    $written = fwrite($fp, "data<br>");
    echo "Wrote " . $written . " bytes to file<br>";

    // false の場合は break
    if ($written == false) {
        break;
    }
}

fclose($fp);
