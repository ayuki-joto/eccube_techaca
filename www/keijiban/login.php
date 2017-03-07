<?php
ini_set("display_errors", On);
error_reporting(E_ALL);
?>

<?php

require ('smarty.php');
require_once ('dbmanage.php');

$errorMessage ='';



if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['userid']) && !empty($_POST['password'])) {

        $userid = htmlspecialchars($_POST['userid']);
        $pw = htmlspecialchars($_POST['password']);


        $dsn = 'mysql:dbname=board2;host=127.0.0.1;';
        $user ='root';
        $password = '';

        try{
            $db = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $stt = $db->prepare('SELECT * FROM menber WHERE id = :id');
            $stt->bindParam(':id', $userid);
            $stt->execute();

            if ($row = $stt->fetch(PDO::FETCH_ASSOC)){
                if ($pw == $row['password']) {

                    // 入力したIDのユーザー名を取得
                    $sql = "SELECT * FROM menber WHERE id = $userid";  //入力したIDからユーザー名を取得
                    $stt = $db->query($sql);
                    foreach ($stt as $row) {
                        $row['id'];
                        $row['name'];
                    }
                    $_SESSION["LOGIN"] = $row['id'];
                    $_SESSION["NAME"] = $row['name'];

                    header('location: index.php');
                    exit();
                } else {
                    // 認証失敗
                    $errorMessage = 'パスワードに誤りがあります。';
                }
            } else {
                // 該当データなし
                $errorMessage = 'ユーザーIDが存在しません。';
            }
        } catch (PDOException $e) {
            die("エラーメッセージ:{$e->getMessage()}");
        }




    }
}

$smarty->assign('errors',$errorMessage);
$smarty->display('index.tpl');

