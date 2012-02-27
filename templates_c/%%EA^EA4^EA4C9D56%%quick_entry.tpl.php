<?php /* Smarty version 2.6.18, created on 2010-04-29 14:25:31
         compiled from quick_entry.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'quick_entry.tpl', 5, false),array('function', 'html_options', 'quick_entry.tpl', 13, false),)), $this); ?>
<div id="newEntrydialog">
	<div class="border-all-B-1 color-D-1" style="padding:5px;">
		<form id="newTransaction" method="post">
			Ammount:<input class="transactionForm" type="text" name="ammount" style="width:7em; " maxlength="10"   /><br />
			<?php echo smarty_function_html_radios(array('name' => 'type','options' => $this->_tpl_vars['dc'],'selected' => 'd'), $this);?>

		    <br />
			Category:<BR />
			<select class="transactionForm" name="mainCategory" onChange="javascript:displayChild(this.options[this.selectedIndex].value)">
				<option value=""></option><?php $_from = $this->_tpl_vars['mainCate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['cate']):
?><option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['cate']; ?>
</option><?php endforeach; endif; unset($_from); ?></select>
				<br />
			SubCategory:<BR /><SELECT class="transactionForm" name="subCategory" id="subCategory" style="min-width:10em;"></SELECT><br />
			Note:<input class="transactionForm" type="text" name="note" style="width:12em;" maxlength="100"   /><br />
			Account:<?php echo smarty_function_html_options(array('ID' => 'transAccount','name' => 'account','options' => $this->_tpl_vars['accnt']), $this);?>

			<input type="hidden" name="add" value="yes"/><br />
		</form>
				<div class="table textLeft" style="width:100px">
				<div class="td"><a class="option-theme fg-button ui-corner-all white lapcatButton Cancel" id="addTransactionCancelBtn">Cancel</a></div>
				<div class="td"><a class="option-theme fg-button ui-corner-all white lapcatButton" id="addTransactionBtn">Add</a></div>
			</div>
		</div>		
	</div>
</div>