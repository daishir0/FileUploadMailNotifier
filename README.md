## Overview
FileUploadMailNotifier is a simple PHP-based file upload system with email notifications using Gmail SMTP. When users upload files through the web interface, the system automatically sends email notifications to the specified Gmail address.

## Installation
1. Clone the repository
```bash
git clone https://github.com/daishir0/FileUploadMailNotifier.git
cd FileUploadMailNotifier
```

2. Install Composer and dependencies
### For rental servers
```bash
# Download composer.phar to current directory
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

# Create composer.json
cat > composer.json << 'EOF'
{
    "require": {
        "phpmailer/phpmailer": "^6.8"
    }
}
EOF

# Install dependencies
php composer.phar install
```

### For local environment
```bash
composer require phpmailer/phpmailer
```

3. Configure Gmail settings in index.php
```php
$gmail_user = 'your_addr@gmail.com';
$gmail_app_password = 'your_app_password';
$to_email = 'your_addr@gmail.com';
```

## Usage
1. Start your PHP server (for local environment)
```bash
php -S localhost:8000
```

2. Access the application through your web browser
3. Select a file using the upload form
4. Click the upload button
5. You will receive an email notification when the file is uploaded successfully

## Notes
- Make sure to enable "Less secure app access" or generate an App Password in your Gmail account
- The upload directory (`uploads/`) must be writable by the web server
- Maximum file size is limited by your PHP configuration (`upload_max_filesize` in php.ini)

## License
This project is licensed under the MIT License - see the LICENSE file for details.

---

# FileUploadMailNotifier
## 概要
FileUploadMailNotifierは、Gmail SMTPを使用してメール通知機能を備えたシンプルなPHPベースのファイルアップロードシステムです。ユーザーがWebインターフェースを通じてファイルをアップロードすると、指定したGmailアドレスに自動的に通知メールが送信されます。

## インストール方法
1. レポジトリをクローン
```bash
git clone https://github.com/daishir0/FileUploadMailNotifier.git
cd FileUploadMailNotifier
```

2. Composerと依存関係のインストール
### レンタルサーバーの場合
```bash
# カレントディレクトリにcomposer.pharをダウンロード
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

# composer.jsonの作成
cat > composer.json << 'EOF'
{
    "require": {
        "phpmailer/phpmailer": "^6.8"
    }
}
EOF

# 依存関係のインストール
php composer.phar install
```

### ローカル環境の場合
```bash
composer require phpmailer/phpmailer
```

3. index.phpでのGmail設定の構成
```php
$gmail_user = 'your_addr@gmail.com';
$gmail_app_password = 'your_app_password';
$to_email = 'your_addr@gmail.com';
```

## 使い方
1. PHPサーバーを起動（ローカル環境の場合）
```bash
php -S localhost:8000
```

2. Webブラウザでアプリケーションにアクセス
3. アップロードフォームでファイルを選択
4. アップロードボタンをクリック
5. ファイルが正常にアップロードされると、メール通知が届きます

## 注意点
- Gmailアカウントで「安全性の低いアプリのアクセス」を有効にするか、アプリパスワードを生成する必要があります
- アップロードディレクトリ（`uploads/`）はWebサーバーから書き込み可能である必要があります
- 最大ファイルサイズはPHPの設定（php.iniの`upload_max_filesize`）によって制限されます

## ライセンス
このプロジェクトはMITライセンスの下でライセンスされています。詳細はLICENSEファイルを参照してください。
