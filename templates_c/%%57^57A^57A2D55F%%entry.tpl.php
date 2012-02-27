<?php /* Smarty version 2.6.18, created on 2010-02-19 12:51:34
         compiled from fuel/entry.tpl */ ?>
<form name="fuel" method="post">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td>Price Paid:</td>
			<td><input type="text" name="paid" style="width:7em; " maxlength="10"><td>
		<tr>
		<tr>
			<td>Price per Unit:</td>
			<td><input type="text" name="price" style="width:7em; " maxlength="10"></td>
		</tr>
		<tr>
			<td>Amount:</td>
			<td><input type="text" name="amount" style="width:7em; " maxlength="10"></td>
		</tr>
		<tr>
			<td>Type:</td>
			<td><select name="type"><option>Gallon</option><option>Liter</option></select></td>
		</tr>
		<tr>
			<td>Miles:*</td>
			<td><input type="text" name="miles" style="width:7em; " maxlength="5"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Add"/></td>
		</tr>
	</table>
	<span style="font-size-adjust:-3em">*Previous tank</span><br />
	<span style="font-size-adjust:-3em"><a href="http://www.google.com/search?q=1+gallon+in+litres">1 US gallon = 3.7854118 liters</a></span><br />
	<span style="font-size-adjust:-3em"><a href="fuel/graphs.php">View Graphs</a></span>
	<input type="hidden" name="fuel_tracker" value="add" />
</form>