<?php

// 厳格な型チェックモードを有効化
// 暗黙的な型変換（例: 文字列 "123" を勝手に数値 123 として扱うなど）を無効にし、
// 型の不一致があった場合に即座に TypeError を発生させ、バグを未然に防ぎます。
declare(strict_types=1);

/**
 * 日時を受け取り、日本語フォーマットの日付文字列を返す関数
 *
 * 【モダンPHPの特徴】
 * 1. Union Types（複合型: PHP 8.0+）
 *    `DateTimeInterface|int|null` により、3種類の日時形式を柔軟に受け入れ可能。
 *    - DateTimeInterface: DateTime または DateTimeImmutable オブジェクト
 *    - int: 従来のUnixタイムスタンプ（time() など）
 *    - null: 値が渡されなかった場合
 *
 * 2. デフォルト引数（= null）
 *    引数を省略して `longdate()` のように呼び出すことができます。
 *
 * 3. 戻り値の型宣言（: string）
 *    関数が必ず文字列を返すことを保証します。
 *
 * @param DateTimeInterface|int|null $date 日時（未指定時は現在時刻）
 * @return string フォーマットされたメッセージ文字列
 */
function longdate(DateTimeInterface|int|null $date = null): string
{
    // 【match式（PHP 8.0+）による入力値の正規化】
    // switch文と違い、厳格な比較（===）を行い、評価された結果の値を直接変数に代入できます。
    // ここでは受け取った多様な型（オブジェクト、int、null）を、
    // 安全で変更不可（イミュータブル）な DateTimeImmutable に統一しています。
    $targetDate = match (true) {
        // すでに日付オブジェクトが渡されている場合はそのまま使用
        $date instanceof DateTimeInterface => $date,

        // Unixタイムスタンプ（整数）が渡された場合、DateTimeImmutable オブジェクトを生成してセット
        is_int($date)                       => (new DateTimeImmutable())->setTimestamp($date),

        // 引数が省略された（null）場合は、現在日時のインスタンスを生成
        default                             => new DateTimeImmutable(),
    };

    // 【IntlDateFormatter: PHP標準の国際化（intl）拡張クラス】
    // 曜日の配列（['日', '月', ...]）を手動で作らなくても、
    // ロケール（言語・地域）の定義に基づいた正確な文字列を自動生成できます。
    $formatter = new IntlDateFormatter(
        'ja_JP',                      // ロケール: 日本語（日本）
        IntlDateFormatter::FULL,      // 日付の書式スタイル（パターン指定時の基準）
        IntlDateFormatter::NONE,      // 時刻の書式スタイル（今回は時刻を含めないため NONE）
        'Asia/Tokyo',                 // タイムゾーン: 日本標準時（JST）
        IntlDateFormatter::GREGORIAN, // カレンダー種別: 西暦（グレゴリオ暦）
        'y年M月d日 EEEE'              // カスタムパターン:
                                      //   y    : 年（例: 2026）
                                      //   M    : 月（例: 10 / 1桁表記）
                                      //   d    : 日（例: 17 / 1桁表記）
                                      //   EEEE : 曜日の完全名（例: 土曜日。E だと「土」）
    );

    // {$...} 構文を使って文字列内にメソッドの実行結果を展開
    return "今日の日付は {$formatter->format($targetDate)} です";
}

// --------------------------------------------------
// 動作確認・呼び出し例
// --------------------------------------------------

// 1. 引数を省略（デフォルト引数 null が適用され、現在のシステム日時を出力）
echo longdate() . "<br>";

// 2. 従来の time() による Unixタイムスタンプ（数値）を渡すケース
echo longdate(time()) . "<br>";

// 3. DateTimeImmutable オブジェクトを渡すケース（相対指定で「明日」の日付を取得）
echo longdate(new DateTimeImmutable('+1 day')) . "<br>";
