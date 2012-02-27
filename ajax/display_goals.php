<?
/************************************************************
Started Auguest 31, 2007
Designed to be part of the smarty template system, this will generate the 
same graphcs as the quick display but for all even the ones that are not 
"favorite" flaged.  Under all graphs will be a display for the current year that
is January 1 to December 31 of the current year.  The months that are not
yet to be will be a 0 and will be displayed.  There will be no sub graph for 
yearly goals as they are already for a full year.

Updated February 14, 2009
Has been since adjusted to be a ajax (xml) generation script, that feeds the display
done with JQuery.
************************************************************/
session_start();
include_once "../functions.php";
$status_code = 0;

function __autoload($class_name) {require_once "../classes/".strtolower($class_name) . '.class.php';}
$db = db::getInstance();
if(isset($_SESSION['user'])){//There is an active loged in user
	$db = db::getInstance();
	$usr = unserialize($_SESSION['user']);
	$sql = "SELECT acct_id,cate_id,name,amount,frequency,favorite,type FROM ".$db -> Prefix."goals WHERE user_id=".$usr -> User_id.";";
	$db -> Query($sql);
	$accounts = array();
	$goals=array();
	$row = $db -> Format("assoc_array");
	foreach ($row as $r) {
		switch ($r["frequency"]) {
			case 30: 
				$startD = date("Y-m-d",mktime(0,0,0,date("m"),1,date("Y")));
				$endD = date("Y-m-d",mktime(0,0,0,date("m"),date("t"),date("Y")));
				break;
			case 365:
				$startD = date("Y-m-d",mktime(0,0,0,1,1,date("Y")));
				$endD = date("Y-m-d",mktime(0,0,0,12,31,date("Y")));
				break;
		}
		$total = GetTotal($r["cate_id"],date("Y/m").'/1',date("Y/m/t"),$r['acct_id']); //need to fix this, only supports the month, not the year
	    $per = $total/$r["amount"];
		$accounts[] = $r["acct_id"];
		$goals[$r["cate_id"]]=array("goalid"=>$r["cate_id"],"perdisplay"=>round($per*100,2),"per"=>$per, "goalname"=>$r["name"],"goalamount"=>$r["amount"],"frequency"=>$r["frequency"]);

	}
	$sql = "SELECT SUM(credit)-SUM(debit) AS total 
	FROM ".$db->Prefix."ledger WHERE MONTH(dt)=".date("m")." AND YEAR(dt)=".date("Y")." AND credit>0 AND acct_id IN(".join(",",$accounts).")";
	$db->Query($sql);
	$Total = $db->Fetch("row");
	$json["totalIncome"] = $Total;
	if(isset($_GET['f'])){//The user has passed the right info
		if($_GET['f']=="xml") {//this is a json version
			header("Content-type: text/xml"); 
			header("Cache-Control: no-cache"); 
			echo "<?xml version=\"1.0\"?>"; 
			//This is the xml you want to see
			echo "<t>";
			echo "<rows>"; 
			foreach($goals as $g){		
				echo "<row>";
					echo "<id>".$g['goalid']."</id>";
					echo "<perdisplay>".$g['perdisplay']."</perdisplay>";
					echo "<per>".round($g['per'],2)."</per>";
					echo "<goalname>".$g['goalname']."</goalname>";
					echo "<icon>"."<![CDATA[]]></icon>";
				echo "</row>";
			}
			echo "</rows>";
			echo "<queries>".$db->Queries."</queries>";
			echo "</t>";
		}elseif($_GET['f']=="json"){
			header("Cache-Control: no-cache");
			header("Content-type: text/json");
			$json["status"] = $status_code;
			$json['modified'] = time();
			$json["goals"] = $goals;
			echo json_encode($json);
		}		 
	}
}else{echo "No data for you!";}
?>