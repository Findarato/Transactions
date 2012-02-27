<?php /* Smarty version 2.6.18, created on 2009-01-21 20:35:43
         compiled from body2.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Transactions 4.0</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
<link rel="icon" type="image/png" href="/favicon.png" />
<link rel="stylesheet" type="text/css" media="screen" href="jquery/jqGridinc/themes/transactions/grid.css" />
<link rel="stylesheet" type="text/css" href="/css/compressCSS.php?new" />
<!-- JQuery and manditory header javascript  -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript" src="/jquery/jquery.jqGrid.js"></script>
<script type="text/javascript" src="/jquery/ui/jquery.ui.all.min.js"></script>
<script type="text/javascript" src="/js/transactions.js"></script>
<script type="text/javascript" src="/js/swfobject2.js"></script>
</head>
<body>
<div id="container">
  <div id="header">
    <h1>Transactions</h1>
    <h3>The checkbook from Hell!</h3>
  </div>
  <div id="wrapper">
    <div id="content" class="container roundborder">
      <div> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['content']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php if ($this->_tpl_vars['location'] == 'home'): ?><?php endif; ?> </div><br><br>
      <div class="white"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
    </div>
  </div>
  <div id="navigation">
    <ul>
      <LI><A href="javascript:void(0)" id="quickAdd"><img src="../images/Icons/add.png" class="goalImage"> Add New Entry</A></LI>
      <LI class="selected" id="mnuLedger"><A href="http://transactions.findarato.org"><img src="../images/Icons/book.png" class="goalImage">Ledger</A></LI>
      <LI id="mnuCategories"><A href="/<?php echo $this->_tpl_vars['path']; ?>
categories"><img src="../images/Icons/table.png" class="goalImage"> Categories</A></LI>
      <LI id="mnuReports"><A href="/<?php echo $this->_tpl_vars['path']; ?>
reports"><img src="../images/Icons/chart_bar.png" class="goalImage"> Reports</A></LI>
      <LI id="mnuCalendar"><A href="/<?php echo $this->_tpl_vars['path']; ?>
cal"><img src="../images/Icons/calendar.png" class="goalImage"> Calendar</A></LI>
      <LI id="mnuGoals"><A href="/<?php echo $this->_tpl_vars['path']; ?>
goals"><img src="../images/Icons/emoticon_smile.png" class="goalImage" style="width:16px;height:16px;"> Goals</A></LI>
      <LI id="mnuReminders"><A href="/<?php echo $this->_tpl_vars['path']; ?>
reminders"><img src="../images/Icons/clock.png" class="goalImage"> Reminders</A></LI>
      <LI id="mnuPayments"><A href="/<?php echo $this->_tpl_vars['path']; ?>
payments"><img src="../images/Icons/money_delete.png" class="goalImage"> Payments</A></LI>
    </ul>
  </div>
  <div class="extra">
    <div style="margin-left:10px; padding-top:3px; border-bottom:#FFF 1px solid"><strong>Quick Add</strong></div>
    <div style="padding:10px; color:#000"> </div>
  </div>
  <div class="extra">
    <div style="margin-left:10px; padding-top:3px; border-bottom:#FFF 1px solid"><strong>Reminders</strong></div>
    <div style="padding:10px; color:#000"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'reminders_display.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
  </div>
  <div id="footer"></div>
</div>
<div id="qAdd" style="display:none; z-index:-10" class="clear"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "quick_add.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
</body>
</html>