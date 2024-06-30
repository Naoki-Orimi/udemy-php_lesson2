<?php
// PDO応用

// データソースネームの定義
$dsn = "sqlite:eldb.sqlite3";
$pdo = new PDO($dsn);
// デフォルトfeachモードをアソックにすることで、fetch時にカラム名がキーになる。
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// 様々なfetchモードでデータを取得する
/*
$sql = "select * from categories";
$st = $pdo->query($sql);
$row = $st->fetch(PDO::FETCH_NUM);
var_dump($row);
echo PHP_EOL;
$row = $st->fetch(PDO::FETCH_BOTH);
var_dump($row);
echo PHP_EOL;
*/


// PDO Exceptionについて
/*
$sql = "select * from categorie";
$st = $pdo->query($sql);
var_dump($st);
*/

// 例外処理について
/*
try {
    $sql = "select * from categorie";
    $st = $pdo->query($sql); // throw PDOException
    var_dump($st);
} catch (PDOException $e) {
    echo "catch" . PHP_EOL;
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
*/

/**
 * プリペアドステートメント
 * 
 * 同じ構文を再利用するため、処理を軽量化できる。
 * 予めSQL文を用意しているので、SQLインジェクション対策になる。
 */

/*
try {
    $sql = "insert into categories (id, title) values (?, ?)";
    $ps = $pdo->prepare($sql);

    $id = 4;
    $title = "Photo";
    $ps->bindValue(1, $id, PDO::PARAM_INT);
    $ps->bindValue(2, $title, PDO::PARAM_STR);
    $ps->execute(); // prepare()したPDOオブジェクトに対しては、exec()ではなくexecute()で実行するという点に注意。
    $count = $ps->rowCount(); // execute結果

    echo "Count: $count" . PHP_EOL;
} catch (PDOException $e) {
    echo $e->getMessage() . PHP_EOL;
}
*/

/**
 * プリペアドステートメント 名前付きプレースホルダー
 */
/*
try {
    $sql = "insert into categories (id, title) values (:id, :title)";
    $ps = $pdo->prepare($sql);

    $id = 5;
    $title = "Biz";
    $ps->bindValue(":id", $id, PDO::PARAM_INT);
    $ps->bindValue(":title", $title, PDO::PARAM_STR);

    $ps->execute();
    $count = $ps->rowCount();
    echo "Count: $count" . PHP_EOL;
} catch (PDOException $e) {
    $e->getMessage();
}
*/

/**
 * トランザクション処理
 */
/*

try {
    $categories = [
        ['id' => 6, 'title' => 'Guitar'],
        ['id' => 7, 'title' => 'Piano'],
        ['id' => 7, 'title' => 'Drum'] // invald id
    ];
    $sql = "insert into categories (id, title) values (:id, :title)";
    $ps = $pdo->prepare($sql);
    $pdo->beginTransaction();
    try {
        foreach ($categories as $category) {
            $ps->bindValue(":id", $category['id'], PDO::PARAM_INT);
            $ps->bindValue(":title", $category['title'], PDO::PARAM_STR);
            $ps->execute();
            echo 'Insert: ' . $category['title'] . PHP_EOL;
        }
        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
} catch (PDOException $e) {
    echo $e->getMessage() . PHP_EOL;
}
*/


