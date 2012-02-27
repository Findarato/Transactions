<?php /* Smarty version 2.6.18, created on 2010-02-19 12:51:34
         compiled from reports.tpl */ ?>
<div id="reportstabs">
	<ul>
		<li><a href="#reportstabs-1">Ledger</a></li>
		<li><a href="#reportstabs-2">Fuel Tracker</a></li>
	</ul>
	<div id="reportstabs-1">
        <div>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'reports_graphs.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
	</div>
	<div id="reportstabs-2">
       <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'fuel/graphs.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>