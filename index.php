<?php
// Composerのオートロード
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Gmail設定
$gmail_user = 'your_addr@gmail.com'; // Gmailアドレス
$gmail_app_password = 'your_app_password'; // Gmailアプリパスワード
$to_email = 'your_addr@gmail.com';

// アップロードディレクトリの設定
$upload_dir = 'uploads/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// ファイルアップロード処理
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $file_name = basename($file['name']);
    $target_path = $upload_dir . $file_name;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        try {
            // PHPMailerのセットアップ
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $gmail_user;
            $mail->Password = $gmail_app_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';

            // メール設定
            $mail->setFrom($gmail_user);
            $mail->addAddress($to_email);
            $mail->Subject = '新規ファイルアップロード通知';
            
            // メール本文
            $mail->Body = "新しいファイルがアップロードされました。\n"
                       . "ファイル名: {$file_name}\n";

            // メール送信
            $mail->send();
            $message = 'ファイルのアップロードが完了し、通知メールを送信しました。';
        } catch (Exception $e) {
            $message = 'メール送信に失敗しました: ' . $mail->ErrorInfo;
        }
    } else {
        $message = 'ファイルのアップロードに失敗しました。';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ファイルアップローダー</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .upload-form {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            background: #e3f2fd;
        }
        .file-list {
            list-style: none;
            padding: 0;
        }
        .file-list li {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background: #2196F3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #1976D2;
        }
    </style>
</head>
<body>
    <h1>ファイルアップローダー</h1>
    
    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <div class="upload-form">
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <input type="submit" value="アップロード">
        </form>
    </div>

</body>
</html> 
