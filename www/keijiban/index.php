ex<?php

require ('smarty.php');
require_once ('dbmanage.php');

$message = '';
$post_list= '';

unset($_SESSION['NUMBER']);

if (isset($_SESSION["LOGIN"])) {

    $db = new dbmanage();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['text']) && mb_strlen($_POST['text']) < 140){
            $contents = htmlspecialchars($_POST['text']);

            $result = $db -> post($_SESSION["LOGIN"],$contents);
            if ($result == "ok"){
                $message = '投稿完了';
                $result = '';
            }else{
                $message = '投稿失敗';
                $result ='';
            }
        }
    }

    $post_list = $db -> post_list() ;

} else {
    header("Location: login.php");
}

$smarty -> assign('message', $message);
$smarty->assign('post_list', $post_list);
$smarty->display('smarty_board.tpl');


