<?php /* Smarty version 2.6.18, created on 2010-07-29 07:18:05
         compiled from body.tpl */ ?>
<!DOCTYPE html> 
<html>
<head>
<title>Transactions 4.0</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
<link rel="icon" type="image/png" href="/favicon.png" />
<link rel="stylesheet" type="text/css" href="/css/compressCSS.php" />
<link rel="stylesheet" type="text/css" href="http://dev.lapcat.org/lapcat/css/themes/theme-generator.php?theme=22&hsl" />  

<script src="http://www.google.com/jsapi?key=ABQIAAAAgKEXpyuhLcubE3-WZ6VbexT_dJu11DRH4mLmc0ise298e6LV1BTu6rGcZpCCv4rGviQhrQxxWakg0A" type="text/javascript"></script>
<?php echo '
<script type="text/javascript">
google.load("jquery", "1.4.2", {uncompressed:false});
google.load("jqueryui", "1.7.0", {uncompressed:false});
</script>
'; ?>

<script type="text/javascript" src="http://dev.lapcat.org/dateter/dateter.js"></script>
<script type="text/javascript" src="/js/globalFunctions.js"></script>
<script type="text/javascript" src="/js/jquery.colorbox.js"></script>
<script type="text/javascript" src="/js/jquery.purr.js"></script>
<script type="text/javascript" src="http://cdn1.lapcat.org/dateter/dateter.js"></script>
<script type="text/javascript" src="/js/transactions.js"></script>
<script src="http://cdn1.lapcat.org/js/RGraph/libraries/RGraph.common.js" ></script>
<script src="http://cdn1.lapcat.org/js/RGraph/libraries/RGraph.bar.js" ></script>
<script src="http://cdn1.lapcat.org/js/RGraph/libraries/RGraph.line.js" ></script>


</head>
<body class="image-background color-B-1" onResize="javascript:resize();">
<div class="corners-top-2 corners-bottom-2 border-all-K-2" style="display:block; width:800px; height:auto;margin:0 auto;margin-top:5px;">
<div class="button" style="height:50px;line-height:50px;width:auto;">Transactions 5.0</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "topper.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>		
		<div class="corners-top-2 corners-bottom-2 color-B-2 color-B-2 border-all-B-1" style="margin:4px;margin-top:10px;padding:2px;height:20px;position:relative;width:auto">
			<div id="mnuAdd" class="t-sidemenu td" ><img src="../images/Icons/add.png"> New Entry</div>
			<div id="mnuAddFuel" class="t-sidemenu td" ><img src="../images/Icons/car.png"> New Fuel Entry</div>
			<div id="mnuLedger" class="t-sidemenu td"><a class="nolink" href="#ledger"><img src="../images/Icons/book.png"> Ledger</a></div>
			<div id="mnuCategories" class="t-sidemenu td"><a class="nolink"href="#categories"><img src="../images/Icons/table.png"> Categories</a></div>
			<div id="mnuReports" class="t-sidemenu td"><a class="nolink"href="#reports"><img src="../images/Icons/chart_bar.png"> Reports</a></div>
			<div id="mnuCalendar" class="t-sidemenu td"><A class="nolink"href="#calendar"><img src="../images/Icons/calendar.png"> Calendar</a></div>
			<div id="mnuGoals" class="t-sidemenu td"><A class="nolink" href="#goals"><img src="../images/Icons/emoticon_smile.png" style="width:16px;height:16px;"> Goals</a></div>
			<div id="mnuPayments" class="t-sidemenu td"><A class="nolink" href="#payments"><img src="../images/Icons/money_delete.png"> Payments</a></div>
		</div>	
		<div class="background-alpha-2 td" id="right-side" style="display:block;margin-right:4px;width:auto;">

			<div id="content"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['content']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
		</div>
	 
</div> 
<!--This is all the hidden elements.  They are preloaded to make the page load faster -->
<div id="ledgerTpl" class="ui-helper-hidden"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ledger.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="quickEntryTpl" class="ui-helper-hidden"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "quick_entry.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="quickEntryFuelTpl" class="ui-helper-hidden"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "quick_entry_fuel.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="genericTpl" class="ui-helper-hidden"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'generic.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="goalsaddTpl" class="ui-helper-hidden"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'goals_add.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>

 
<div id="popper_calculator" style=" width:170px; height:200px;" class="ui-helper-hidden ui-widget-header ui-corner-bottom"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'calculator.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="poper_search" class="ui-helper-hidden ui-widget-header ui-corner-bottom" style="padding:10px; width:240">
Category:<select id="popper_search_cate" name="category"><option value="ALL">All Categories</option><?php $_from = $this->_tpl_vars['childCate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childParent'] => $this->_tpl_vars['mainSet']):
?><optgroup label="<?php echo $this->_tpl_vars['mainCate'][$this->_tpl_vars['childParent']]; ?>
"><option value="<?php echo $this->_tpl_vars['childParent']; ?>
"><?php echo $this->_tpl_vars['mainCate'][$this->_tpl_vars['childParent']]; ?>
</option><?php $_from = $this->_tpl_vars['mainSet']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childParent'] => $this->_tpl_vars['child']):
?><option value="<?php echo $this->_tpl_vars['child']['id']; ?>
"><?php echo $this->_tpl_vars['child']['name']; ?>
</option><?php endforeach; endif; unset($_from); ?></optgroup><?php endforeach; endif; unset($_from); ?></select><br>
Date<input type="text" name="search" maxlength="10" width="10" id="popper_search_text" class="inputWhite"><input type="button" value="Go" id="popper_search_button"></div>
<div id="paymentTpl" class="ui-helper-hidden"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'payment.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="paymentNew" class="ui-helper-hidden"><form id="payform" action="javascript:void(0);"><span id="payheader">Account Name</span>Ammount:<input type="text" id="payammount" value=""><input type="hidden" id="paymentid" value=""> <input type="hidden" id="cate_id" value=""></form></div>

</body>
</html>