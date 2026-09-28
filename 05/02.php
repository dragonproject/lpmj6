<?php

// 名前の最初の文字を大文字にして、姓と名を結合する
echo fix_names("WILLIAM", "henry", "gatES");

// 名前の最初の文字を大文字にして、姓と名を結合する
function fix_names($n1, $n2, $n3)
{
    // すべて小文字にしてから最初の文字を大文字にする
    $n1 = ucfirst(strtolower($n1));
    $n2 = ucfirst(strtolower($n2));
    $n3 = ucfirst(strtolower($n3));

    return $n1 . " " . $n2 . " " . $n3;
}
