<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/jquery.validationEngine.js"></script>
    <script src="js/languages/jquery.validationEngine-ja.js"></script>
    <link rel="stylesheet" href="css/validationEngine.jquery.css">
    <title>編集画面</title>
    <script type="text/javascript">
        {literal}
        $(function() {
            $('button').click(function(){
                $('form').toggle();
            });
        });

        {/literal}
    </script>
    <script>
        {literal}
        $(function(){
            jQuery("#form").validationEngine();
        });
        {/literal}
    </script>
</head>
<body style="text-align: center">

<h2>編集画面</h2>
<div>{$message}</div>

{foreach from=$post_list item=row}
    <ul style="display: inline">
        <li>投稿id : {$row.id}</li>
        <li>投稿内容 : {$row.contents}</li>
        <li>投稿者 : {$row.user_id}</li>
    </ul>
{/foreach}

{if $row.user_id eq $userid}
    <button>編集</button>　<a href="delete.php">削除</a>
{/if}

<form action="content.php" method="post" id="form" style="display: none">
    本文: <textarea name="text" class="validate[required,maxSize[140]]"></textarea><br>
    <button type="submit" name="submit">編集</button>
</form>

<a href="index.php">戻る</a>
</body>
</html>