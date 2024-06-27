<?php
require_once('MyClass.php');
require_once('MySubClass.php');

// コンストラクタは、サブクラスに明示的に書かれていない場合は、スーパークラスのコンストラクタが呼ばれる。
// オーバーライドした場合は、スーパークラスのコンストラクタは呼ばれない。
$myClass1 = new MyClass();
$myClass2 = new MyClass();
$mySubClass1 = new MySubClass();
echo '--------------------------'.PHP_EOL;

$myClass1->myMethod('Urachan');
$myClass2->myMethod('Urara');

// プロパティがprivateなので呼び出せない
// $myClass1->myProperty = 'Hello';
// $myClass2->myProperty = 'Bye';
// echo $myClass1->myProperty.PHP_EOL;
// echo $myClass2->myProperty.PHP_EOL;

$myClass1->setMyProperty('Toramaru');
$myClass1->getMyProperty();
$myClass1->myMethod('だよ');

$myClass2->setMyProperty('Torachan');
$myClass2->getMyProperty();
$myClass2->myMethod('だよ');
echo '--------------------------'.PHP_EOL;

// 例外処理
echo 'pass1'.PHP_EOL;
try {
    $myClass1->myMethod('');
    echo 'pass2'.PHP_EOL;
} catch (\Exception $e) {
    echo $e->getMessage().PHP_EOL;
    echo 'pass3'.PHP_EOL;
} finally {
    echo 'finally'.PHP_EOL;
}
echo 'pass4'.PHP_EOL;
echo '--------------------------'.PHP_EOL;

// オーバーライドしたmyMethodで、継承したmyExceptionの処理がなされていることを確認
try {
    $mySubClass1->myMethod('');
} catch (\MyException $me) {
    echo $me->getMessage();
}
