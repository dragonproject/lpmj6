<?php

$count = 1;

while ($count <= 12) {
    echo "$count times 12 is " . $count * 12 . "<br>";
    printf("%d times 12 is %d<br>", $count, $count * 12);

    ++$count;
}
