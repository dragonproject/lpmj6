<?php

namespace Example13;

// オブジェクトのコピー 
// cloneキーワードを使うと、オブジェクトのコピーを作成できる
// $object1と$object2は異なるオブジェクトを参照する
$object1 = new User();
$object1->name = "Alice";

// $object1を$object2にコピーする
// $object2は$object1のコピーである
$object2 = clone $object1;
$object2->name = "Amy";

echo "object1 name = " . $object1->name . "<br>";
echo "object2 name = " . $object2->name . "<br>";

class User
{
    public ?string $name = null;
}
