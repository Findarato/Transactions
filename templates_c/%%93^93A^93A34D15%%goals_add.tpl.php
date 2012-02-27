<?php /* Smarty version 2.6.18, created on 2010-04-29 14:33:00
         compiled from goals_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'goals_add.tpl', 33, false),)), $this); ?>
<div id="newGoaldialog">
	<div class="border-all-B-1 color-D-1" style="padding:5px;">
		<form id="newGoalForm" action="" method="post">
			<table width="50%" cellpadding="0" cellspacing="0">
				<tr>
					<td>Name:</td>
					<td><input type="text" name="name" />
				</tr>
				<tr>
					<td>Amount:</td>
					<td><input type="text" name="amount" />
				</tr>	
				<tr>
					<td>Frequency:</td>
					<td><select name="frequency"><option value="30">Month</option><option value="360">Year</option></select></td>
				</tr>
				<tr>
					<td>Category:</td>
					<td><select name="category">
					<?php $_from = $this->_tpl_vars['childCate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childParent'] => $this->_tpl_vars['mainSet']):
?>
						<optgroup label="<?php echo $this->_tpl_vars['mainCate'][$this->_tpl_vars['childParent']]; ?>
">
						<option value="<?php echo $this->_tpl_vars['childParent']; ?>
"><?php echo $this->_tpl_vars['mainCate'][$this->_tpl_vars['childParent']]; ?>
</option>
						<?php $_from = $this->_tpl_vars['mainSet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childParent'] => $this->_tpl_vars['child']):
?>
							<option value="<?php echo $this->_tpl_vars['child']['id']; ?>
"><?php echo $this->_tpl_vars['child']['name']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
						</optgroup>
					<?php endforeach; endif; unset($_from); ?>
					</select>
					</td>
				</tr>
				<tr>
					<td>Account:</td>
					<td><?php echo smarty_function_html_options(array('name' => 'account','options' => $this->_tpl_vars['accnt']), $this);?>
</td>
				</tr>
			</table>
		</form>
		<div class="table textLeft" style="width:100px">
			<div class="td"><a class="option-theme fg-button ui-corner-all white lapcatButton Cancel" id="addTransactionCancelBtn">Cancel</a></div>
			<div class="td"><a class="option-theme fg-button ui-corner-all white lapcatButton" id="addGoalBtn">Add</a></div>
		</div>
	</div>
</div>