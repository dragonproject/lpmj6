<?php
namespace Example20;



// publicはどこからでもアクセスできる

$example = new Example();

// クラス名からアクセス
echo Example::class . "\n";
echo Example::$name . "\n";
echo Example::$age . "\n";

// インスタンスからアクセス
echo $example->name . "\n";
echo $example->age . "\n";

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
