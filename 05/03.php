<?php

// 配列を受け取って、それぞれの要素を大文字にする
$names = fix_names("WILLIAM", "henry", "gatES");
echo $names[0] . " " . $names[1] . " " . $names[2];
echo "\n";

// 配列を受け取って、それぞれの要素を大文字にする
function fix_names($n1, $n2, $n3)
{
    // すべて小文字にしてから最初の文字を大文字にする
    $n1 = ucfirst(strtolower($n1));
    $n2 = ucfirst(strtolower($n2));
    $n3 = ucfirst(strtolower($n3));

    // 配列を返す
    return array($n1, $n2, $n3);
}
