<?php /* Smarty version 2.6.18, created on 2008-12-30 09:03:55
         compiled from preferences.tpl */ ?>
<?php echo '
<script language="javascript">
	function colorView(obj){//should allow for changing the view color
		var tbc = document.getElementById(obj.name);
		tbc.style.backgroundColor=obj.value;
	}
</script>
'; ?>

<h2>View and Edit Preferences</h2>
<form name="pref">
<table  cellpadding="0" cellspacing="0">
	<tr>
		<td>Name:</td>
        <td><input type="text" name="first" value="<?php echo $this->_tpl_vars['firstName']; ?>
"></td>
     </tr>
	<tr>
		<td>Date Format:</td>
        <td><input type="text" name="df" value="<?php echo $this->_tpl_vars['pref']['date_format']; ?>
"></td>
        <td><a href="http://us.php.net/date" style="text-decoration:none" target="_blank">Help</a></td>
     </tr>
	<tr>
		<td>Year Ending:</td>
        <td><input type="text" name="df" value="<?php echo $this->_tpl_vars['pref']['year_ending']; ?>
"></td>
     </tr>
	<tr>
		<td>Theme:</td>
        <td><select name="theme" enabled="false"><option>Default</option></select></td>
     </tr>
	<tr>	 	
		<td>Progress Bar Background Color:</td>
        <td><input maxlength="7" type="text" name="progbgc" value="<?php echo $this->_tpl_vars['pref']['progbgc']; ?>
" onKeyUp="colorView(this)"></td>
		<td><div id="progbgc" style="width:16px; height:16px; background-color:<?php echo $this->_tpl_vars['pref']['progbgc']; ?>
;"></div></td>
     </tr>
	<tr>
		<td>Progress Bar Border Color:</td>
        <td><input maxlength="7" type="text" name="progframe" value="<?php echo $this->_tpl_vars['pref']['progframe']; ?>
" onKeyUp="colorView(this)"></td>
		<td><div id="progframe" style="width:16px; height:16px; background-color:<?php echo $this->_tpl_vars['pref']['progframe']; ?>
;"></div></td>
     </tr>
	<tr>
		<td>Progress Bar Fill Good:</td>
        <td><input maxlength="7" type="text" name="progfill" value="<?php echo $this->_tpl_vars['pref']['progfill']; ?>
" onKeyUp="colorView(this)"></td>
		<td><div id="progfill" style="width:16px; height:16px; background-color:<?php echo $this->_tpl_vars['pref']['progfill']; ?>
;"></div></td>
     </tr>                         
	<tr>
		<td>Progress Bar Fill Warning:</td>
        <td><input maxlength="7" type="text" name="progfill2" value="<?php echo $this->_tpl_vars['pref']['progfill2']; ?>
" onKeyUp="colorView(this)"></td>
		<td><div id="progfill2" style="width:16px; height:16px; background-color:<?php echo $this->_tpl_vars['pref']['progfill2']; ?>
;"></div></td>
     </tr>
	<tr>
		<td>Progress Bar Fill Bad:</td>
        <td><input maxlength="7" type="text" name="progfill3" value="<?php echo $this->_tpl_vars['pref']['progfill3']; ?>
" onKeyUp="colorView(this)"></td>
		<td><div id="progfill3" style="width:16px; height:16px; background-color:<?php echo $this->_tpl_vars['pref']['progfill3']; ?>
;"></div></td>
     </tr>
	<tr>
		<td>Progress Bar Image Type:</td>
        <td><?php echo $this->_tpl_vars['pref']['imgtype']; ?>
</td>
     </tr>
	<tr>
		<td>Fuel Category:</td>
        <td><input maxlength="7" type="text" name="first" value="<?php echo $this->_tpl_vars['pref']['fuel_cate_id']; ?>
"></td>
     </tr>               
</table></form>