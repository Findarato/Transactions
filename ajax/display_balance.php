<?
/**
 * Started Friday June 11, 2010
 * Will return totals based on values passed
 */

function __autoload($class_name) { require_once "../classes/".strtolower($class_name) . '.class.php'; }
$db = db::getInstance();
$_GET = $db->Clean($_GET);
	header("Cache-Control: no-cache");
//	header("Content-type: text/json");
	$json["status"] = $status_code;
	$json["page"] = $page;
	$json["totalPages"] = $total_pages;
	$json["totalRecords"] = $totalRes;
	$json['modified'] = time();
	$json['accTitle'] = $user->Accounts[$_GET["acct"]]["acct_name"];
	$json['balance'] = $sums["total"];
/*Duration is currently not working
if(isset($_GET['duration'])){
	switch($_GET['duration']){
		case "month": default:
			
			break;
	}
}
*/
$json = array();
session_start();
	$status_code=0; //no code has run
	if(isset($_SESSION['user'])){
		$user = unserialize($_SESSION["user"]);
		$status_code=0.5;
		
	}
	if(!isset($_GET["account"])){$account = $user->Account_main;}else{$account =$_GET["account"]; }
/// select SUM(credit)-SUM(debit),month(dt),year(dt) AS total from fin_ledger WHERE acct_id=1 AND year(dt)="2010"  group BY MONTH(dt);
//select SUM(credit)-SUM(debit) AS total ,month(dt),year(dt)  from fin_ledger WHERE acct_id=1 AND dt BETWEEN "2009-1-1" AND "2010-6-30"  group BY MONTH(dt),YEAR(dt) ORDER BY YEAR(dt),MONTH(dt);
	$json['lables'] = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	
	$sql = "
	SELECT 
		SUM(credit)-SUM(debit) AS total ,
		MONTH(dt) AS month,
		YEAR(dt) AS year 
	FROM 
		".$db->Prefix."ledger 
	WHERE 
		acct_id=".$account." 
		AND dt BETWEEN '".$_GET["start"]."' AND '".$_GET["end"]."'  
	GROUP BY 
		MONTH(dt),
		YEAR(dt) 
	ORDER BY 
		YEAR(dt),
		MONTH(dt);";
	
	
	$json['items'] = $db -> Query($sql,false,"assoc_array");
	if(isset($_GET['rt'])){
		$sql = "
		SELECT 
			SUM(credit)-SUM(debit) AS total 
		FROM 
			".$db->Prefix."ledger 
		WHERE 
			acct_id=".$account." 
			AND dt < '".$_GET["start"]."';";
		
		$json['totalBefore'] = $db -> Query($sql,false,"row");
		
		$runningTotal = $json['totalBefore'];
		$holderArray = array();
		foreach($json['items'] as $key=>$value){
			$holderArray[] = array(
			"RunningTotal"=>$runningTotal+=$value["total"],
			"month"=>$value["month"],
			"year"=>$value["year"],
			"total"=>$value["total"]
			); 
		}
		$json['items'] = $holderArray;
	}

	/*$data = array_fill(0, 12, '');
	foreach($res as $line){
		$data[$line[0]-1] = $line[1];	
	}

	$monthSlice = array_slice($months,0,date("n"));
	$valueSlice = array_slice($data,0,date("n"));

	for($a=0;$a<date("n");$a++){
		array_shift($months);
		array_shift($data);
	}
	$months = array_slice(array_merge($months,$monthSlice),6,6);
	$data = array_slice(array_merge($data,$valueSlice),6,6);
*/
echo json_encode($json);
?>