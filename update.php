
<?php
//1. POSTデータ取得
$book_name   = $_POST["book_name"];
$book_author = $_POST["book_author"];
$comment     = $_POST["comment"];
$id          = $_POST["id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE tbl_bookmarks SET book_name=:book_name, book_author=:book_author, comment=:comment WHERE id=:id");
$stmt->bindValue(':book_name',   $book_name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_author', $book_author, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment',     $comment,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',          $id,          PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("select.php");
}
?>
