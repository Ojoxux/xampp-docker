# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## 概要

XAMPP 相当の開発環境を Docker Compose で再現したもの。`web`(Apache + PHP 8.2)・`db`(MySQL 8.0)・`phpmyadmin` の 3 サービス構成。ホスト側ポートと DB 認証情報はすべて `.env` で管理する。

## サービス一覧

| サービス     | イメージ                          | URL / ポート              |
| ------------ | --------------------------------- | ------------------------- |
| `web`        | `php:8.2-apache` (+拡張 / 自前ビルド) | http://localhost:8080     |
| `db`         | `mysql:8.0`                       | localhost:3307            |
| `phpmyadmin` | `phpmyadmin/phpmyadmin`           | http://localhost:8081     |

ポートや DB 認証情報は `.env` で変更できる。

## よく使うコマンド

```bash
# 初回 / Dockerfile を変更したとき
docker compose build

# 起動 / 停止
docker compose up -d
docker compose stop          # コンテナは残す
docker compose down          # コンテナ削除(DB ボリュームは残る)
docker compose down -v       # DB データごと削除(initdb を再実行したいとき)

# ログ確認 / コンテナ内シェル
docker compose logs -f web
docker exec -it xampp-web bash
docker exec -it xampp-db mysql -uroot -proot

# 単発 PHP / Composer 実行
docker compose exec web php -v
docker compose exec web php htdocs/somefile.php
```

## アーキテクチャ要点

- **`web` コンテナ**: `php:8.2-apache` を `php/Dockerfile` で拡張。`mysqli` / `pdo_mysql` / `mbstring` / `gd` / `zip` を `docker-php-ext-install` で導入し、`a2enmod rewrite` で `.htaccess` を有効化。タイムゾーンとアップロード上限は `/usr/local/etc/php/conf.d/*.ini` で投入している。PHP 拡張や `.ini` を増やすときは Dockerfile を編集して `docker compose build` し直す。
- **bind mount による即時反映**: `./htdocs` は `/var/www/html` に bind mount されており、PHP ファイルの編集はリビルド不要で反映される(XAMPP の `htdocs` と同じ感覚)。逆に PHP 拡張・Apache モジュール・`.ini` の変更は再ビルドが必要。
- **`db` コンテナ**: 公式 `mysql:8.0`。データは named volume `db_data` に永続化。`./mysql/conf.d/` がそのまま `/etc/mysql/conf.d/` にマウントされ、`utf8mb4` / JST 設定が効く。`./mysql/initdb/` の `.sql` / `.sh` は **DB ボリュームが空のときの初回起動でのみ** 自動実行される。スキーマを作り直したいときは必ず `docker compose down -v` を挟むこと。
- **サービス間通信**: コンテナ内からは MySQL に対して `host=db, port=3306` で接続する(`docker-compose.yml` 内の Compose ネットワーク名)。ホスト側 GUI ツールから接続するときだけ `127.0.0.1:${DB_PORT}` を使う。
- **phpMyAdmin**: 別コンテナ。`PMA_HOST=db` で `db` サービスへ自動接続。XAMPP のように Apache 配下 URL ではなく、独立ポート(デフォルト 8081)で開く。

## ポート設定と衝突回避

ホスト側ポートはすべて `.env` で上書き可能(`WEB_PORT` / `PMA_PORT` / `DB_PORT`)。デフォルトでは `DB_PORT=3307` を採用しており、これは隣接ディレクトリ `../sql-class-env` の MySQL コンテナがホスト 3306 を掴むケースを避けるため。新しい MySQL コンテナを追加するときも同様にポート衝突を確認する。

## DB 認証情報

`.env` で定義:

- `MYSQL_ROOT_PASSWORD` (root)
- `MYSQL_DATABASE` / `MYSQL_USER` / `MYSQL_PASSWORD`(アプリ用ユーザ)

`web` コンテナには `DB_HOST` / `DB_PORT` / `DB_NAME` / `DB_USER` / `DB_PASSWORD` として注入される。PHP コードはこの環境変数経由で接続する想定(`htdocs/index.php` がリファレンス実装)。

## アーキ依存に関する注意

Apple Silicon 環境では `phpmyadmin/phpmyadmin` の amd64 イメージが引かれ、platform 警告が出るが Rosetta 経由で正常動作する。挙動に問題が出たときだけ `platform` 指定の追加を検討する。
