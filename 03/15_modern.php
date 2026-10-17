<?php

// 厳格な型チェックモードを有効化
declare(strict_types=1);

/**
 * ==============================================================================
 * 03/15_modern.php: 責務の分離（単一責任原則）とモダンな英語日付フォーマット
 * ==============================================================================
 * 
 * 14.php から 15.php への改善点は「関数の責務の分離」でした。
 * - 14.php: 関数内で global $temp を参照して文章まで組み立てていた（密結合）
 * - 15.php: 関数は「日付の整形」のみを担当し、文章の連結は呼び出し側で行う（疎結合）
 * 
 * ここでは、PHP 8.1+ の機能（DateTimeImmutable、New in initializers、アロー関数）
 * を活用してさらにスマートかつ型安全にリファクタリングしたコードをまとめています。
 */


// ==============================================================================
// パターン1: 標準的なモダン関数定義（PHP 8.1+ の New in initializers を活用）
// ==============================================================================

/**
 * 英語圏の長い形式（Long format）で日付をフォーマットする関数
 * 
 * 【注目ポイント】
 * PHP 8.1 から、関数のデフォルト引数に直接 `new クラス名()` を指定できるようになりました。
 * これにより、引数を省略した場合は自動的に現在の `DateTimeImmutable` が生成されます。
 *
 * @param DateTimeInterface $date 対象日時（未指定時は現在日時）
 * @return string フォーマットされた日付文字列（例: "Saturday October 17th 2026"）
 */
function formatLongDate(DateTimeInterface $date = new DateTimeImmutable()): string
{
    // l : 曜日の完全名 (例: Saturday)
    // F : 月の完全名 (例: October)
    // j : 日 (先頭ゼロなし)
    // S : 英語の序数接尾辞 (st, nd, rd, th)
    // Y : 4桁の西暦 (例: 2026)
    return $date->format('l F jS Y');
}

echo "<h3>1. 標準的な関数パターン</h3>";

$prefix = "The date is ";

// ① 引数なしで呼び出し（自動的に現在日時が使用される）
echo $prefix . formatLongDate() . "<br>";

// ② DateTimeImmutable で特定の日時（例: 1ヶ月後）を指定して呼び出し
echo $prefix . formatLongDate(new DateTimeImmutable('+1 month')) . "<br>";


// ==============================================================================
// パターン2: アロー関数（Arrow Functions / PHP 7.4+）
// ==============================================================================
// 1行で値を返すだけの単機能ユーティリティの場合、アロー関数を使うことで
// 極めてシンプルに記述できます。

echo "<h3>2. アロー関数パターン</h3>";

$arrowFormatLongDate = fn (DateTimeInterface $date = new DateTimeImmutable()): string
    => $date->format('l F jS Y');

echo "The date is " . $arrowFormatLongDate() . "<br>";
