<?php
namespace Example14;

class User
{
    public function __construct(string $param1, string $param2)
    {
        // Constructor statements go here
        // コンストラクタはクラスが作成されるときに自動的に呼び出される関数
        echo "Constructor called with " . $param1 . " and " . $param2 . "<br>";
    }
}
