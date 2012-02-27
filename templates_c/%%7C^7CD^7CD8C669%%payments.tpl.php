<?php /* Smarty version 2.6.18, created on 2009-01-29 16:21:43
         compiled from payments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'payments.tpl', 16, false),)), $this); ?>
<h1>Current Payment Accounts</h1>
<table cellpadding="0" cellspacing="0" border="0" style="width:90%">
    <tr>
        <td>Account Name</td>
        <td>Account Type</td>
        <td>Interest</td>
        <td>Category Linked</td>
        <td>Balance</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
	<?php $_from = $this->_tpl_vars['acctCate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['acc']):
?>
	<?php if (( $this->_tpl_vars['acc']['credit']-$this->_tpl_vars['acc']['debit'] ) == 0): ?> <?php $this->assign('color', "#000000"); ?>
    <?php else: ?> <?php $this->assign('color', "#FFFFFF"); ?>
    <?php endif; ?>
    <tr style="color:<?php echo $this->_tpl_vars['color']; ?>
; background:<?php echo smarty_function_cycle(array('values' => ','), $this);?>
">
        <td><?php echo $this->_tpl_vars['acc']['acct_name']; ?>
</td>
        <td><?php echo $this->_tpl_vars['acc']['acct_type']; ?>
</td>
        <td><?php echo $this->_tpl_vars['acc']['interest']; ?>
%</td>
        <td><?php echo $this->_tpl_vars['acc']['cate_name']; ?>
</td>
        <td><?php echo $this->_tpl_vars['acc']['credit']-$this->_tpl_vars['acc']['debit']; ?>
</td>
        <td><?php if (( $this->_tpl_vars['acc']['credit']-$this->_tpl_vars['acc']['debit'] ) < 0): ?><a href="<?php echo $this->_tpl_vars['path']; ?>
#pay/<?php echo $this->_tpl_vars['acc']['id']; ?>
" title="Pay <?php echo $this->_tpl_vars['acc']['acct_name']; ?>
"><img src="../images/Icons/money_delete.png"></a><?php endif; ?></td>
        <td><a href="<?php echo $this->_tpl_vars['path']; ?>
#delete/<?php echo $this->_tpl_vars['acc']['id']; ?>
" title="Delete <?php echo $this->_tpl_vars['acc']['acct_name']; ?>
"><img src="../images/Icons/delete.png"></a></td>
    </tr>
	<?php endforeach; endif; unset($_from); ?>
        <tr>
        <td colspan="3">Total Value of All accounts:</td>
        <td>&nbsp;</td>
        <td><?php echo $this->_tpl_vars['acctTotal']; ?>
</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="4"><h2><a href="<?php echo $this->_tpl_vars['path']; ?>
payments/new" title="Add a new Payment Account">New Payment Account</a></h2></td>
    </tr>
</table>
<div>
	<div id="payNew" style="display:none"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "payments_new.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
   	<div id="paySuccess" style="display:none"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "payments_success.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
</div>