<?php

// $author には、引用文の著者名を代入する。
// ここでは Scott Adams を使っている。
$author = "Scott Adams";

// $out には、引用文をまとめて保存する。
// ここではヒアドキュメントを使って複数行の文字列を定義している。
// 文字列の中に $author を埋め込むことで、最後に著者名を表示できる。
$out = <<<_END
Normal people believe that if it ain’t broke, don’t fix it.
Engineers believe that if it ain’t broke, it doesn’t have enough
features yet.

普通の人は、「壊れていないなら、直さないほうがいい」と信じている。
一方、エンジニアは、「壊れていないなら、まだ機能が
十分ではない」と信じている。

- $author.
_END;
