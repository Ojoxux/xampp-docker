<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>JSON保存</title>

<body>
<h1>JSONでデータを保存</h1>

<?php
    $file = "array.txt";
    $data = ["name" => "山田", "age" => 20];

    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    
    file_put_contents("data.json", $json);

    echo "<p>保存しました</p>";
?>

</body>
</head>