
<?php
//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM tbl_bookmarks");
$status = $stmt->execute(); //実行

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    sql_error($stmt);
}else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $result['id'] . '">';
        $view .= '本の名前：' . $result["book_name"] . '、著者：' . $result["book_author"] . '、登録日時：' . $result["register_datetime"];
        $view .= '</a>';
        $view .= '</p>';
    }
}
?>
