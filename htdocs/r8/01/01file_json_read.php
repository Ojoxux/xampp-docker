<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>JSON読み込み</title>

<body>
<h1>JSONを読み込んで表示</h1>

<?php
    $json = file_get_contents("data.json");

    $data = json_decode($json);

    echo "名前:" . $data->name . "<br>";
    echo "年齢:" . $data->age;
?>

</body>
</head>