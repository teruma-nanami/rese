# rese
飲食店管理システム

## 作成した目的
模擬案件を通して実践に近い開発経験をつむ

## アプリケーションURL
http://affiliate-pilotage.com/rese  
fakerにて作成したパスワードはすべて「password」に統一されています

## 機能一覧
- ログイン機能
- 新規会員登録機能
- Remember Me機能
- メール認証
- パスワード再設定機能
- ユーザー機能一覧
    - 飲食店予約機能
    - 飲食店お気に入り登録・解除機能
    - 飲食店レビュー機能
- オーナー機能一覧
    - 予約管理機能
    - レストラン新規追加機能
    - レストラン編集・削除機能
- 管理者機能一覧
    - オーナー役割変更機能
    - レストラン新規追加機能
    - レストラン編集・削除機能

## 使用技術(実行環境)

- php 7.4.9
- Laravel 8.83
- MySQL 8.0

## テーブル設計
| ユーザー | users |  |  |  |  |
| --- | --- | --- | --- | --- | --- |
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| ID | bigint unsigned | ◯ |  |  |  |
| name | varchar(255) |  |  | ◯ |  |
| email | varchar(255) |  | ◯ | ◯ |  |
| email_verified_at | varchar(255) |  | ◯ | ◯ |  |
| password | varchar(255) |  |  | ◯ |  |
| password_digest | varchar(255) |  |  | ◯ |  |
| created_at | timestamp |  |  |  |  |
| update_at | timestamp |  |  |  |  |


| 勤怠 | attendances |  |  |  |  |
| --- | --- | --- | --- | --- | --- |
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| ID | bigint unsigned | ◯ |  |  |  |
| user_id | bigint unsigned |  |  | ◯ | users(id) |
| date | date |  |  | ◯ |  |
| check_in | dateTime |  |  | ◯ |  |
| check_out | dateTime |  |  | ◯ |  |
| created_at | timestamp |  |  |  |  |
| update_at | timestamp |  |  |  |  |


| 休憩 | breaks |  |  |  |  |
| --- | --- | --- | --- | --- | --- |
| 列名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| ID | bigint unsigned | ◯ |  |  |  |
| attendance_id | bigint unsigned |  |  | ◯ | attendance(id) |
| break_start | datetime |  |  | ◯ |  |
| break_end | datetime |  |  | ◯ |  |
| created_at | timestamp |  |  |  |  |
| update_at | timestamp |  |  |  |  |

## ER図
![alt text](image.png)

## 環境構築

### Dockerビルド

1. git clone git@github.com:teruma-nanami/rese
1. docker compose up -d --build

### Laravel環境構築
1. docker composer exec php bash
1. composer install
1. .env.example ファイルから.envを作成し、環境変数を変更
1. php artisan key:generate
1. php artisan migrate
1. php artisan db:seed

### RememberUserでエラーが発生したとき
Features.phpクラスにremember-usersを追加します。
vendor/laravel/fortify/src/Features.phpにあるFeaturesクラスを確認
```
    public static function rememberUsers()
    {
        return 'remember-users';
    }
```
上記を追加してください