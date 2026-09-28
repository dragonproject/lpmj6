<?php

/**
 * Magic Quotesを無効化
 * get_magic_quotes_gpc — Magic Quotesの現在の設定を取得する
 * 戻り値: Magic Quotesがオンの場合は真を返し、そうでない場合は偽を返す
 * ※ PHP 5.4.0 以降では常に偽が返される
 * @param PDO $pdo
 * @param string $string
 * @return string
 */
function mysql_fix_string($pdo, $string)
{
    if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
        $string = stripslashes($string);
    }
    return $pdo->quote($string);
}
