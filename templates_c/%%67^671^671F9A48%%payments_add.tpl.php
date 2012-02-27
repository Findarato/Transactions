<?php /* Smarty version 2.6.18, created on 2008-09-20 09:58:12
         compiled from payments_add.tpl */ ?>
<h1>Post Payment to Account:<?php echo $this->_tpl_vars['acct_name']; ?>
</h1>
<form name="form1" method="post" action="">
  Ammount:
  <input type="text" name="ammount" id="ammount">
  <input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
  <input type="hidden" name="cate_id" id="cate_id" value="<?php echo $this->_tpl_vars['cate_id']; ?>
">
<input type="submit" name="button" id="button" value="Post">
</form>