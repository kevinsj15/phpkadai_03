<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
</head>

<body>

  <header>
    <nav class="navbar navbar-default">ユーザー登録</nav>
  </header>

  <form method="post" action="user_insert.php">
    <div class="jumbotron">
      <fieldset>
        <legend>ユーザー登録</legend>
        <label>ID：<input type="text" name="lid"></label><br>
        <label>PW：<input type="password" name="lpw"></label><br> <!-- パスワードフィールドを追加 -->
        <label>名前：<input type="text" name="name"></label><br>
        <label><input type="radio" name="kanri_flg" value="0" checked title="一般ユーザー用">一般</label>
        <label><input type="radio" name="kanri_flg" value="1" title="管理者用">管理者</label><br>
        <input type="submit" value="送信">
      </fieldset>
    </div>
  </form>

</body>

</html>