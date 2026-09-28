<?php
// calc.php - ローン計算プログラム

$principal = $monthly = '';
$years = '15';
$interest = '3';
$out = '';

if (isset($_POST['principal'])) $principal = sanitizeString($_POST['principal']);
if (isset($_POST['monthly']))   $monthly   = sanitizeString($_POST['monthly']);
if (isset($_POST['years']))     $years     = sanitizeString($_POST['years']);
if (isset($_POST['interest']))  $interest  = sanitizeString($_POST['interest']);

// カンマを除去して数値判定用の値を作成
$clean_principal = str_replace(',', '', $principal);
$clean_monthly   = str_replace(',', '', $monthly);
$clean_years     = str_replace(',', '', $years);
$clean_interest  = str_replace(',', '', $interest);

if (is_numeric($clean_years) && is_numeric($clean_interest) && (float)$clean_years > 0)
{
    $n = (float)$clean_years * 12; // 支払い月数
    $r = ((float)$clean_interest / 100) / 12; // 月利

    if (is_numeric($clean_principal) && (float)$clean_principal > 0)
    {
        $p = (float)$clean_principal;
        if ($r > 0) {
            $calc_monthly = $p * ($r * pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1);
        } else {
            $calc_monthly = $p / $n;
        }
        $total = $calc_monthly * $n;
        $total_interest = $total - $p;

        $out = "借入額: ¥" . number_format($p) . "<br>" .
               "返済期間: " . htmlspecialchars($years) . " 年 (" . $n . " ヶ月)<br>" .
               "年利率: " . htmlspecialchars($interest) . "%<br>" .
               "毎月返済額: <b>¥" . number_format(round($calc_monthly)) . "</b> (詳細: ¥" . number_format($calc_monthly, 2) . ")<br>" .
               "返済総額: ¥" . number_format(round($total)) . "<br>" .
               "利息総額: ¥" . number_format(round($total_interest));

        $principal = number_format($p);
        $monthly = number_format(round($calc_monthly));
    }
    elseif (is_numeric($clean_monthly) && (float)$clean_monthly > 0)
    {
        $m = (float)$clean_monthly;
        if ($r > 0) {
            $calc_principal = $m * (pow(1 + $r, $n) - 1) / ($r * pow(1 + $r, $n));
        } else {
            $calc_principal = $m * $n;
        }
        $total = $m * $n;
        $total_interest = $total - $calc_principal;

        $out = "毎月返済額: ¥" . number_format($m) . "<br>" .
               "返済期間: " . htmlspecialchars($years) . " 年 (" . $n . " ヶ月)<br>" .
               "年利率: " . htmlspecialchars($interest) . "%<br>" .
               "借入可能額: <b>¥" . number_format(round($calc_principal)) . "</b> (詳細: ¥" . number_format($calc_principal, 2) . ")<br>" .
               "返済総額: ¥" . number_format(round($total)) . "<br>" .
               "利息総額: ¥" . number_format(round($total_interest));

        $monthly = number_format($m);
        $principal = number_format(round($calc_principal));
    }
    elseif ($principal !== '' || $monthly !== '')
    {
        $out = "<span style='color: red;'>「借入額」または「毎月返済額」に数値を入力してください。</span>";
    }
}
elseif (!empty($_POST))
{
    $out = "<span style='color: red;'>返済期間（年）と年利率（%）を正しく入力してください。</span>";
}

echo <<<_END
<!doctype html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ローン計算機</title>
    <style>
      body { font-family: sans-serif; margin: 30px; line-height: 1.6; }
      pre { font-family: monospace; background: #f4f4f4; padding: 15px; border-radius: 5px; width: fit-content; }
      .result { margin-top: 15px; padding: 12px 18px; background: #eef7ff; border-left: 4px solid #007bff; width: fit-content; border-radius: 4px; }
      .notes { background: #fff8e1; border-left: 4px solid #ffc107; padding: 10px 15px; margin: 15px 0; font-size: 13px; color: #555; border-radius: 4px; width: fit-content; max-width: 500px; }
      .notes ul { margin: 5px 0 0 20px; padding: 0; }
      .notes li { margin-bottom: 4px; }
      input[type="submit"] { cursor: pointer; padding: 6px 14px; margin-top: 8px; font-size: 14px; }
    </style>
  </head>
  <body>
    <h2>ローン計算機</h2>
    <p>「借入額」を入力して毎月返済額を計算するか、「毎月返済額」を入力して借入可能額を計算します。</p>

    <div class="notes">
      <strong>【入力の注意事項】</strong>
      <ul>
        <li><strong>「借入額」</strong> または <strong>「毎月返済額」</strong> のどちらか一方を入力してください（両方入力した場合は借入額の計算が優先されます）。</li>
        <li>金額は半角数字で入力してください（桁区切りのカンマは自動入力されます）。</li>
        <li><strong>「返済期間」</strong> と <strong>「年利率」</strong> は必須です（0より大きい数値を指定してください）。</li>
      </ul>
    </div>

    <form method="post" action="calc.php">
      <pre>
    借入額 (円)       <input type="text" id="principal" name="principal" value="$principal" placeholder="例: 30,000,000">
    毎月返済額 (円)   <input type="text" id="monthly" name="monthly" value="$monthly" placeholder="例: 100,000">
    返済期間 (年)     <input type="text" id="years" name="years" value="$years">
    年利率 (%)        <input type="text" id="interest" name="interest" value="$interest">
    <input type="submit" value="計算する">
      </pre>
    </form>
_END;

if ($out !== '') {
    echo "<div class='result'><h3>計算結果 (PHP)</h3>" . $out . "</div>";
}

echo <<<_END
    <p><a href="03.html">&laquo; 03.html へ戻る</a></p>

    <script>
      function formatNumberWithCommas(val) {
        if (!val) return '';
        const clean = val.toString().replace(/[^0-9.]/g, '');
        const parts = clean.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return parts.join('.');
      }

      function attachCommaFormatter(inputElem) {
        if (!inputElem) return;
        inputElem.addEventListener('input', function() {
          const start = this.selectionStart;
          const oldLen = this.value.length;
          const formatted = formatNumberWithCommas(this.value);
          this.value = formatted;
          const newLen = formatted.length;
          const newCursor = Math.max(0, start + (newLen - oldLen));
          this.setSelectionRange(newCursor, newCursor);
        });
      }

      attachCommaFormatter(document.getElementById('principal'));
      attachCommaFormatter(document.getElementById('monthly'));
    </script>
  </body>
</html>
_END;

function sanitizeString($var)
{
    if (function_exists('get_magic_quotes_gpc') && @get_magic_quotes_gpc()) {
        $var = stripslashes($var);
    }
    $var = htmlentities($var, ENT_QUOTES, 'UTF-8');
    $var = strip_tags($var);
    return trim($var);
}
?>
