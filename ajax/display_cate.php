<?Php
/*
Started September 16, 2008
An ajax implementation of the ledger. XML support has been removed in favor of a full json approach
*/
include_once "../functions.php";
session_start();
header('Content-type: application/json');
	$jsonArray = array();
	$jsonArray["status_code"] = 0;
	$status_code=0; //no code has run
	function __autoload($class_name) { require_once "../classes/".strtolower($class_name) . '.class.php'; }
	if(isset($_SESSION['user'])){
		$user = unserialize($_SESSION["user"]);
		$status_code=0.5;
		if($user -> User_id > 0){
			$db = db::getInstance();
			if(isset($_GET['sub'])){
				$id=$_GET['id']; //need to fix this to strip out sql
				$db->Query("SELECT * from ".$db->Prefix.
				"categories WHERE parent=".$id." AND user_id=".$user->User_id." ORDER BY cate_type,cate_name");
				$result = $db -> Format("assoc_array");
			}else{
				$db->Query("SELECT * from ".$db->Prefix.
				"categories WHERE parent=0 AND user_id=".$user->User_id." ORDER BY cate_type,cate_name");
				$result = $db -> Format("assoc_array");
			}
		} 
	}
	if((!isset($_GET['f']) || $_GET['f']=="json")){
		$jsonArray["modified"] = time();
		$jsonArray["result"] = $result;
		echo json_encode($jsonArray);
	}


