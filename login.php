<?php
//1. POSTデータ取得
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//3. データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM tbl_user WHERE lid=:lid AND life_flg=0");
$stmt->bindValue(':lid', $lid);
$status = $stmt->execute();

//4. SQL実行時にエラーがある場合
if($status==false){
  sql_error($stmt);
}

//5. 抽出データ数を取得
$val = $stmt->fetch(); //1レコードだけ取得する方法

//6. 該当レコードがあればSESSIONに値を代入
if (password_verify($lpw, $val['lpw'])) {
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  redirect("select.php");
}else{
  //logout処理を経由して全画面へ
  redirect("logout.php");
}
