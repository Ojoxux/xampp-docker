<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ログ保存</title>
</head>
<body>
    <h1>ログを保存する</h1>

    <form method="post">
        名前: <input type="text" name="name">
        <button type="submit">保存</button>
    </form>

    <hr>

    <?php
    $file = "log.txt";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];

        if (!empty($name)) {
            $date = date("Y-m-d H:i:s");

            $log = $date . " / " . $name . " / login\n";
            file_put_contents($file, $log, FILE_APPEND);

            echo "<p>ログを保存しました。</p>";
        }
    }

    echo "<h2>ログ一覧</h2>";

    if (file_exists($file)) {
        $logs = file($file);
        echo "<ul>";
        foreach ($logs as $log) {
            echo "<li>" . $log . "</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
