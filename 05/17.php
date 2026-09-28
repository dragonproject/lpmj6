<?php

namespace Example17;

// オブジェクトのプロパティにアクセスし、メソッドを呼び出す
// new はクラスのインスタンスを作成する（オブジェクトを作成する）
$object1 = new User();
// オブジェクトのプロパティにアクセスする
$object1->name = "Alice";

// プロパティを出力する
echo $object1->name;
echo "\n";

class User
{
    // プロパティの宣言
    // null許容型で定義されているので、nullを代入することができる
    // なぜ null許容型にするのか？ → コンストラクタが呼ばれる前にアクセスされるとエラーになるから
    public ?string $name = null;

    // メソッドの定義
    // コンストラクタ
    // $object = new User(); というコードが実行されるときに自動的に呼び出される関数
    public function __construct()
    {
        $this->name = "Bob";
    }
}
