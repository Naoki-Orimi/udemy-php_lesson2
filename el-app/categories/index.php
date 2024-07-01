<?php
/**
 * 概要：カテゴリー一覧を表示する
 * 
 * 処理概要：
 * PDOインスタンス生成と、取得処理
 */

try {
    $complete = filter_input(INPUT_GET, 'cmp', FILTER_VALIDATE_INT);
    $dsn = "sqlite:../../eldb.sqlite3";
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, null, null, $options);

    $sql = "select id, title from categories order by id";
    $ps = $pdo->prepare($sql);
    $ps->execute();
    $categories = $ps->fetchAll();
} catch (PDOException $e) {
    error_log("PDOException: ", $e->getMessage());
    header("Location: error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP DB</title>
    <link rel="stylesheet" href="./design.css">
</head>
<body>
    <h3>Categories - Index</h3>
    <hr>
    <?php if ($complete === 1): ?>
        <script>
            alert('登録が完了しました。');
        </script>
    <?php elseif ($complete === 2): ?>
        <script>
            alert('削除が完了しました。');
        </script>
    <?php endif; ?>
    <table border="1" class="table-design">
        <tr>
            <th>ID</th>
            <th>TITLE</th>
            <th>SHOW</th>
            <th>EDIT</th>
            <th>DELETE</th>
        </tr>
        <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= htmlspecialchars($category['id'])?></td>
            <td><?= htmlspecialchars($category['title'])?></td>
            <td><a href="./show.php?id=<?= htmlspecialchars($category['id'])?>">SHOW</a></td>
            <td><a href="./edit.php?id=<?= htmlspecialchars($category['id'])?>">EDIT</a></td>
            <form action="./destroy.php" method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($category['id'])?>">
                <td><button type="submit">DELETE</button></td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="./create.php">NEW</a>
</body>
</html>