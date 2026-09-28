<?php

namespace Example18;



class Test
{
    // 基本的にプロパティの宣言時に値を初期化する
    // string, intなどのプリミティブ型は直接値を代入できる
    public $name = "Paul Smith"; // Valid
    public $age = 42;           // Valid
    // コンストラクタの中で初期化する必要がある
    // time()は関数なので、プロパティの宣言時に呼び出すことはできない
    public $time = time();       // Invalid - calls a function
    // 式を使ってプロパティを初期化することはできない
    public $score = $level * 2;   // Invalid - uses an expression

    public function __construct(int $level = 1)
    {
        $this->time = time();
        $this->score = $level * 2;
    }
}
