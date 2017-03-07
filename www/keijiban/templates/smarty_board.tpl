<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/jquery.validationEngine.js"></script>
    <script src="js/languages/jquery.validationEngine-ja.js"></script>
    <link rel="stylesheet" href="css/validationEngine.jquery.css">
    <title>掲示板</title>
    <script>
        {literal}
        $(function(){
            jQuery("#form").validationEngine();
        });
        {/literal}
    </script>
</head>
<body style="text-align: center">

<h1 style="text-align: center">掲示板</h1>

<a href="logout.php">ログアウト</a>
<p>ようこそ{$smarty.session.NAME}さん</p>
<div>{$errors}</div>
<p>メッセージは140文字までで入力してください</p>
<div>{$message}</div>
<form action="index.php" method="post" id="form">
    本文: <textarea name="text" class="validate[required,maxSize[140]]"></textarea><br>
    <button type="submit" name="submit">投稿</button>
</form>

<h2>投稿一覧</h2>

{if isset($post_list)}
    {foreach from=$post_list item=row}
        <form action="content.php" method="post">
            <p><a href="" onclick="document.forms[{$row.id}].submit(); return false;">{$row.id}</a> {$row.contents} {$row.user_id}</p>
            <input type='hidden' name="content_number" value={$row.id}>
        </form>
    {/foreach}

{else}
    <p>投稿がありません<p>

{/if}



</body>
</html>

