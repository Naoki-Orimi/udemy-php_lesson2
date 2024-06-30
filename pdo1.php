<?php
// PDOのインスタンス生成とCRUDについて

// データソースネームの定義
$dsn = "sqlite:eldb.sqlite3";
$pdo = new PDO($dsn);

// 疎通確認
// var_dump($pdo);

/*
    レコード取得
    PDOインスタンスのqueryメソッドによってselect文を実行する。
    queryメソッドの戻り値であるPDOStatementインスタンスのfetchメソッドを実行し、select文の結果を1行ずつ取得できる。
    PDOStatementインスタンスのfetchメソッドは、実行結果の最終行に達している場合はfalseを返す。
*/
$getFlg = true;
if ($getFlg) {
    $sql = 'select id, title from categories';
    $st = $pdo->query($sql);
    $row = $st->fetch();
    while($row !== false) {
        echo $row['id'] . ':' . $row['title'] . PHP_EOL;
        $row = $st->fetch();
    }
}

/*
    レコード作成
    PDOインスタンスのexecメソッドによってinsert文を実行する。
    execメソッドは戻り値に更新件数を（insertの場合は作成件数）を返却する。
    execメソッドの戻り値にテーブルのレコードは含まれない点に注意する。
*/
$postFlg = false;
if ($postFlg) {
    $sql = "insert into categories (id, title) values (4, 'Photo')";
    $count = $pdo->exec($sql);
    echo "Insert Count: $count" . PHP_EOL;
}

/*
    レコード更新
    PDOインスタンスのupdateメソッドによってupdate文を実行する。
    execメソッドは戻り値に更新件数をを返却する。
    execメソッドの戻り値にテーブルのレコードは含まれない点に注意する。
*/
$putFlg = false;
if ($putFlg) {
    $sql = "update categories set title = 'Camera' where id = 4";
    $count = $pdo->exec($sql);
    echo "Update Count: $count" . PHP_EOL;
}

/*
    レコード削除
    PDOインスタンスのupdateメソッドによってdelete文を実行する。
    execメソッドは戻り値に削除件数をを返却する。
    execメソッドの戻り値にテーブルのレコードは含まれない点に注意する。
*/
$deleteFlg = false;
if ($deleteFlg) {
    $sql = "delete from categories where id = 4";
    $count = $pdo->exec($sql);
    echo "Delete Count: $count" . PHP_EOL;
}