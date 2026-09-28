<?php

$day_number       = (int)date('z') + 1;            // 今日の通算日 (1〜366)
$days_in_year     = (int)date('L') ? 366 : 365;    // うるう年なら366日、平年なら365日
$days_to_new_year = $days_in_year - $day_number;  // 年末までの残り日数

if ($days_to_new_year < 30) {
    echo "Not long now till new year\n";
} else {
    echo "Days to new year: " . $days_to_new_year . "\n";
}
