<?php /* Smarty version 2.6.18, created on 2010-05-06 09:42:56
         compiled from topper.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'topper.tpl', 11, false),)), $this); ?>
<div id="topper" class="color-B-2 background-alpha-3" style="border:none;display:table">
	<div class="font-X" id="topper_name" style="display:table-cell; padding-left:1em; padding-right:1em; height:20px;"><?php echo $this->_tpl_vars['firstName']; ?>
</div>
    <div class="font-X" style="display:table-cell;">|</div>
    <div class="font-X" id="topper_calculator" style="display:table-cell;padding-left:1em; padding-right:1em; height:20px;"><span class="fakelink">Calculator</span></div>
    <div class="font-X" style="display:table-cell;">|</div>
    <div class="font-X" id="topper_settings" style="display:table-cell;padding-left:1em; padding-right:1em; height:20px;"><span class="fakelink">Settings</span></div>
    <div class="font-X" style="display:table-cell;">|</div>
    <div class="font-X" id="topper_search" style="display:table-cell; padding-left:1em; padding-right:1em; height:20px;"><span class="fakelink">Search</span></div>
    <div class="font-X" style="display:table-cell;">|</div>
    <div class="font-X" id="topper_search" style="display:table-cell; padding-left:1em; padding-right:1em; height:20px;"><select class="dropdown" id="account_dd" ><option value="0">All Accounts</option><?php $_from = $this->_tpl_vars['accinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['acc']):
?><option value="<?php echo $this->_tpl_vars['acc']['id']; ?>
"><?php echo $this->_tpl_vars['acc']['name']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></div>
    <div class="font-X" id="topper_date" style="display:table-cell;padding-left:1em; padding-right:1em; height:20px;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
</div>
</div>