<?php

namespace Example19;

// スクリプト全体で定義された定数を表示する
// 定義の仕方
// const 定数名 = 値;
// self:: でアクセスする
// Translate::lookup() を実行すると、1が返ってくる
// この例では、0, 1, 2, 3というint型の定数を定義して、その中の1を表示している
// 実際には、もっと大きな値や、文字列型の定数なども定義できる
// そのような定数は、コードの可読性を高めるために使用される
// lookup()メソッドは、クラスのプロパティであるSPANISHの値を表示する
// SPANISHは定数であり、値は1である
Translate::lookup();

class Translate
{
    // 定義の仕方
    // const 定数名 = 値;
    public const ENGLISH = 0;
    public const SPANISH = 1;
    public const FRENCH  = 2;
    public const GERMAN  = 3;
    // ...

    public static function lookup()
    {
        echo self::SPANISH;
    }
}
