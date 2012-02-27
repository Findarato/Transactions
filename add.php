<html>
<head>
<? 
include_once("header.php");

if( !isset($_GET["t"]) )
	$_GET["t"]="debit";

if(! isset($_SESSION["accountNo"]) )
	echo "Please choose an Account";
 ?>

</head>
<table width="50%" cellpadding="3" cellspacing="0" align="center" border="0">
	<tr>
		<td width="50%" class="credit" align="center"><a href="add.php?account=<?=$_SESSION["accountNo"];?>&t=credit" target="bottom">Deposit to account #<?=$_SESSION["accountNo"];?></a></td>
		<td width="50%" class="debit" align="center"><a href="add.php?account=<?=$_SESSION["accountNo"];?>&t=debit" target="bottom">Widthdraw from account #<?=$_SESSION["accountNo"];?></a></td>
	</tr>
	<tr>
		<td colspan="2" class="<?=$_GET[t];?>">
			<form name="transaction" method="post" action="handle.php"> 
				<table width="100%">
					<tr>
						<td width="70%">Ammount:<input type="text" name="<?=$_GET["t"];?>"></td>
						<td>Check No. :<input type="text" name="ckno" size="6" maxlength="6"></td>
					</tr>
					<tr>
						<td colspan="2">Catagory
							<Select name="mainCategory" onChange="getChild();" id="mainCategory">
								<option>Top Level</option>
								     <?
									 $qry=mysql_query("SELECT * FROM $tcata WHERE user_id='$_SESSION[dktn]'AND parent='0' ORDER BY cata_name");
								     while($line = mysql_fetch_array($qry)){
								     	echo "<option value='$line[cate_id]'>$line[cata_name]</option>\n";
								     }
								     ?>	 
							</select>
							Sub Catagory
							<SELECT name="subCategory" id="subCategory">
							</SELECT>
						</td>
					</tr>
					<tr>
						<td>Note:<input type="text" name="note" width="500"></td>
						<td><input type="submit" name="submit" value="submit" /></td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
</html>