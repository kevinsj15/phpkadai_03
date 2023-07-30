
<?php
//XSS対策:エスケープ処理
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//DB接続関数：db_conn()
function db_conn()
{
    try {
        //localhostの場合
        $db_name = "gs_bm_table";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "";          //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト

        //localhost以外＊＊自分で書き直してください！！＊＊
        if ($_SERVER["HTTP_HOST"] != 'localhost') {
            $db_name = "kevin-james_gs_bm_table";  //データベース名: ここを"kevin-james_gs_bm_table"に変更してください。
            $db_id   = "kevin-james";  //アカウント名（さくらコントロールパネルに表示されています）
            $db_pw   = "159357Jj";  //パスワード(さくらサーバー最初にDB作成する際に設定したパスワード)
            $db_host = "mysql57.kevin-james.sakura.ne.jp"; //例）mysql**db.ne.jp...
        }
        return new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}


//SQLエラー
function sql_error($stmt)
{
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header("Location: " . $file_name);
    exit();
}

//セッションチェック＆リジェネレイト
function session_check()
{
    //セッション開始
    session_start();
    //ログイン済みの場合
    if (isset($_SESSION["chk_ssid"]) && $_SESSION["chk_ssid"] == session_id()) {
        //セッションidの更新
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();
    } else {
        //未ログインの場合
        exit("Login Error.");
    }
}

?>

