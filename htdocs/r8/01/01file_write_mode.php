<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>上書きと追記</title>
</head>
<body>

<h1>上書き vs 追記</h1>

<form method="post">
    <input type="text" name="memo">
    <button name="mode" value="overwrite">上書き</button>
    <button name="mode" value="append">追記</button>
</form>

<?php 
$file = "memo.txt";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $memo = $_POST["memo"];
    $mode = $_POST["mode"];

    if(!empty($memo)){
        switch($mode) {
            case $mode == "overwrite":
                file_put_contents("memo.txt", $memo . "\n");
                echo "<p>上書きしました</p>";
                break;
            default:
                file_put_contents("memo.txt", $memo . "\n", FILE_APPEND);
                echo "<p>追記しました</p>"; 
        }
    }

    // ifの場合
    /*
     if (!empty($memo)) {
        if ($mode == "overwrite") {
            file_put_contents("memo.txt", $memo . "\n");
            echo "<p>上書きしました</p>";
        } else {
            file_put_contents("memo.txt", $memo . "\n", FILE_APPEND);
            echo "<p>追記しました</p>"; 
        }
     }
    */

    if (file_exists($file)) {
        //$data = file_get_contents($file);
        // file_get_contentsはstringとboolのオブジェクトを返す
        echo "<h2>現在の状態</h2>";
        echo nl2br(file_get_contents($file));
    }
}
?>