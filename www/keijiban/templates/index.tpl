<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/jquery.validationEngine.js"></script>
    <script src="js/languages/jquery.validationEngine-ja.js"></script>
    <link rel="stylesheet" href="css/validationEngine.jquery.css">
    <title>ログイン</title>
    <script>
        {literal}
        $(function(){
            jQuery("#form").validationEngine();
        });
        {/literal}
    </script>
</head>
<body style="text-align: center">

<h1>ようこそ！掲示板へ！</h1>
<form id="form" action="login.php" method="POST">
    <fieldset>
        <h2>ログインフォーム</h2>
        <div>{$errors}</div>
        <label for="userid">ユーザーID</label>
        <input type="text" name="userid" placeholder="ユーザーIDを入力" autocomplete="off" class="validate[required,maxSize[25]]">
        <br>
        <label for="password">パスワード</label>
        <input type="password" name="password" placeholder="パスワードを入力" autocomplete="off" class="validate[required,maxSize[50]]">
        <br>
        <button type="submit" name="submit" value="submit">ログイン</button>
    </fieldset>
</form>
<br>
<a href="signup.php">新規登録</a>
</body>
</html>
