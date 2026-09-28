<?php
namespace Example16;

// オブジェクトのプロパティにアクセスし、メソッドを呼び出す 


// new はクラスをインスタンス化する（オブジェクトを作成する）
$user = new User();
// オブジェクトのプロパティにアクセスする
$user->name = "Joe";
// オブジェクトのメソッドを呼び出す
$user->password = "mypass";

// プロパティを出力する
echo $user->name;
echo "\n";
// メソッドを呼び出す
echo $user->get_password();
echo "\n";

class User
{
    // プロパティの宣言
    public ?string $name = null;
    public ?string $password = null;

    // メソッドの定義
    public function get_password(): ?string
    {
        return $this->password;
    }
}
