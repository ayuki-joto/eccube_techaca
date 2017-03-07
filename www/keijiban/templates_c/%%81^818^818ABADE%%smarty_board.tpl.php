<?php /* Smarty version 2.6.30, created on 2017-03-07 17:30:07
         compiled from smarty_board.tpl */ ?>
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
        <?php echo '
        $(function(){
            jQuery("#form").validationEngine();
        });
        '; ?>

    </script>
</head>
<body style="text-align: center">

<h1 style="text-align: center">掲示板</h1>

<a href="logout.php">ログアウト</a>
<p>ようこそ<?php echo $_SESSION['NAME']; ?>
さん</p>
<div><?php echo $this->_tpl_vars['errors']; ?>
</div>
<p>メッセージは140文字までで入力してください</p>
<div><?php echo $this->_tpl_vars['message']; ?>
</div>
<form action="index.php" method="post" id="form">
    本文: <textarea name="text" class="validate[required,maxSize[140]]"></textarea><br>
    <button type="submit" name="submit">投稿</button>
</form>

<h2>投稿一覧</h2>

<?php if (isset ( $this->_tpl_vars['post_list'] )): ?>
    <?php $_from = $this->_tpl_vars['post_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
        <form action="content.php" method="post">
            <p><a href="" onclick="document.forms[<?php echo $this->_tpl_vars['row']['id']; ?>
].submit(); return false;"><?php echo $this->_tpl_vars['row']['id']; ?>
</a> <?php echo $this->_tpl_vars['row']['contents']; ?>
 <?php echo $this->_tpl_vars['row']['user_id']; ?>
</p>
            <input type='hidden' name="content_number" value=<?php echo $this->_tpl_vars['row']['id']; ?>
>
        </form>
    <?php endforeach; endif; unset($_from); ?>

<?php else: ?>
    <p>投稿がありません<p>

<?php endif; ?>



</body>
</html>
