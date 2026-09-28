<?php

namespace Example15;



// プロパティの型宣言
class Test
{
    // Valid
    // 基本的にプロパティの宣言時に値を初期化する
    // string, intなどのプリミティブ型は直接値を代入できる
    public string $name = "Paul Smith";
    public int $age = 42;

    // Invalid
    // コンストラクタの中で初期化する必要がある
    // time()は関数なので、プロパティの宣言時に呼び出すことはできない
    public int $time;
    public int $score;

    public function __construct(int $level = 1)
    {
        $this->time = time();
        $this->score = $level * 2;
    }
}

