<?php /* Smarty version 2.6.30, created on 2017-02-14 17:21:17
         compiled from logout.tpl */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="/js/jquery-1.8.2.min.js"></script>
    <script src="/js/jquery.validationEngine.js"></script>
    <script src="/js/languages/jquery.validationEngine-ja.js"></script>
    <link rel="stylesheet" href="/css/validationEngine.jquery.css">
    <title>掲示板</title>
    <script>
        <?php echo '
        $(function(){
            jQuery("#form").validationEngine();
        });
        '; ?>

    </script>
</head>
<body style="text-align: center">

<h1>ログアウト画面</h1>
<div><?php echo $this->_tpl_vars['error']; ?>
</div>
<a href="login.php">ログイン画面に戻る</a>

</body>
</html>