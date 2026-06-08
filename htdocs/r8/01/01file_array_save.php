<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>配列保存の失敗例</title>
</head>
<body>

<h1>配列をそのまま保存してみる</h1>

<?php
    $file = "array.txt";
    $data = ["山田", 20];

    file_put_contents($file, $data);

    echo "<p>保存しました (?)</p>";
    echo "<h2>中身</h2>";

    if (file_exists($file)){
        echo file_get_contents($file);
    }
?>