<?php

namespace Example20;



// publicはどこからでもアクセスできる

$example = new Example();

// クラス名からアクセス
echo Example::class . "<br>";
echo Example::$name . "<br>";
echo Example::$age . "<br>";

// インスタンスからアクセス
echo $example->name . "<br>";
echo $example->age . "<br>";

class Example
{
    // publicはどこからでもアクセスできる
    public string $name = "Michael";   // Same as public but deprecated
    public int $age = 23;              // Public property

    // protectedは同じクラスと、そのクラスを継承したクラスからアクセスできる
    protected int $usercount = 0;      // Protected property

    // privateは同じクラスからしかアクセスできない
    private function admin()
    {
        // Admin code goes here
    }
}
