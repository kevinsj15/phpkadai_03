<?php
//1.  DB接続します
include("funcs.php");
session_check();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM tbl_user");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    sql_error($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        $view .= '<a href="user_detail.php?id=' . $result['id'] . '">';
        $view .= '名前：' . $result["name"] . '、ID：' . $result["lid"];
        $view .= '</a>';
        $view .= '</p>';
    }
}
?>

<div>
    <div><?= $view ?></div>
</div>