<?php
declare(strict_types=1);

$host = getenv('DB_HOST') ?: 'db';
$port = (int)(getenv('DB_PORT') ?: 3306);
$db   = getenv('DB_NAME') ?: 'app';
$user = getenv('DB_USER') ?: 'app';
$pass = getenv('DB_PASSWORD') ?: 'app';

$dbStatus = 'NG';
$dbMessage = '';
try {
    $pdo = new PDO(
        "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    $dbStatus = 'OK';
    $dbMessage = "MySQL {$version}";
} catch (PDOException $e) {
    $dbMessage = $e->getMessage();
}
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>XAMPP on Docker</title>
<style>
  body { font-family: -apple-system, system-ui, sans-serif; max-width: 720px; margin: 2rem auto; padding: 0 1rem; }
  .ok { color: #0a7a2b; } .ng { color: #b00020; }
  table { border-collapse: collapse; } td, th { border: 1px solid #ccc; padding: .4rem .8rem; text-align: left; }
  code { background: #f3f3f3; padding: 0 .3rem; border-radius: 3px; }
</style>
</head>
<body>
  <h1>XAMPP on Docker</h1>
  <p>Apache + PHP <?= htmlspecialchars(PHP_VERSION) ?> が動作しています。</p>

  <h2>DB 接続テスト</h2>
  <table>
    <tr><th>Host</th><td><?= htmlspecialchars($host) ?>:<?= $port ?></td></tr>
    <tr><th>Database</th><td><?= htmlspecialchars($db) ?></td></tr>
    <tr><th>User</th><td><?= htmlspecialchars($user) ?></td></tr>
    <tr><th>Status</th>
      <td class="<?= $dbStatus === 'OK' ? 'ok' : 'ng' ?>">
        <?= $dbStatus ?> — <?= htmlspecialchars($dbMessage) ?>
      </td></tr>
  </table>

  <h2>リンク</h2>
  <ul>
    <li>phpMyAdmin: <a href="http://localhost:8081">http://localhost:8081</a></li>
    <li>phpinfo: <a href="phpinfo.php">phpinfo.php</a></li>
  </ul>

  <p>このページを編集するには <code>htdocs/index.php</code> を変更してください。</p>
</body>
</html>
