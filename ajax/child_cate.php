<?
error_reporting(E_ALL);
header("Content-type: text/xml");
header("Cache-Control: no-cache"); 
//this will be used to update ledger entries edited though the quick edit
//started 7/31/2008
//Array ( [id] => 758 [value] => 01.24.08d [colmn] => dt ) 
$status_code=0; //no code has run
function __autoload($class_name) { require_once "../classes/".strtolower($class_name) . '.class.php'; }
$db = db::getInstance();
if(isset($_POST) && isset($_POST['id'])){//this is a valid post
	$db -> Query("SELECT id,cate_name FROM ".$db->Prefix."categories WHERE parent=$_POST[id]");
	$result = $db->Format("assoc_array");
	if(count($db->Error)>0) {$status_code=2;} else {$status_code=1;}
	if(!isset($db->Error['Query'])){$db->Error['Query']="";$db->Error['Error']="";}
}
echo "<?xml version=\"1.0\"?>\n"; 
echo "<transaction>\n";
echo "\t<status>$status_code</status>\n";
echo "\t<time>".time()."</time>\n"; 
echo "\t<error>\n";
echo "\t\t<query>". $db->Error['Query']."</query>\n";
echo "\t\t<message>". $db->Error['Error']."</message>\n";
echo "\t</error>\n";
echo "\t<Parent_id>".$_POST['id']."</Parent_id>\n";
foreach ($result as $res){
	echo "\t<child>\n";
	echo "\t\t<id>".$res['id']."</id>\n";
	echo "\t\t<name>".$res['cate_name']."</name>\n";
	echo "\t</child>\n";
}
echo "</transaction>\n";
?>