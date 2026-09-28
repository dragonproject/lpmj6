<?php

$temp = "The date is ";
echo $temp . longdate(time());

/**
 * タイムスタンプを受け取り、フォーマットされた日付文字列を返す関数
 *
 * @param int $timestamp Unixタイムスタンプ（整数型）
 * @return string フォーマットされた日付文字列
 */
function longdate(int $timestamp): string
{
    // date() で日付をフォーマット（例: Monday August 31st 2026）
    // l: 曜日(フルネーム)
    // F: 月(フルネーム)
    // j: 日(月内の日)
    // S: 序数の接尾辞(st, nd, rd, th)
    // Y: 年(4桁)
    return date("l F jS Y", $timestamp);
}
