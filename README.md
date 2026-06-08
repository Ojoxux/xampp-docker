# XAMPP on Docker

XAMPP相当の環境(Apache + PHP + MySQL + phpMyAdmin)をDocker Composeで立ち上げる。

## クイックスタート

```bash
docker compose build   # 初回 or Dockerfile 変更時
docker compose up -d
```

| サービス   | URL                   |
| ---------- | --------------------- |
| Web        | http://localhost:8080 |
| phpMyAdmin | http://localhost:8081 |
