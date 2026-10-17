<?php

// phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols


test();
echo "<br>";
test();
echo "<br>";
test();

/**
 * 静的変数（static）の動作確認用関数
 * 関数が終了しても $count の値が保持され、呼び出されるたびに出力・加算されます
 *
 * @return void
 */
function test(): void
{
    static $count = 0;
    echo $count;
    $count++;
}
