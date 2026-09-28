<?php

// 10.php (温度変換スクリプト)
$f = $c = '';
$out = '';
$converted_val = '';
$direction = '';

if (isset($_POST['f'])) {
    $f = sanitizeString($_POST['f']);
}
if (isset($_POST['c'])) {
    $c = sanitizeString($_POST['c']);
}

if (is_numeric($f)) {
    $c_calc = round((5 / 9) * ($f - 32), 1);
    $out = "華氏 <strong>{$f}&deg;F</strong> は 摂氏 <strong class='highlight'>{$c_calc}&deg;C</strong> です";
    $c = $c_calc;
} elseif (is_numeric($c)) {
    $f_calc = round((9 / 5) * $c + 32, 1);
    $out = "摂氏 <strong>{$c}&deg;C</strong> は 華氏 <strong class='highlight'>{$f_calc}&deg;F</strong> です";
    $f = $f_calc;
}

$resultHtml = '';
if ($out !== '') {
    $resultHtml = <<<RESULT
    <div class="result-card">
      <div class="result-icon">🌡️</div>
      <div class="result-text">
        <div class="result-label">変換結果</div>
        <div class="result-value">$out</div>
      </div>
    </div>
RESULT;
}

echo <<<_END
<!doctype html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>温度変換器 (摂氏・華氏) - 10.php</title>
    <style>
      :root {
        --primary: #3b82f6;
        --primary-hover: #2563eb;
        --bg-gradient: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
        --card-bg: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-color: #cbd5e1;
      }

      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        background: var(--bg-gradient);
        color: var(--text-main);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }

      .container {
        width: 100%;
        max-width: 480px;
        background: var(--card-bg);
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        padding: 32px;
        transition: transform 0.2s ease;
      }

      .header {
        text-align: center;
        margin-bottom: 24px;
      }

      .header-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 56px;
        height: 56px;
        background: #eff6ff;
        color: var(--primary);
        font-size: 28px;
        border-radius: 50%;
        margin-bottom: 12px;
      }

      h1 {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 6px;
      }

      .description {
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.5;
      }

      .form-grid {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
      }

      .input-group {
        display: flex;
        flex-direction: column;
      }

      .input-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 6px;
      }

      .input-wrapper {
        position: relative;
      }

      .input-field {
        width: 100%;
        padding: 12px 36px 12px 12px;
        border: 1.5px solid var(--border-color);
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        color: var(--text-main);
        outline: none;
        transition: all 0.2s ease;
      }

      .input-field:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
      }

      .unit-badge {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
        font-weight: 600;
        color: var(--text-muted);
        pointer-events: none;
      }

      .swap-icon {
        font-size: 20px;
        color: var(--text-muted);
        margin-top: 20px;
        text-align: center;
      }

      .btn-submit {
        width: 100%;
        padding: 12px;
        background: var(--primary);
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.1s ease;
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);
      }

      .btn-submit:hover {
        background: var(--primary-hover);
        transform: translateY(-1px);
      }

      .btn-submit:active {
        transform: translateY(0);
      }

      .result-card {
        margin-top: 24px;
        padding: 16px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: fadeIn 0.3s ease-in-out;
      }

      .result-icon {
        font-size: 24px;
      }

      .result-label {
        font-size: 12px;
        font-weight: 600;
        color: #166534;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .result-value {
        font-size: 15px;
        color: #14532d;
        margin-top: 2px;
      }

      .result-value .highlight {
        font-size: 17px;
        color: #047857;
      }

      .formula-footer {
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px dashed var(--border-color);
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.6;
        text-align: center;
      }

      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <div class="header-icon">🌡️</div>
        <h1>温度変換器</h1>
        <p class="description">華氏（&deg;F）または摂氏（&deg;C）のどちらかを入力して変換します</p>
      </div>

      <form method="post" action="10.php">
        <div class="form-grid">
          <div class="input-group">
            <label class="input-label" for="input-f">華氏 (Fahrenheit)</label>
            <div class="input-wrapper">
              <input type="text" id="input-f" class="input-field" name="f" value="$f" placeholder="例: 77">
              <span class="unit-badge">&deg;F</span>
            </div>
          </div>

          <div class="swap-icon">⇄</div>

          <div class="input-group">
            <label class="input-label" for="input-c">摂氏 (Celsius)</label>
            <div class="input-wrapper">
              <input type="text" id="input-c" class="input-field" name="c" value="$c" placeholder="例: 25">
              <span class="unit-badge">&deg;C</span>
            </div>
          </div>
        </div>

        <input type="submit" class="btn-submit" value="温度を変換する">
      </form>

      $resultHtml

      <div class="formula-footer">
        <div><strong>計算式</strong></div>
        <div>摂氏 &deg;C = (&deg;F - 32) &times; 5/9</div>
        <div>華氏 &deg;F = (&deg;C &times; 9/5) + 32</div>
      </div>
    </div>
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
