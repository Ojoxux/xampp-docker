<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>簡易メモ帳</title>
</head>
<body>

<h1>簡易メモ帳</h1>

<form method="post">
    <input type="text" name="memo">
    <button type="submit">保存</button>
</form>


<h2>保存されたメモ</h2>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $memo = $_POST["memo"];
    file_put_contents("practice_memo.txt", $memo . "\n", FILE_APPEND);
    echo "<p>保存しました！</p>";
}

if (file_exists("practice_memo.txt")) {
    foreach (file("practice_memo.txt") as $memo) {
        // \nを<br>にエスケープさせるためにhtmlspecialcharsを使っている
        // nl2brでもできる
        // echo nl2br(file_get_contents("practice_memo.txt"));
        echo htmlspecialchars($memo) . "<br>";
    }
} else {
    echo "<p>メモがありません。</p>";
}


?>
