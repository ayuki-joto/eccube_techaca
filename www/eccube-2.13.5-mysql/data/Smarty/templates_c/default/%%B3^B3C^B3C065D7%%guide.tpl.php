<?php /* Smarty version 2.6.27, created on 2017-03-07 18:35:45
         compiled from /vagrant/www/eccube-2.13.5-mysql/html/../data/Smarty/templates/default/frontparts/bloc/guide.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/vagrant/www/eccube-2.13.5-mysql/html/../data/Smarty/templates/default/frontparts/bloc/guide.tpl', 28, false),)), $this); ?>

<?php echo '<div class="block_outer"><div id="guide_area" class="block_body"><ul class="button_like"><li><a href="'; ?><?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo 'abouts/'; ?><?php echo ((is_array($_tmp=@DIR_INDEX_PATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '" class="'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['tpl_page_class_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'LC_Page_Abouts'): ?><?php echo 'selected'; ?><?php endif; ?><?php echo '">当サイトについて</a></li><li><a href="'; ?><?php echo ((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo 'contact/'; ?><?php echo ((is_array($_tmp=@DIR_INDEX_PATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '" class="'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['tpl_page_class_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'LC_Page_Contact' || ((is_array($_tmp=$this->_tpl_vars['tpl_page_class_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'LC_Page_Contact_Complete'): ?><?php echo 'selected'; ?><?php endif; ?><?php echo '">お問い合わせ</a></li><li><a href="'; ?><?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo 'order/'; ?><?php echo ((is_array($_tmp=@DIR_INDEX_PATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '" class="'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['tpl_page_class_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'LC_Page_Order'): ?><?php echo 'selected'; ?><?php endif; ?><?php echo '">特定商取引法に基づく表記</a></li><li><a href="'; ?><?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo 'guide/privacy.php" class="'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['tpl_page_class_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'LC_Page_Guide_Privacy'): ?><?php echo 'selected'; ?><?php endif; ?><?php echo '">プライバシーポリシー</a></li></ul></div></div>'; ?>
