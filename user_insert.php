<?php
//1. POSTデータ取得
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];
$name = $_POST["name"];
$kanri_flg = $_POST["kanri_flg"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

// パスワードをハッシュ化
$hashed_password = password_hash($lpw, PASSWORD_DEFAULT);

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO tbl_user(lid,lpw,name,kanri_flg,life_flg)VALUES(:lid,:lpw,:name,:kanri_flg,0)");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':lpw', $hashed_password, PDO::PARAM_STR);    //ハッシュ化したパスワードを使用、文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);   //文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  //数値の場合 PDO::PARAM_INT
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
  sql_error($stmt);
} else {
  redirect("user_index.php");
}
