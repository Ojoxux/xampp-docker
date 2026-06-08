<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録(JSON)</title>

<body>
<h1>ユーザー登録(JSON)</h1>

<form method="post">
    <p>名前: <input type="text" name="name"></p>
    <p>年齢: <input type="text" name="age"></p>
    <button type="submit">登録</button>
</form>

<h2>ユーザー一覧</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];

    if (file_exists("practice_data.json")) {
        $existing = file_get_contents("practice_data.json");
        $data = json_decode($existing, true);
    } else {
        $data = [];
    }
    $data[] = ["name" => $name, "age" => $age];
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    file_put_contents("practice_data.json", $json);
    echo "<p>登録しました</p>";
}

if (file_exists("practice_data.json")) {
    $json = file_get_contents("practice_data.json");
    $data = json_decode($json, true);
    foreach ($data as $user) {
        echo "名前:" . $user["name"] . " 年齢:" . $user["age"] . "<br>";
    }
}
?>

</body>
</head>
