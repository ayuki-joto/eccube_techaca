<?php

require ('smarty.php');

if (isset($_SESSION["NAME"])) {
    $Message = "ログアウトしました。";
} else {
    $Message = "セッションがタイムアウトしました。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();


$smarty =new Smarty();
$smarty->assign('error', $Message);
$smarty->display('logout.tpl');

