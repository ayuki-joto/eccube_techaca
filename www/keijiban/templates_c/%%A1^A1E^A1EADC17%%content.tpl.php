<?php /* Smarty version 2.6.30, created on 2017-02-23 13:46:06
         compiled from content.tpl */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="/js/jquery-1.8.2.min.js"></script>
    <script src="/js/jquery.validationEngine.js"></script>
    <script src="/js/languages/jquery.validationEngine-ja.js"></script>
    <link rel="stylesheet" href="/css/validationEngine.jquery.css">
    <title>編集画面</title>
    <script type="text/javascript">
        <?php echo '
        $(function() {
            $(\'button\').click(function(){
                $(\'form\').toggle();
            });
        });

        '; ?>

    </script>
    <script>
        <?php echo '
        $(function(){
            jQuery("#form").validationEngine();
        });
        '; ?>

    </script>
</head>
<body style="text-align: center">

<h2>編集画面</h2>
<div><?php echo $this->_tpl_vars['message']; ?>
</div>

<?php $_from = $this->_tpl_vars['post_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
    <ul style="display: inline">
        <li>投稿id : <?php echo $this->_tpl_vars['row']['id']; ?>
</li>
        <li>投稿内容 : <?php echo $this->_tpl_vars['row']['contents']; ?>
</li>
        <li>投稿者 : <?php echo $this->_tpl_vars['row']['user_id']; ?>
</li>
    </ul>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['row']['user_id'] == $this->_tpl_vars['userid']): ?>
    <button>編集</button>　<a href="/delete.php">削除</a>
<?php endif; ?>

<form action="/content.php" method="post" id="form" style="display: none">
    本文: <textarea name="text" class="validate[required,maxSize[140]]"></textarea><br>
    <button type="submit" name="submit">編集</button>
</form>

<a href="/index.php">戻る</a>
</body>
</html>