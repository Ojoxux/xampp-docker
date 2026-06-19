<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>JSONログ</title>
</head>
<body>

    <h1>JSONログ記録</h1>

    <form method="post">
        名前: <input type="text" name="name">
        <button type="submit">ログイン</button>
    </form>

    <?php
        $file = "log.json";

        if (!file_exists($file)) {
            file_put_contents($file, json_encode([], JSON_UNESCAPED_UNICODE));
        }

        $data = json_decode(file_get_contents($file), true);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST["name"];

            if (!empty($name)) {
                $log = [
                    "date" => date("Y-m-d H:i:s"),
                    "name" => $name,
                    "action" => "login",
                ];

                $data[] = $log;

                file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE));

                echo "<p>ログを記録しました</p>";
            }
        }
    ?>
</body>
</html>