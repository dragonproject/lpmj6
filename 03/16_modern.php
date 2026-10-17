<?php

// 厳格な型チェックモードを有効化
declare(strict_types=1);

/**
 * ==============================================================================
 * 03/16_modern.php: 引数による値の受け渡しと「名前付き引数（Named Arguments）」
 * ==============================================================================
 * 
 * 16.php のテーマは「関数に必要なデータを引数で明示的に渡す」ことでした。
 * 
 * PHP 8.0 で導入された「名前付き引数」と PHP 8.1 の「New in initializers」
 * を組み合わせることで、引数の受け渡しが飛躍的に柔軟かつ読みやすくなります。
 */

/**
 * 接頭辞と日時を受け取り、連結したフォーマット済み文字列を返す関数
 *
 * @param string $prefix 先頭に付与する文字列（デフォルト値あり）
 * @param DateTimeInterface $date 対象日時（PHP 8.1+: デフォルトで現在日時を生成）
 * @return string フォーマットされた日付メッセージ
 */
function formatMessage(
    string $prefix = "The date is ",
    DateTimeInterface $date = new DateTimeImmutable()
): string {
    // 文字列連結 (.) ではなく、波括弧 {} による文字列埋め込みでスッキリ記述
    return "{$prefix}{$date->format('l F jS Y')}";
}

echo "<h3>PHP 8.0+ 名前付き引数（Named Arguments）の活用例</h3>";

// ① 全てデフォルト値を使用（引数を完全に省略）
echo formatMessage() . "<br>";

// ② 従来のように順番通りに引数を渡す（位置引数）
echo formatMessage("Today is ", new DateTimeImmutable()) . "<br>";

// ③ 【PHP 8の真骨頂】「名前付き引数」で、第2引数だけをピンポイント指定！
// （第1引数の $prefix は省略してデフォルト値のまま、$date だけ「来月」に差し替え）
echo formatMessage(date: new DateTimeImmutable('+1 month')) . "<br>";

// ④ 名前付き引数を使えば、引数を渡す順番を逆にしても正しく動作
echo formatMessage(
    date: new DateTimeImmutable('+1 year'),
    prefix: "Next year date: "
) . "<br>";
