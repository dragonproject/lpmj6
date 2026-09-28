<?php
// .env ファイルの読み込み（同ディレクトリまたはプロジェクトルート）
$envPath = file_exists(__DIR__ . '/.env') ? __DIR__ . '/.env' : __DIR__ . '/../.env';
if (file_exists($envPath)) {
  // .envファイルを読み込む
  $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    $line = trim($line);
    // 空行またはコメント行をスキップ
    if ($line === '' || str_starts_with($line, '#')) {
      continue;
    }
    // '='が含まれている行を処理
    if (str_contains($line, '=')) {
      // =で分割してキーと値を取得
      // 2番目以降の=は無視
      // 値の前後の空白と引用符を削除
      // explodeは第一引数に指定した文字列を、第二引数の文字列中の区切り文字で分割した配列を返す
      // 第三引数は最大分割数を指定する
      // listは配列を複数の変数に展開する
      // trimは第一引数の文字列の、第二引数で指定した文字で、前後の空白を削除する
      // ここで第三引数に2を指定することで、最初の=だけを区切り文字として扱う
      // list($key, $val) = explode('=', $line, 2);

      list($key, $val) = explode('=', $line, 2);
      // 前後の空白を削除
      $key = trim($key);
      // 値の前後の空白と引用符を削除
      $val = trim(trim($val), "\"'");
      // 環境変数を設定
      $_ENV[$key] = $val;
      putenv("$key=$val");
    }
  }
}

// .envから環境変数を取得
$host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?: 'localhost';
$data = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?: 'publications';
$user = $_ENV['DB_USER'] ?? getenv('DB_USER') ?: 'root';
$pass = $_ENV['DB_PASS'] ?? getenv('DB_PASS') ?: '';
$chrs = $_ENV['DB_CHARSET'] ?? getenv('DB_CHARSET') ?: 'utf8mb4';

$attr = "mysql:host=$host;dbname=$data;charset=$chrs";
$opts = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  $pdo = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
  throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$query  = "SELECT * FROM customers";
$result = $pdo->query($query);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>購入履歴一覧</title>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      padding: 30px;
      background-color: #f8fafc;
      color: #334155;
    }

    h1 {
      font-size: 1.5rem;
      margin-bottom: 20px;
      color: #1e293b;
    }

    table {
      width: 100%;
      max-width: 800px;
      border-collapse: collapse;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #e2e8f0;
    }

    th {
      background-color: #f1f5f9;
      font-weight: 600;
      color: #475569;
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:hover {
      background-color: #f8fafc;
    }

    .isbn {
      font-family: monospace;
      color: #64748b;
    }
  </style>
</head>

<body>

  <h1>📚 顧客の購入履歴</h1>

  <table>
    <thead>
      <tr>
        <th>購入者</th>
        <th>ISBN</th>
        <th>書籍名</th>
        <th>著者</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch()): ?>
        <?php
        // 購入者名とISBNを取得
        $custname = htmlspecialchars($row['name']);
        $custisbn = htmlspecialchars($row['isbn']);

        $subquery  = "SELECT * FROM classics WHERE isbn='$custisbn'";
        $subresult = $pdo->query($subquery);
        $subrow    = $subresult->fetch();

        $custbook  = $subrow ? htmlspecialchars($subrow['title']) : '（未登録）';
        $custauth  = $subrow ? htmlspecialchars($subrow['author']) : '—';
        ?>
        <tr>
          <td><strong><?= $custname ?></strong></td>
          <td class="isbn"><?= $custisbn ?></td>
          <td><?= $custbook ?></td>
          <td><?= $custauth ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</body>

</html>