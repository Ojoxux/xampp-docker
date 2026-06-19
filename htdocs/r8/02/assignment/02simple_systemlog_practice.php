<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ログイン記録</title>
</head>
<body>

    <h1>ログイン記録</h1>

    <form method="post">
        名前: <input type="text" name="name">
        <button type="submit">ログイン</button>
    </form>

    <hr>

    <?php
    $file = "log.json";

    if (file_exists($file)) {
        $json = file_get_contents($file);
        $data = json_decode($json, true);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST["name"];

        if (!empty($name)) {
            $log = [
                "date" => date("Y-m-d H:i:s"),
                "name" => $name,
                "action" => "login",
            ];

            $data[] = $log;
            $json = json_encode($data, JSON_UNESCAPED_UNICODE);
            file_put_contents($file, $json);

            echo "<p>ログインを記録しました</p>";
        }
    }

    $cnt = 0;
    foreach ($data as $log) {
        $cnt++;
    }

    echo "<h2>ログ総件数: " . $cnt . "</h2>";

    if ($cnt > 0) {
        echo "<ul>";
        $num = 0;
        foreach ($data as $log) {
            $num++;
            if ($num > $cnt - 5) {
                echo "<li>" .
                    $log["date"] .
                    " / " .
                    $log["name"] .
                    " / " .
                    $log["action"] .
                    "</li>";
            }
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
