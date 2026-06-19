<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>アクセスログ</title>
</head>
<body>

    <h1>アクセスログ</h1>

    <?php
        $file = "access.log";

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $date = date("Y-m-d H:i:s");
            $log = $date . " / " . "アクセス\n";
            file_put_contents($file, $log, FILE_APPEND);

            echo "<p>アクセスを記録しました</p>";
        }

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