<?php // login.php

/**
 * .envファイルを読み込んで環境変数を設定する関数
 * @param string $path
 */
function loadEnv($path)
{
    if (!file_exists($path)) {
        return;
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        // 空行またはコメント行をスキップ
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        if (str_contains($line, '=')) {
            list($key, $val) = explode('=', $line, 2);
            $key = trim($key);
            $val = trim($val);
            // 前後のクォートを削除
            $val = trim($val, "\"'");
            $_ENV[$key] = $val;
            putenv("$key=$val");
        }
    }
}

// プロジェクトルートまたは同階層の .env を探索
$envCandidates = [
    __DIR__ . '/.env',
    __DIR__ . '/../.env',
];

foreach ($envCandidates as $candidate) {
    if (file_exists($candidate)) {
        loadEnv($candidate);
        break;
    }
}

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
