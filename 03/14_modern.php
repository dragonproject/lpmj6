<?php

// 厳格な型チェックモードを有効化
declare(strict_types=1);

/**
 * ==============================================================================
 * 03/14_modern.php: グローバル変数（global）からの脱却とモダンな設計パターン
 * ==============================================================================
 * 
 * 元の 14.php では「global $temp;」を用いて関数外の変数を参照していましたが、
 * 現代のPHPにおいて global 宣言は「予期せぬ副作用」や「テスト困難」を引き起こす
 * 最大のアンチパターン（避けるべき書き方）とされています。
 * 
 * ここでは、global を使わずに安全に値を渡す3つのモダンアプローチを紹介します。
 */


// ==============================================================================
// アプローチ1: 引数で渡す（最も標準的でクリーン）
// ==============================================================================
// プレフィックス（接頭辞）を関数の引数として受け取ります。
// デフォルト引数を指定しておくことで、引数省略時にも自然に動作します。

/**
 * 日本語日付文字列を生成する関数
 *
 * @param DateTimeInterface|int|null $date 対象日時（未指定時は現在時刻）
 * @param string $prefix メッセージの接頭辞
 * @return string フォーマットされたメッセージ文字列
 */
function formatDate(DateTimeInterface|int|null $date = null, string $prefix = "日付は："): string
{
    // 入力値を DateTimeImmutable に統一
    $targetDate = match (true) {
        $date instanceof DateTimeInterface => $date,
        is_int($date)                       => (new DateTimeImmutable())->setTimestamp($date),
        default                             => new DateTimeImmutable(),
    };

    // IntlDateFormatter による日本語フォーマット
    $formatter = new IntlDateFormatter(
        'ja_JP',
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'Asia/Tokyo',
        IntlDateFormatter::GREGORIAN,
        'y年M月d日 EEEE'
    );

    // 外部のグローバル変数ではなく、引数で安全に渡された $prefix を使用
    return "{$prefix} {$formatter->format($targetDate)}";
}

echo "<h3>1. 引数渡し（標準パターン）</h3>";
// デフォルトの接頭辞を使用
echo formatDate() . "<br>";
// PHP 8 の「名前付き引数」を使って、特定の日時や接頭辞を指定
echo formatDate(prefix: "本日の日付：") . "<br>";
echo formatDate(date: new DateTimeImmutable('+1 day'), prefix: "明日の予定日：") . "<br>";


// ==============================================================================
// アプローチ2: オブジェクト指向（クラス設計 / 依存性の注入）
// ==============================================================================
// 実務のフレームワーク（Laravel等）で最もよく使われるアプローチです。
// 設定値（プレフィックスやロケール）をクラスのプロパティとしてカプセル化します。

final class DateMessageFormatter
{
    /**
     * PHP 8 の「コンストラクタのプロパティ昇格」
     * 引数にアクセス修飾子（privateなど）を付けることで、
     * プロパティの宣言と代入を同時に行えます。
     * プロパティの宣言と代入を同時に行えます。リファクタリング：プロジェクト全体のファイルにおいて、コードの書式を整え、バリデーションメッセージを更新する
     */
    public function __construct(
        private string $prefix = "日付は：",
        private string $locale = "ja_JP",
        private string $pattern = "y年M月d日 EEEE",
    ) {}

    public function format(DateTimeInterface $date = new DateTimeImmutable()): string
    {
        $formatter = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'Asia/Tokyo',
            IntlDateFormatter::GREGORIAN,
            $this->pattern
        );

        return "{$this->prefix} {$formatter->format($date)}";
    }
}

echo "<h3>2. クラス設計（オブジェクト指向パターン）</h3>";
// デフォルト設定のフォーマッタ
$standardFormatter = new DateMessageFormatter();
echo $standardFormatter->format() . "<br>";

// 接頭辞やパターンをカスタマイズした別のインスタンス
$eventFormatter = new DateMessageFormatter(prefix: "イベント開催日：");
echo $eventFormatter->format(new DateTimeImmutable('+7 days')) . "<br>";


// ==============================================================================
// アプローチ3: 無名関数（クロージャ）と `use` 構文
// ==============================================================================
// 関数外のローカル変数をどうしても特定の処理に持ち込みたい場合、
// `global` ではなく `use ($variable)` を使うことで、安全かつ明示的にスコープへ取り込めます。

echo "<h3>3. 無名関数（クロージャと use 構文）</h3>";

$customPrefix = "クロージャによる日付：";

// use ($customPrefix) で外側の変数を明示的に関数内へ引き継ぐ
$closureFormatter = function (DateTimeInterface $date) use ($customPrefix): string {
    $formatter = new IntlDateFormatter(
        'ja_JP',
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'Asia/Tokyo',
        IntlDateFormatter::GREGORIAN,
        'y年M月d日 EEEE'
    );

    return "{$customPrefix} {$formatter->format($date)}";
};

echo $closureFormatter(new DateTimeImmutable()) . "<br>";
