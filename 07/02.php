<?php
echo "<pre>"; // Enables viewing of the spaces

$h = 'Rasmus';

printf("[%s]<br>",        $h); // Standard string output
printf("[%12s]<br>",      $h); // Right justify with spaces
printf("[%-12s]<br>",     $h); // Left justify with spaces
printf("[%012s]<br>",     $h); // Zero padding
printf("[%'#12s]<br><br>",  $h); // Use the custom padding character '#'

$d = 'Rasmus Lerdorf';

printf("[%12.8s]<br>",    $d); // Right justify, cutoff of 8 characters
printf("[%-12.12s]<br>",   $d); // Left justify, cutoff of 12 characters
printf("[%-'@12.10s]<br>", $d); // Left justify, pad '@', cutoff 10 chars
