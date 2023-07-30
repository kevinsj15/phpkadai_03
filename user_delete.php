<?php
//1. GETでidを取得
$id = $_GET["id"];

//2. DB接続します
include("funcs.php");
session_check();
if($_SESSION["kanri_flg"] != 1){
    exit("管理者権限がありません。");
}
$pdo = db_conn();

//3．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM tbl_user WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("user_select.php");
}
