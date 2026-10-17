<?php

namespace Example11;

// Userクラスのインスタンス（オブジェクト）を作成する
$object = new User();

// オブジェクトのプロパティを出力する
// print_r()は、変数の情報を読みやすく整形して表示する関数
print_r($object);
echo "<br>";

// オブジェクトのプロパティに値を代入する
$object->name = "Joe";
$object->password = "mypass";

// オブジェクトのプロパティを出力する
// print_r()は、変数の情報を読みやすく整形して表示する関数
print_r($object);
echo "<br>";

// オブジェクトのメソッドを呼び出す
$object->save_user();

class User
{
    public ?string $name = null;
    public ?string $password = null;

    public function save_user()
    {
        echo "Save User code goes here";
    }
}
