<?php

require('smarty.php');
require_once('dbmanage.php');

$message = '';

if (isset($_SESSION['LOGIN']) && isset($_SESSION['NUMBER'])) {

    $db = new dbmanage();
    $content_number = htmlspecialchars($_SESSION['NUMBER']);

    $result = $db->delete($content_number);
    if ($result != null) {
        $message = '削除成功';
        $result = '';
    } else {
        $message = '削除失敗';
        $result = '';
    }


}

$smarty->assign('message', $message);
$smarty->display('delete.tpl');