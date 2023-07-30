
<?php
//1. GETでidを取得
$id = $_GET["id"];

//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//3．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM tbl_bookmarks WHERE id=:id");
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

<form method="POST" action="update.php">
    <div class="jumbotron">
        <fieldset>
            <legend>ブックマーク更新</legend>
            <label>本の名前：<input type="text" name="book_name" value="<?= $row["book_name"] ?>"></label><br>
            <label>著者：<input type="text" name="book_author" value="<?= $row["book_author"] ?>"></label><br>
            <label>コメント：<textArea name="comment" rows="4" cols="40"><?= $row["comment"] ?></textArea></label><br>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" value="更新">
        </fieldset>
    </div>
</form>
