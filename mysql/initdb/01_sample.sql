-- 起動時に自動で取り込まれる初期 SQL のサンプル。
-- 不要なら削除してOK。新しい .sql / .sh を置けば初回起動時に実行される。

CREATE TABLE IF NOT EXISTS sample_users (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO sample_users (name) VALUES ('taro'), ('hanako');
