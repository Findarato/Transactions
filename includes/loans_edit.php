<?
/*------------------------------------------------------------------------------**
**						Started November 3, 2006								**
**This will allow for loan display and editing.  The account assigned to the	**
**loan are the categorys that will determin the payments or charges on the loan	**
**Intrest will be calculated on a bases determined each time the loan payment	**
**Is paid, and the value goes down.  If the value ever goes up the intrest will	**
**Not be calculated till the next negative payment to the account.				**	
**------------------------------------------------------------------------------*/
	include_once("../header.php");
//HTML insert new loan fields.
$HTML = "";

$HTML = <<<START
<form name="transaction" method="post" action="">
  Add New Loan<br>
  Name: 
  <input type="text" name="name">
	<Select name="mainCatagory" onChange="getChild();">
		<option>Top Level</option>
START;
		 $qry=mysql_query("SELECT * FROM $tcata WHERE user_id='$_SESSION[dktn]'AND parent='0' ORDER BY cata_name");
		 while($line = mysql_fetch_array($qry)){
			$HTML .= "<option value='$line[cate_id]'>$line[cata_name]</option>\n";
		 }

$HTML .= <<<MORE
	</select>
	Sub Catagory
	<SELECT name="subCatagory">
	</SELECT>Starting Value<input name="startValue" type="text" size="9" maxlength="9">Intrest Rate<input name="intrestRate" type="text" size="4" maxlength="4">
  Frequency
  <select name="select">
    <option>Select</option>
    <option value="12">Monthly</option>
    <option value="2">Bi-Yearly</option>
    <option value="1">Yearly</option>
  </select>
<input type="button" value="Add" onClick="displayPage('includes/catagory_add.php?name='+document.cata_add.name.value)">\n
</form>
MORE;
echo $HTML;
?>
<br>
<table width="95%" border="1" cellspacing="0" cellpadding="0">
  <tr class="columnheader">
    <td>+</td>
    <td>Name</td>
    <td>Category</td>
    <td>Intrest Rate</td>
    <td>Remaining Balance</td>
  </tr>
<?
	$sql = "SELECT * FROM $tloans WHERE user_id='".$_SESSION["dktn"]."'";
	$result = mysql_query ($sql) or die($sql);
	while($line = mysql_fetch_assoc($result)) {
?>	
	<tr>
		<td>&nbsp;</td>
		<td><?=$line["name"];?></td>
		<td><?=makeCateStr($line["cate_id"],$tcata);?></td>
		<td><?=($line["intrest"]*100)."%";?></td>




		<td>&nbsp;</td>
	</tr>
<?	}?>

  <tr class="columnfooter">
    <td>&nbsp;</td>
    <td>Total Loans</td>
    <td>&nbsp;</td>
    <td>Average Rate</td>
    <td>&nbsp;</td>
  </tr>
</table>
