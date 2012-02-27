{literal}
<script language="javascript">
	function colorView(obj){//should allow for changing the view color
		var tbc = document.getElementById(obj.name);
		tbc.style.backgroundColor=obj.value;
	}
</script>
{/literal}
<h2>View and Edit Preferences</h2>
<form name="pref">
<table  cellpadding="0" cellspacing="0">
	<tr>
		<td>Name:</td>
        <td><input type="text" name="first" value="{$firstName}"></td>
     </tr>
	<tr>
		<td>Date Format:</td>
        <td><input type="text" name="df" value="{$pref.date_format}"></td>
        <td><a href="http://us.php.net/date" style="text-decoration:none" target="_blank">Help</a></td>
     </tr>
	<tr>
		<td>Year Ending:</td>
        <td><input type="text" name="df" value="{$pref.year_ending}"></td>
     </tr>
	<tr>
		<td>Theme:</td>
        <td><select name="theme" enabled="false"><option>Default</option></select></td>
     </tr>
	<tr>	 	
		<td>Progress Bar Background Color:</td>
        <td><input maxlength="7" type="text" name="progbgc" value="{$pref.progbgc}" onKeyUp="colorView(this)"></td>
		<td><div id="progbgc" style="width:16px; height:16px; background-color:{$pref.progbgc};"></div></td>
     </tr>
	<tr>
		<td>Progress Bar Border Color:</td>
        <td><input maxlength="7" type="text" name="progframe" value="{$pref.progframe}" onKeyUp="colorView(this)"></td>
		<td><div id="progframe" style="width:16px; height:16px; background-color:{$pref.progframe};"></div></td>
     </tr>
	<tr>
		<td>Progress Bar Fill Good:</td>
        <td><input maxlength="7" type="text" name="progfill" value="{$pref.progfill}" onKeyUp="colorView(this)"></td>
		<td><div id="progfill" style="width:16px; height:16px; background-color:{$pref.progfill};"></div></td>
     </tr>                         
	<tr>
		<td>Progress Bar Fill Warning:</td>
        <td><input maxlength="7" type="text" name="progfill2" value="{$pref.progfill2}" onKeyUp="colorView(this)"></td>
		<td><div id="progfill2" style="width:16px; height:16px; background-color:{$pref.progfill2};"></div></td>
     </tr>
	<tr>
		<td>Progress Bar Fill Bad:</td>
        <td><input maxlength="7" type="text" name="progfill3" value="{$pref.progfill3}" onKeyUp="colorView(this)"></td>
		<td><div id="progfill3" style="width:16px; height:16px; background-color:{$pref.progfill3};"></div></td>
     </tr>
	<tr>
		<td>Progress Bar Image Type:</td>
        <td>{$pref.imgtype}</td>
     </tr>
	<tr>
		<td>Fuel Category:</td>
        <td><input maxlength="7" type="text" name="first" value="{$pref.fuel_cate_id}"></td>
     </tr>               
</table></form>