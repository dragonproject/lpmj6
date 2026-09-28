<?php

$count = 1;

while ($count <= 12) {
    echo "$count times 12 is " . $count * 12 . "\n";
    printf("%d times 12 is %d\n", $count, $count * 12);

    ++$count;
}
