<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>JSON確認</title>

<body>
<h1>JSONとは</h1>

<?php
    $file = "array.txt";
    $data = ["name" => "山田", "age" => 20];

    $json = json_encode($data);

    echo "<h2>変換前(配列)</h2>";
    echo "<pre>";

    print_r($data);

    echo "<pre>";
    echo "<h2>変換後(JSON)</h2>";
    echo $json;
?>

</body>
</head>