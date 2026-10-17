<?php

// 動作確認用の関数
function getnext(): int
{
    echo "getnext() が呼び出されました<br>";
    return 1;
}

/**
 * 終了条件の判定関数
 *
 * @param int|null $finished 終了フラグ（1: 終了, 0 または null: 継続判定へ）
 * @return string 判定結果メッセージ
 */
function checkCondition(?int $finished = null): string
{
    // 終了条件: finished が 1 または getnext() が 1 の場合は終了
    // ??: Null合体演算子
    if (($finished ?? 0) == 1 or (function_exists('getnext') && getnext() == 1)) {
        return "判定結果: 終了 (true)<br>";
    }
    return "判定結果: 継続 (false)<br>";
}

// --- 動作確認 ---
echo "【パターン1: \$finished = 1 の場合 (短絡評価により getnext は実行されない)】<br>";
echo checkCondition(1);

echo "<br>【パターン2: \$finished = 0 の場合 (getnext が実行される)】<br>";
echo checkCondition(0);

// 【Null合体演算子 (??) の説明】
// $finished ?? 0 は、$finished が定義されていて null でない場合はその値を返し、
// 未定義または null の場合は右辺のデフォルト値（ここでは 0）を返します。
// これにより、「Undefined variable (未定義変数)」の警告を防ぎ安全に判定できます。
