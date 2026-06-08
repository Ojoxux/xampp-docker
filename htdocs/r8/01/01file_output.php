<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メモ保存</title>
</head>
<body>

<h1>メモ保存</h1>

<form method="post">
    <input type="text" name="memo">
    <button type="submit">保存</button>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $memo = $_POST["memo"];
    file_put_contents("memo.txt", $memo . "\n", FILE_APPEND);
    echo "<p>メモが保存されました。</p>";
} ?>

</body>
</html>
