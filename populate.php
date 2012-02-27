<?
require("config.php");
require("database.inc");

$output = array();
$sql = "SELECT * FROM $tcata WHERE parent='$_GET[parent]'";
$result = mysql_query($sql);
while($line = mysql_fetch_row($result))
{
	$output[$line[0]] = $line[2];
}

function EscapeString($str)
{
   $str = str_replace(array('\\', "'"), array("\\\\", "\\'"), $str);
   $str = preg_replace('#([\x00-\x1F])#e', '"\x" . sprintf("%02x", ord("\1"))', $str);

   return $str;
}
echo EscapeString( serialize ($output) );
?>