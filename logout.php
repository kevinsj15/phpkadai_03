
<?php
//0.外部ファイル読み込み
include("funcs.php");

//1.セッションの開始
session_start();

//2.セッションの破棄
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();

//3.リダイレクト
redirect('login.php');
?>
