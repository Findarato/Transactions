<?
error_reporting(E_ALL);
header("Content-type: text/xml");
header("Cache-Control: no-cache"); 
echo "<?xml version=\"1.0\"?>"; 
session_start();
//this will be used to update ledger entries edited though the quick edit
//started 1/3/2008
//Array ( [id] => 758 [value] => 01.24.08d [colmn] => dt ) 
$status_code=0; //no code has run

function __autoload($class_name) { require_once "../classes/".strtolower($class_name) . '.class.php'; }

if(isset($_SESSION['user'])){
	$user = unserialize($_SESSION["user"]);
	if($user -> User_id > 0){
		$db = db::getInstance();
			if(isset($_POST) && isset($_POST['colmn'])){//this is a valid post
			$db -> Query("UPDATE ".$db->Prefix."ledger SET ".$_POST['colmn']. "='".$_POST['value']."' WHERE id=".$_POST['id']);
			if(count($db->Error)>0) {$status_code=2;} else {$status_code=1;}
			}
		echo "<transaction>";
		echo "<status>$status_code</status>";
		echo "<time>".time()."</time>"; 
		echo "<error>";
		echo "<query>".$db->Error['Query']."</query>";
		echo "<message>".$db->Error['Error']."</message>";
		echo "</error>";
		echo "<id>".$_POST['id']."</id>";
		echo "<colmn>".$_POST['colmn']."</colmn>";
		echo "<value>".$_POST['value']."</value>";
		echo "</transaction>";
	}else{
		echo "<transaction>";
		echo "<status>-1</status>";
		echo "<message>Invalid User Credentials</message>";
		echo "<time>".time()."</time>"; 
		echo "</transaction>";
	}
}else{
	echo "<transaction>";
	echo "<status>-1</status>";
	echo "<message>Not a valid Signed in user</message>";
	echo "<time>".time()."</time>"; 
	echo "</transaction>";
}
?>