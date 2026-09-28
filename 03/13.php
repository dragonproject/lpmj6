<?php

/**
 * タイムスタンプを受け取り、フォーマットされた日付文字列を返す関数
 *
 * @param int $timestamp Unixタイムスタンプ
 * @return string フォーマットされた日付メッセージ
 */
function longdate($timestamp) // phpcs:ignore Generic.WhiteSpace.ScopeIndent.IncorrectExact
{
    // 曜日の日本語配列（0: 日曜日 〜 6: 土曜日）
    $weeks = ['日', '月', '火', '水', '木', '金', '土'];
    $week = $weeks[date('w', $timestamp)];

    // $temp はこの関数内でのみ有効なローカル変数
    // 「年 月 日 曜日」の日本式（例: 2026年8月31日 月曜日）に変換
    $temp = date("Y年n月j日", $timestamp) . " {$week}曜日";

    // 整形した文字列を関数の呼び出し元に返す
    return "今日の日付は $temp です";
}

// time() で現在日時のUnixタイムスタンプを取得し、
// longdate() 関数に渡して、返ってきた文字列を echo で出力
echo longdate(time());
