<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ファイル読み込み</title>
</head>
<body>

<h1>ファイル読み込みサンプル</h1>

<?php
$file = "test.txt";
// file is exists
if (file_exists($file)) {
    $data = file_get_contents($file);
    echo "<h2>ファイルの内容</h2>";
    echo nl2br($data);
} else {
    echo "<p>ファイルが存在しません。</p>";
}
?>

</body>
</html>
