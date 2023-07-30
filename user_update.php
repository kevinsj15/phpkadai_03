<?php
//1. POSTデータ取得
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];
$name = $_POST["name"];
$kanri_flg = $_POST["kanri_flg"];
$id    = $_POST["id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//3. パスワードが送信されてきた場合はハッシュ化
if(!empty($lpw)){
    $hashed_password = password_hash($lpw, PASSWORD_DEFAULT);
}else{
    $hashed_password = null;
}

//４．データ登録SQL作成
if(isset($hashed_password)){
    $stmt = $pdo->prepare("UPDATE tbl_user SET lid=:lid,lpw=:lpw,name=:name,kanri_flg=:kanri_flg WHERE id=:id");
    $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':lpw', $hashed_password, PDO::PARAM_STR);
}else{
    $stmt = $pdo->prepare("UPDATE tbl_user SET lid=:lid,name=:name,kanri_flg=:kanri_flg WHERE id=:id");
    $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
}
$stmt->bindValue(':name', $name, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);       //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//５．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("user_select.php");
}
