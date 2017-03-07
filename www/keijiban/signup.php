<?php
require ('smarty.php');
require_once ('dbmanage.php');


// セッション開始

$signUpMessage = "";
$errorMessage = "";


if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2'])){
    if (mb_strlen($_POST['username']) < 25 && mb_strlen($_POST['password']) < 100 && $_POST['password'] == $_POST['password2']){
        $username = htmlspecialchars($_POST['username']);
        $pw = htmlspecialchars($_POST['password']);

        $dsn = 'mysql:dbname=board2;host=127.0.0.1;';
        $user ='root';
        $password = '';

        try {
            $db = new PDO($dsn,$user,$password, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $stmt = $db->prepare("INSERT INTO menber(name, password) VALUES(:name, :password)");
            $stmt->bindParam(':name', $username);
            $stmt->bindParam(':password', $pw);
            $stmt->execute();
            $userid = $db->lastinsertid();

            $signUpMessage = '登録が完了しました。あなたの登録IDは '. $userid. ' です。パスワードは '. $pw. ' です。';  // ログイン時に使用するIDとパスワード
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
        }

    }
}

$smarty->assign('message', $signUpMessage);
$smarty->assign('emessage',$errorMessage);
$smarty->display('signup.tpl');


