<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/jquery.validationEngine.js"></script>
    <script src="js/languages/jquery.validationEngine-ja.js"></script>
    <link rel="stylesheet" href="css/validationEngine.jquery.css">
    <title>ログアウト</title>
    <script>
        {literal}
        $(function(){
            jQuery("#form").validationEngine();
        });
        {/literal}
    </script>
</head>
<body style="text-align: center">

<h1>ログアウト画面</h1>
<div>{$error}</div>
<a href="login.php">ログイン画面に戻る</a>

</body>
</html>
