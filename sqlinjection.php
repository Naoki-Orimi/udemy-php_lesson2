<?php

$dsn = "sqlite:eldb.sqlite3";
$pdo = new PDO($dsn);

$id = filter_input(INPUT_GET, 'id');
if (empty($id)) {
    $id = 999;
}
// 以下の実装がヤバい。パラメータを文字列結合はアウトすぎる
$sql = "select id, title from categories where id = " . $id;
$st = $pdo->query($sql);
$rows = $st->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection Sample</title>
</head>
<body>
    <h3>Category - Seatch</h3>
    <hr>
    <ul>
        <?php foreach ($rows as $row) { ?>
            <li><?= htmlspecialchars($row['title']) ?></li>
        <?php } ?>
    </ul>
</body>
</html>