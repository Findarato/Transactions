<?
$set = 0;
include_once("../header.php");
?>

<a href="#" class="catalink" onclick="displayPage('includes/catagory_add.php?parent=0')">Add Catagory</a><br />
<?
function checkChange($value,$arr) {
	$result = false;
	foreach($arr as $test) {
		if($test == $value) {
			$result = true;	
		}
	}
	return $result;	
}

if(isset($_GET["change"]) || isset($_SESSION["change"])) {
	if(isset($_SESSION["change"])) {
		if(isset($_GET["change"])) {
			if(!checkChange($_GET["change"],explode("|",$_SESSION["change"])))
				$_SESSION["change"].="|".$_GET["change"];
			else
				$_SESSION["change"] = str_replace("|".$_GET["change"],"",$_SESSION["change"]);
		}
		$changeArr = explode("|",$_SESSION["change"]);
	}		
	else {
		$_SESSION["change"] = "|".$_GET["change"];
		$changeArr = explode("|",$_SESSION["change"]);
	}
} else {
	$changeArr = array("");
}
//unset($_SESSION["change"]);
//print_r($changeArr);
if( isset($_GET["addParent"]) && isset($_GET["name"]) ) {
	$sql = "INSERT INTO $tcata VALUES ('','".$_SESSION["dktn"]."','".$_GET["name"]."','".$_GET["addParent"]."','temp.png')";
	mysql_query( $sql );
}
if( isset($_GET["del_cat"]) && isset($_GET["cat"]) ) {
	if($_GET["del_cat"]==1)	{
		if(isset($_GET["continue"])) {
			if($_GET["continue"]=="yes") {
				$sql = "DELETE FROM $tcata WHERE cate_id=".$_GET["cat"];
				mysql_query( $sql );
				$sql2 = "DELETE FROM $tcata WHERE parent=".$_GET["cat"];
				mysql_query( $sql2 );
				echo "Category Removed";
			}
		}
		else {
			echo "Are you Sure you Want to Remove this Category and all children? <br />
			<a href=\"#\" onClick=displayPage('includes/catagory_add.php?del_cat=1&cat=$_GET[cat]&continue=yes')>Yes</a> | 
			<a href=\"#\" onClick=displayPage('includes/catagory_add.php')>No</a>";
		}
	}
}
if( isset ($_GET["parent"]) ) {
$set = 1;
$HTML = <<<START
<input type="text" name="name" class="shadow" id="name">
<a href="#" onClick="displayPage('includes/catagory_add.php?addParent='+document.getElementById('parent').value+'&name='+document.getElementById('name').value)">Add</a><input id="parent" name="parent" type="hidden" value="$_GET[parent]">
START;
}
	if($set==1 && $_GET["parent"]==0)
		echo $HTML;
?>
<table width="80%" cellpadding="0" cellspacing="0" border="0" align="left">
<?
	$sql = "SELECT * FROM $tcata WHERE user_id='".$_SESSION["dktn"]."' and parent=0 ORDER BY cata_name";
	$result = mysql_query ($sql);
	while ( $line =  mysql_fetch_row($result) )	{ 
		$totalTree = GetTotalTree($line[0],$tledger,$tcata);
		if(!checkChange($line[0],$changeArr)) {
			$imgsrc = "images/arrow-forward.png";
			$alt = "Show SubCategories";
		} 
		else {
			$imgsrc = "images/arrow-down.png";
			$alt = "Hide SubCategories";
		}
		
echo<<<P
<tr>
	<td width="10" class="credit">
		<a title="remove $line[2]" class="cata" href="#" onClick="displayPage('includes/catagory_add.php?del_cat=1&cat=$line[0]')">-</a>
	</td>
	<td width="16" class="credit"><a title="$alt" href="#" onClick="displayPage('includes/catagory_add.php?change=$line[0]')"><img src="$imgsrc" border="0" alt="$alt"></a></td>
	<td colspan="2" width="50%" class="credit">$line[2]</td>
	<td class="credit">&nbsp;</td>
	<td class="credit">$totalTree</td>
	<td class="dark" width="150"><a class="adark" href="#" onClick="displayPage('includes/catagory_add.php?parent=$line[0]')"><small>Add Sub Category</small></a></td>
</tr>
P;

	//echo checkChange($line[0],$changeArr);
		$imgsrc = "images/arrow-bullet.png";
		if(!checkChange($line[0],$changeArr)) {
			$result2 = mysql_query ("SELECT * FROM $tcata WHERE user_id='-1' and parent=$line[0] ORDER BY cata_name");
		}
		else {
			$result2 = mysql_query ("SELECT * FROM $tcata WHERE user_id='".$_SESSION["dktn"]."' and parent=$line[0] ORDER BY cata_name");			
		}
		
		while ( $line2 =  mysql_fetch_row($result2) )
		{
			$totalChild = GetChildTotal($line2[0],$tledger,$user,$password,$dbase);
			
echo<<<P
<tr>
	<td width="10" class="debit">
		<a title="remove $line2[2]" class="cata" href="#" onClick="displayPage('includes/catagory_add.php?del_cat=1&cat=$line2[0]')">-</a>
	</td>
	<td width="10" class="debit">&nbsp;</td>
	<td width="16" class="debit"><img src="$imgsrc"></td>
	<td width="50%" class="debit">$line2[2]</td>
	<td class="debit">&nbsp;</td>
	<td class="debit">&nbsp;&nbsp;&nbsp;$totalChild</td>
	<td class="debit">&nbsp;</td>
</tr>
P;
		}
		if($set==1 && $_GET["parent"]==$line[0])
		{
echo<<<P
<tr>
	<td width="10" class="debit">&nbsp;</td>
	<td width="10" class="debit">&nbsp;</td>
	<td width="16" class="debit"><img src="$imgsrc" align="left" /></td>
	<td colspan="5" class="debit">$HTML</td>
</tr> 
P;
		}
	}
?>
</table>
<? include_once("footer.php"); ?>