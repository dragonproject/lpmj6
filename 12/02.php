<?php

// formtest2.php

echo <<<_END
  <!DOCTYPE html>
  <html lang="ja">
    <head>
      <meta charset="UTF-8">
      <title>Form Test</title>
    </head>
    <body>
    <form method="post" action="formtest2.php">
      What is your name?
      <input type="text" name="name">
      <input type="submit" value="送信">
    </form>
    </body>
  </html>
_END;
