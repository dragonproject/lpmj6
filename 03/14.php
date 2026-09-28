<?php

// グローバルスコープで変数を定義
$temp = "日付は：";

// time() で現在日時のUnixタイムスタンプを取得し、longdate() を呼び出して結果を出力
echo longdate(time());

/**
 * タイムスタンプを受け取り、グローバル変数 $temp と連結してフォーマットされた日付文字列を返す関数
 *
 * @param int $timestamp Unixタイムスタンプ（整数型）
 * @return string フォーマットされた日付メッセージ
 */
function longdate(int $timestamp): string
{
    // 関数外（グローバルスコープ）で定義された $temp を関数内で使用するために global 宣言する
    global $temp;

    // 日本語の曜日配列
    $weekdays = ['日', '月', '火', '水', '木', '金', '土'];
    
    // 日本語の月名配列
    $months = ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'];
    
    // 曜日（w: 0=日曜日, 1=月曜日, ..., 6=土曜日）
    $dayOfWeek = $weekdays[(int)date("w", $timestamp)];
    
    // 月（n: 1-12, 先頭にゼロなし）
    $month = $months[(int)date("n", $timestamp) - 1];
    
    // 日（j: 先頭にゼロなし）
    $day = date("j", $timestamp);

    // 年（Y: 4桁）
    $year = date("Y", $timestamp);
    
    // 日本語の形式で連結（例: 2026年8月31日月曜日）
    return $temp . $year . "年" . $month . $day . "日" . $dayOfWeek . "曜日";
}
