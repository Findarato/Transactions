<?php /* Smarty version 2.6.18, created on 2009-01-22 21:51:56
         compiled from reminders_display.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'reminders_display.tpl', 4, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['reminder']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['r']):
?>
	<div id="div-<?php echo $this->_tpl_vars['r']['id']; ?>
">
        <img src="images/Icons/exclamation.png" onclick="checkBox(<?php echo $this->_tpl_vars['r']['id']; ?>
)" id="<?php echo $this->_tpl_vars['r']['id']; ?>
" alt="check box" /><?php echo $this->_tpl_vars['r']['title']; ?>

        <input type="hidden" id="<?php echo $this->_tpl_vars['r']['id']; ?>
" value="false" /><?php echo ((is_array($_tmp=$this->_tpl_vars['r']['dt'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m.%d.%y') : smarty_modifier_date_format($_tmp, '%m.%d.%y')); ?>
 <span class="fakelink" onclick="toggleDiv('div-<?php echo $this->_tpl_vars['r']['id']; ?>
')">+</span><?php echo $this->_tpl_vars['r']['status']; ?>
<br />    
   	</div>
<?php endforeach; endif; unset($_from); ?>