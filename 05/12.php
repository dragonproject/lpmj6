<?php

namespace Example12;

// オブジェクトの参照渡し
// object1とobject2は同じオブジェクトを参照する
// なぜなら、object2はobject1をコピーしているのではなく、object1を参照しているから

$object1 = new User();
$object1->name = "Alice";

// object2にobject1を代入
// object2はobject1を参照する
$object2 = $object1;
// object2のnameプロパティを変更する
// object1のnameプロパティも変更される
$object2->name = "Amy";

echo "object1 name = " . $object1->name . "<br>";
echo "object2 name = " . $object2->name . "<br>";

class User
{
    public ?string $name = null;
}
