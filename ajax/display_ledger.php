<?Php
/*
 *Started September 16, 2008
 *An ajax implementation of the ledger.  Will support XML and JASON 
 * 
 */
if(isset($_GET['page'])){
	$sordx=""; //Fixes a problem that should not be
    $page = $_GET['page']; // get the requested page 
	$limit = $_GET['rows']; // get how many rows we want to have into the grid 
	$sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
	$sord = $_GET['sord']; // get the direction 
	$sordxc=true;
	if($sordx=="" || $sordx==NULL) $sordxc=false;
}
$json = array();
session_start();
	$status_code=0; //no code has run
	function __autoload($class_name) { require_once "../classes/".strtolower($class_name) . '.class.php'; }
	if(isset($_SESSION['user'])){
		$user = unserialize($_SESSION["user"]);
		$status_code=0.5;
		if($user -> User_id > 0){
			$db = db::getInstance();
			$sql = "SELECT l.*,c.cate_name FROM ".$db->Prefix."ledger as l JOIN ".$db->Prefix."categories AS c ON (l.category=c.id) WHERE l.user_id=".$user->User_id;
			if(isset($_GET['acct']) && $_GET['acct']>0){$sql.=" AND l.acct_id=".mysql_real_escape_string($_GET['acct']);}
			if(isset($_GET['dtsearch']) ){$sql.=" AND l.dt='".mysql_real_escape_string($_GET['dtsearch'])."'";}
			if(isset($_GET['catesearch']) ){$sql.=" AND l.category='".mysql_real_escape_string($_GET['catesearch'])."'";}
			if(isset($_GET['sidx']) && $sordxc===true){$sql.=" ORDER BY l.".$sidx." ".$sord;}else{$sql.=" ORDER BY l.dt DESC,l.id DESC";} //sort the results
			$sqlSum = "select 
			TRUNCATE(SUM(l.credit),1) AS credit, 
			TRUNCATE(SUM(l.debit),1) AS debit,
			TRUNCATE(SUM(l.credit)-SUM(l.debit),2) AS total
			FROM ".$db->Prefix."ledger as l WHERE l.acct_id=".mysql_real_escape_string($_GET['acct']);
			
			$start = $limit*$page - $limit; 
			if ($start<0) $start = 0; //just some error checking
			$db->Query($sql);
			$totalRes = $db->Count_res(); //How many rows will you be giving me
			$sql.= " LIMIT ".$start." , ".$limit;
			$db -> Query($sql); //now get the rows needed to be returned.
			$total_pages = ceil($totalRes/$limit);
			$result = $db -> Format("assoc_array");
			if(count($db->Error)>0) {$status_code=2;$json["error"]=$db->Error;} else {$status_code=1;}
			$db->Query($sqlSum);
			$sums = $db->Fetch("assoc");
		}
	}
if($_GET['format']=="json") {//this is a json version
	header("Cache-Control: no-cache");
	header("Content-type: text/json");
	$json["status"] = $status_code;
	$json["page"] = $page;
	$json["totalPages"] = $total_pages;
	$json["totalRecords"] = $totalRes;
	$json['modified'] = time();
	$json['accTitle'] = $user->Accounts[$_GET["acct"]]["acct_name"];
	$json['balance'] = $sums["total"];
	$json['items'] = $result;
	echo json_encode($json);
}
