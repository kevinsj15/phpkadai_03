
<?php
//1. GETでidを取得
$id = $_GET["id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//3．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM tbl_user WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
if($status==false){
    //execute（SQL実行時にエラーがある場合）
    sql_error($stmt);
}else{
    $row = $stmt->fetch();
}
?>

<form method="POST" action="user_update.php">
    <div class="jumbotron">
        <fieldset>
            <legend>ユーザー情報更新</legend>
            <label>ID：<input type="text" name="lid" value="<?= $row["lid"] ?>"></label><br>
            <label>新しいPW：<input type="password" name="lpw" placeholder="新しいパスワードを入力"></label><br>
            <label>名前：<input type="text" name="name" value="<?= $row["name"] ?>"></label><br>
            <label><input type="radio" name="kanri_flg" value="0" <?= $row["kanri_flg"]==0 ? 'checked' : '' ?>>一般</label>
            <label><input type="radio" name="kanri_flg" value="1" <?= $row["kanri_flg"]==1 ? 'checked' : '' ?>>管理者</label><br>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" value="更新">
        </fieldset>
    </div>
</form>
