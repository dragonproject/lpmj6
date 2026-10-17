<?php
// 変数に出力者（著者）の文字列を代入
$author = "Brian W. Kernighan<br>    ブライアン・カーニハン";

// ヒアドキュメント構文 (<<<_END ... _END;)
// 複数行の文字列をクォートのエスケープなしでそのまま記述でき、内部で変数展開も行われます。
// ※ヒアドキュメント内部に書いた文字はすべて出力されるため、PHPコメントは外側に記述します。
echo <<<_END
  Debugging is twice as hard as writing the code in the first place.
  Therefore, if you write the code as cleverly as possible, you are,
  by definition, not smart enough to debug it.

  デバッグは、そもそもコードを書くことの2倍も難しい。
  したがって、コードをできるだけ巧妙に書こうとすれば、
  定義上、それをデバッグするだけの知恵はないということになる。
  
  - $author.
_END;
// 終端ID (_END;) でヒアドキュメントを終了します
