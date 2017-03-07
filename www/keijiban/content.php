<?php

require ('smarty.php');
require_once ('dbmanage.php');

$post_content= '';
$message ='';


//var_dump($_POST['content_number']);
if (!empty($_POST['content_number'])) {
    $_SESSION['NUMBER'] = $_POST['content_number'];
}
if (isset($_SESSION["LOGIN"]) && $_SESSION['NUMBER']) {

    $db = new dbmanage();
    $content_number = htmlspecialchars($_SESSION['NUMBER']);
    $post_content = $db -> post_contents($content_number);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['text']) && mb_strlen($_POST['text']) < 140){
            $contents = htmlspecialchars($_POST['text']);

            $result = $db -> update($_SESSION['NUMBER'],$contents);
            if ($result == "ok"){
                $message = '編集完了';
                $result = '';
            }else{
                $message = '編集失敗';
                $result ='';
            }
        }
    }
    if ($post_content == null){
        $message = '投稿を削除しました。';
    }

} else {
    header("Location: login.php");
}

$smarty->assign('message', $message);
$smarty->assign('userid', $_SESSION["LOGIN"]);
$smarty->assign('post_list', $post_content);
$smarty->display('content.tpl');


