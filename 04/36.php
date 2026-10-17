<?php

$j = 10;

while ($j > -10) {
    $j--;

    // ゼロ割を回避
    if ($j == 0) {
        continue;
    }
    echo "j = " . $j . ", 10/j = " . (10 / $j) . "<br>";
}
