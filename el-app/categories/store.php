<?php
$id = (string)filter_input(INPUT_POST, "id");
$title = (string)filter_input(INPUT_POST, "title");

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

if ($title === "") {
    error_log("Validate: id is required.");
    header("Location: error.php");
    exit;
}
if(mb_strlen($title) > 15) {
    error_log("Validate: title length is not over 15.");
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

    $sql = "insert into categories (id, title) values (:id, :title)";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(":id", $id, PDO::PARAM_INT);
    $ps->bindValue(":title", $title, PDO::PARAM_STR);
    $ps->execute();

    header("Location: index.php?cmp=1");
} catch (PDOException $e) {
    error_log("PDOException: " . $e->getMessage());
    header("Location: error.php");
    echo $e->getMessage();
}
?>
