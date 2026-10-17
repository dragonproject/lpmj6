<?php

function longdate($timestamp)
{
    return date("l F jS Y", $timestamp);
}

echo longdate(time());

echo "<br>";

