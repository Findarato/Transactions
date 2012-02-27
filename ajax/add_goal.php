<?
/**
 * Started May 5, 2010
 * Page will update goal information in transactions, and return status information that can be fed back to the user.
 */
header('Content-type: application/json');
include("../small_header.php");

$_GET = $db->Clean($_GET);

if(isset($_GET["account"]) && isset($_GET["amount"]) && isset($_GET["name"])){//this is a valid entry
		$response["message"] = "Budet item entered successfully";
		
		$sql = "INSERT INTO ".$db->Prefix."goals (user_id,acct_id,cate_id,name,amount,frequency) VALUES(
		".$userinfo->User_id.",".$_GET["account"].",
		".$_GET["category"].",
		'".$_GET["name"]."',
		".$_GET["amount"].",
		".$_GET["frequency"]."
		)";
		$db->Query($sql);
		if(count($db->Error)==2){
			$response["message"] = "There was an error";
			$response["error"] = $db->Error;
		}
}else{
	$response["message"] = "There was an error";
	$response["error"] = "There was an error with the submission";
}
echo json_encode($response);
?> 