<?php

// formtest2.php

if (!empty($_POST['name'])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
} else {
    $name = "(Not Entered)";
}

echo <<<_END
  <!DOCTYPE html>
  <html lang="ja">
    <head>
      <meta charset="UTF-8">
      <title>Form Test 2</title>
    </head>
    <body>
    Your name is: $name<br><br>
    <form method="post" action="formtest2.php">
      What is your name?
      <input type="text" name="name">
      <input type="submit" value="送信">
    </form>
    </body>
  </html>
_END;
