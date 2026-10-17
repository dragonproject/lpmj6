<?php

// 厳格な型チェックモードを有効化
declare(strict_types=1);

/**
 * ==============================================================================
 * 07/16_modern.php: 安全でモダンな画像アップロード処理
 * ==============================================================================
 * 
 * 元の 16.php にあった以下の重大な問題を解決したモダン実装です：
 * 
 * 1. 【偽装MIMEタイプ対策】
 *    ユーザーから送られてくる $_FILES['...']['type'] は簡単に改ざんできます。
 *    ここでは PHP の Fileinfo 拡張（finfo）を使ってファイルの実体を直接解析します。
 * 
 * 2. 【XSS（クロスサイトスクリプティング）対策】
 *    アップロードされた元のファイル名を出力する際は、必ず htmlspecialchars でエスケープします。
 * 
 * 3. 【ファイル名衝突・上書き防止】
 *    固定の "image.$ext" ではなく、暗号学的に安全なランダム文字列（random_bytes）で命名します。
 * 
 * 4. 【PHP 8 match 式】
 *    switch 文を match 式に置き換え、厳格かつシンプルに拡張子を判定します。
 */

// HTML特殊文字のエスケープ関数（XSS対策の定番ヘルパー）
function h(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$message = '';
$uploadedImagePath = null;

// POSTリクエストかつファイルが送信されているか確認
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_FILES['image_file'])) {
    $file = $_FILES['image_file'];

    // 1. アップロード処理自体が成功したか（エラーコードの確認）
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $message = "アップロード中にエラーが発生しました（エラーコード: {$file['error']}）";
    } else {
        $tmpPath = $file['tmp_name'];
        $originalName = $file['name'];

        // 2. 【最重要セキュリティ】ファイルの実体バイナリから本物のMIMEタイプを検出
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($tmpPath);

        // 3. PHP 8 の match 式で許可する拡張子を厳格にマッピング
        $extension = match ($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp', // 現代のWeb標準である WebP もサポート
            default      => null,
        };

        if ($extension === null) {
            $message = "「" . h($originalName) . "」は許可されていないファイル形式です（検出されたMIMEタイプ: " . h((string)$mimeType) . "）";
        } else {
            // 4. ファイル名の衝突や既存画像の上書きを防ぐため、ランダムなファイル名を生成
            $newFileName = bin2hex(random_bytes(16)) . ".{$extension}";
            $destination = __DIR__ . "/{$newFileName}";

            // 一時保存場所から正規の保存先へファイルを移動
            if (move_uploaded_file($tmpPath, $destination)) {
                $message = "「" . h($originalName) . "」を正常にアップロードしました。";
                $uploadedImagePath = $newFileName;
            } else {
                $message = "ファイルの保存処理に失敗しました。";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>モダンで安全な画像アップロード</title>
</head>
<body>
    <h2>画像アップロード</h2>

    <form method="post" action="" enctype="multipart/form-data">
        <label for="image_file">画像を選択してください (JPG, PNG, GIF, WebP):</label><br><br>
        <input type="file" id="image_file" name="image_file" accept="image/jpeg,image/png,image/gif,image/webp" required>
        <button type="submit">アップロード</button>
    </form>

    <?php if ($message !== ''): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <?php if ($uploadedImagePath !== null): ?>
        <div>
            <h3>アップロードされた画像プレビュー:</h3>
            <img src="<?= h($uploadedImagePath) ?>" alt="アップロード画像" style="max-width: 300px; height: auto; border: 1px solid #ccc;">
        </div>
    <?php endif; ?>
</body>
</html>
