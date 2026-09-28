<?php

// phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

// 先頭に付けるテキストを定義
$temp = "The date is ";

// $temp（プレフィックス文字列）と time()（現在日時のUnixタイムスタンプ）を渡して呼び出し
echo longdate($temp, time());

/**
 * テキストとタイムスタンプを受け取り、連結したフォーマット済み日付文字列を返す関数
 *
 * @param string $text 先頭に付与する文字列
 * @param int $timestamp Unixタイムスタンプ（整数型）
 * @return string フォーマットされた日付メッセージ
 */
function longdate(string $text, int $timestamp): string
{
    // date() で日付をフォーマット（例: Monday August 31st 2026）
    // l: 曜日(フルネーム)
    // F: 月(フルネーム)
    // j: 日(月内の日)
    // S: 序数の接尾辞(st, nd, rd, th)
    // Y: 年(4桁)
    return $text . date("l F jS Y", $timestamp);
}
