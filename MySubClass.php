<?php
require_once('MyClass.php');
require_once('MyException.php');

class MySubClass extends MyClass
{
    // コンストラクタのオーバーライド
    public function __construct()
    {
        echo 'MySubClass constructor'.PHP_EOL;
    }

    // オーバーライド
    public function myMethod($x)
    {
        if ($x === '') {
            throw new MyException('Argument empty');
        }
        echo 'OverRide'.PHP_EOL;
    }


    public function myMethod2($x)
    {
        echo 'Hello World'.PHP_EOL;
    }

}