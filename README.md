# rese
飲食店管理システム

## 作成した目的
模擬案件を通して実践に近い開発経験をつむ

## アプリケーションURL
https://rese.nanami-teruma.com/  
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
    - 評価によるソート機能
        - ランダム
        - 評価の高い順
        - 評価の低い順（評価がないレストランは最後尾に表示）
- オーナー機能一覧
    - 予約管理機能
    - レストラン新規追加機能
    - レストラン編集・削除機能
- 管理者機能一覧
    - オーナー役割変更機能
    - レストラン新規追加機能
    - レストラン編集・削除機能
    - CSVファイルのインポート

## 使用技術(実行環境)

- php 7.4.9
- Laravel 8.83
- MySQL 8.0

## テーブル設計
### ユーザーテーブル
| ユーザー | users |  |  |  |  |
| --- | --- | --- | --- | --- | --- |
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| id | bigint unsigned | ◯ |  |  |  |
| name | varchar(255) |  |  | ◯ |  |
| email | varchar(255) |  | ◯ | ◯ |  |
| email_verified_at | timestamp |  |  |  |  |
| phone_number | varchar(255) |  |  |  |  |
| password | varchar(255) |  |  | ◯ |  |
| password_digest | varchar(255) |  |  | ◯ |  |
| role | enum('customer', 'restaurant_owner', 'admin') |  |  | ◯ |  |
| remember_token | varchar(100) |  |  |  |  |
| created_at | timestamp |  |  | ◯ |  |
| updated_at | timestamp |  |  | ◯ |  |


### レストランテーブル
| レストラン | restaurants |  |  |  |  |
| --- | --- | --- | --- | --- | --- |
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| id | bigint unsigned | ◯ |  |  |  |
| name | varchar(255) |  |  | ◯ |  |
| address | varchar(255) |  |  | ◯ |  |
| phone_number | varchar(255) |  |  | ◯ |  |
| image_url | varchar(255) |  |  |  |  |
| email | varchar(255) |  |  |  |  |
| area | varchar(255) |  |  | ◯ |  |
| cuisine_type | varchar(255) |  |  | ◯ |  |
| owner_id | bigint unsigned |  |  | ◯ | ◯ (users.id) |
| created_at | timestamp |  |  | ◯ |  |
| updated_at | timestamp |  |  | ◯ |  |

### 予約テーブル
| 予約 | reservations |  |  |  |  |
| --- | --- | --- | --- | --- | --- |
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| id | bigint unsigned | ◯ |  |  |  |
| user_id | bigint unsigned |  |  | ◯ | ◯ (users.id) |
| restaurant_id | bigint unsigned |  |  | ◯ | ◯ (restaurants.id) |
| reservation_date | date |  |  | ◯ |  |
| reservation_time | time |  |  | ◯ |  |
| number_of_people | integer |  |  | ◯ |  |
| special_requests | text |  |  |  |  |
| status | enum('pending', 'confirmed', 'completed', 'cancelled') |  |  | ◯ |  |
| created_at | timestamp |  |  | ◯ |  |
| updated_at | timestamp |  |  | ◯ |  |

### レビューテーブル
| レビュー | reviews |  |  |  |  |
| --- | --- | --- | --- | --- | --- |
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| id | bigint unsigned | ◯ |  |  |  |
| user_id | bigint unsigned |  |  | ◯ | ◯ (users.id) |
| restaurant_id | bigint unsigned |  |  | ◯ | ◯ (restaurants.id) |
| rating | integer |  |  | ◯ |  |
| comment | text |  |  |  |  |
| review_date | date |  |  | ◯ |  |
| created_at | timestamp |  |  | ◯ |  |
| updated_at | timestamp |  |  | ◯ |  |

### お気に入りテーブル
| お気に入り | favorites |  |  |  |  |
| --- | --- | --- | --- | --- | --- |
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| id | bigint unsigned | ◯ |  |  |  |
| user_id | bigint unsigned |  |  | ◯ | ◯ (users.id) |
| restaurant_id | bigint unsigned |  |  | ◯ | ◯ (restaurants.id) |
| created_at | timestamp |  |  | ◯ |  |
| updated_at | timestamp |  |  | ◯ |  |


## ER図
![ER図](https://github.com/teruma-nanami/rese/blob/main/docs/diagrams/rese.png)

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
1. php artisan storage:link

### mailhogの環境構築
.envファイルを以下のように変更してください。

```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

mailhogの起動確認についてはブラウザで http://localhost:8025 にアクセスし、MailHogのWebインターフェースが表示されることを確認します。

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

## インポート用CSVファイルのフォーマット

インポートするCSVファイルは、以下のフォーマットに従って記述してください。


各列の説明は以下の通りです：

- **name**: レストランの名前（例: "Restaurant A"）
- **post_code**: 郵便番号（例: "123-4567"）
- **address**: 住所（例: "Tokyo"）
- **phone_number**: 電話番号（例: "03-1234-5678"）
- **image_url**: 画像URL（例: "img/sample.png"）
- **email**: メールアドレス（例: "restaurantA@example.com"）
- **area_id**: エリアID（例: 1）
  - 1: エリア1
  - 2: エリア2
  - 3: エリア3
- **cuisine_type_id**: 料理の種類ID（例: 1）
  - 1: 和食
  - 2: 洋食
  - 3: 中華
  - 4: イタリアン
  - 5: その他
- **detail**: 詳細（例: "Delicious food!"）
- **owner_id**: オーナーID（例: 1）

### サンプルCSVファイル

以下は、インポートするCSVファイルのサンプルです。

```csv
name,post_code,address,phone_number,image_url,email,area_id,cuisine_type_id,detail,owner_id
Restaurant A,123-4567,Tokyo,03-1234-5678,img/sample.png,restaurantA@example.com,1,1,Delicious food!,1
Restaurant B,987-6543,Osaka,06-9876-5432,img/sample.png,restaurantB@example.com,2,2,Famous for its sushi!,2
