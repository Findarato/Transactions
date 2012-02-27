<?php /* Smarty version 2.6.18, created on 2010-02-18 10:48:57
         compiled from accounts_display.tpl */ ?>
	<select id="account_dd" style="min-width:20em;">
	<?php $_from = $this->_tpl_vars['accinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['acc']):
?>
		<option value="<?php echo $this->_tpl_vars['acc']['id']; ?>
"><?php echo $this->_tpl_vars['acc']['name']; ?>
 - Balance: $<?php echo $this->_tpl_vars['acc']['balance']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>