<?php
$id = (string)filter_input(INPUT_GET, 'id',);
if($id === "") {
    error_log("Validate: id is required.");
    header("Location: error.php");
    exit;
}
if(filter_var($id, FILTER_VALIDATE_INT) === false) {
    error_log("Validate: id must be int.");
    header("Location: error.php");
    exit;
}

try {
    $dsn = "sqlite:../../eldb.sqlite3";
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, null, null, $options);

    $sql = "select id, title from categories where id = :id";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(":id", $id, PDO::PARAM_INT);
    $ps->execute();
    $category = $ps->fetch();
    if ($category === false) {
        error_log("Invalid id. $id");
        header("Location: error.php");
        exit;
    }
} catch(PDOException $e) {
    error_log("PDOException: " . $e->getMessage());
    header("Location: error.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP DB</title>
</head>
<body>
    <h3>Categories - Edit</h3>
    <hr>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>" >
        ID: <?= htmlspecialchars($category['id'])?><br>
        TITLE: <input type="text" name="title" value="<?= htmlentities($category['title']) ?>" ><br>
        <button type="submit">UPDATE</button>
    </form>
    <hr>
    <a href="index.php">BACK</a>
</body>
</html>