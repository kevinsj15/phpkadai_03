
<?php
//1. POSTデータ取得
$book_name   = $_POST["book_name"];
$book_author = $_POST["book_author"];
$comment     = $_POST["comment"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO tbl_bookmarks(book_name, book_author, register_datetime, comment) VALUES(:book_name, :book_author, sysdate(), :comment)");
$stmt->bindValue(':book_name',   $book_name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_author', $book_author, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment',     $comment,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("select.php");
}
?>
