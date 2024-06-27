<?php

class MyClass 
{
    // オブジェクトプロパティを追加
    protected $myProperty;

    // 静的プロパティを追加
    // クラスに属する = スクリプト実行後、永続的に変数がメモリに残るため、
    // 最もな理由がない場合にはオブジェクトプロパティを使用しよう（インスタンス消えたらメモリ解放する特性を活かす = ガベージコレクション）
    public $myStaticProperty;

    // 静的メソッドを追加
    public static function myStaticMethod()
    {
        // 静的メソッドからプロパティにアクセスするには、selfキーワードを使用。
        // また、静的プロパティはクラスを参照するため、インスタンスを参照する動的プロパティを参照しようとすると
        // どれを参照しに行っていいかわからないため呼び出すことができない。（$myPropertyのこと）
        echo self::$myStaticProperty . '/' . PHP_EOL;
    }

    // コンストラクタ
    public function __construct()
    {
        echo 'MyClass constructor'.PHP_EOL;
    }

    // アクセサメソッドを定義し、カプセル化を実現する。
    public function setMyProperty($myProperty)
    {
        $this->myProperty = $myProperty;
    }

    public function getMyProperty()
    {
        return $this->myProperty;
    }

    // メソッドを追加
    public function myMethod($x)
    {
        // 例外をスロー
        if ($x === '') {
            throw new Exception('Invalid argument!!');
        }
        echo $this->myProperty . ' ' . $x . PHP_EOL;
    }
}
