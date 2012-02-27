<?php /* Smarty version 2.6.18, created on 2008-09-16 14:45:59
         compiled from category_add.tpl */ ?>
<form action="" method="post">
	Main Category<select name="addmainCategory">
    <option value="0">New Top Level</option><?php $_from = $this->_tpl_vars['mainCate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['cate']):
?>
    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['cate']; ?>
</option><?php endforeach; endif; unset($_from); ?>
    </select>
   New Category Name
  <input type="text" name="newCateName" id="newCateName">
   <input type="submit" name="button" id="button" value="Add">
</form>