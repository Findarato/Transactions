<?
//Started January 26th 2009
//Probably started before this, but there was no started header, and the old reports was from a version or 2 back.
//Generates the display data for the textual report display.  All data is then passed to smarty to display on the page.
//A sub goal of this page is to see how few SQL queries I can do to generate the code.
include_once "../header.php";
function fixCategories($array){
	$returnArray = array();
	foreach ($array as $key=>$val){
		$returnArray[$val["id"]] = $val;
	}
	return $returnArray;
}
if($loggedin){ 
	$am_credit = array();
	$am_debit = array();
	$m_creditTotal = 0;
	$m_debitTotal = 0;
	$ay_credit = array();
	$ay_debit = array();
	$y_creditTotal = 0;
	$y_debitTotal = 0;
	$y_Savings = 0;
	$y_creditTotal = 0; 
  	$y_debitTotal = 0;
	$json = array(); //holder for all of the return data

	$json ="";
	$db = db::getInstance();
	$usr=unserialize($_SESSION['user']);
	$db->Query("SELECT id,acct_name FROM ".$db->Prefix."accounts WHERE user_id=".$userinfo->User_id." and main=1;");
	$acct = $db->Format("assoc");
	//This is just for the month.  Year might be done the same or might be a little different.  Thinking I will just show totals for 
	//debit, credit and the difference, be it savings or debt.  The year one could be graphed, the month can not be.
	
	$db->Query("SELECT id,cate_name,cate_type,parent,icon FROM ".$db->Prefix."categories WHERE user_id=".$userinfo->User_id.";");
	$categories = $db->Fetch("assoc_array");
	$categories = fixCategories($categories);
	
	
	$db->Query("SELECT SUM(l.credit) AS credit, SUM(l.debit) AS debit,l.category
	FROM ".$db->Prefix."ledger AS l WHERE l.user_id=".$userinfo->User_id." AND MONTH(l.dt)=".date("m")." AND YEAR(l.dt)=".date("Y")." AND l.acct_id=".$acct['id']." 
	GROUP BY l.category;");
	$res = $db->Format("assoc_array");
	
	//print_r($res);
	foreach($res as $r){
		if($r['credit']>0 && $r["credit"]!=null){
			$r["cate_name"] = $categories[$r["category"]]["cate_name"];
			$r["parent_name"] = $categories[$categories[$r["category"]]["parent"]]["cate_name"];
			$am_credit[$r["parent_name"].".".$r["cate_name"]] = $r;
			$m_creditTotal += $r['credit'];
		}
		if($r['debit']>0){
			$r["parent_name"] = $categories[$categories[$r["category"]]["parent"]]["cate_name"];
			$r["cate_name"]=$categories[$r["category"]]["cate_name"];
			$am_debit[$r["parent_name"].".".$r["cate_name"]] = $r;
			$m_debitTotal += $r['debit']; 
		}
	}
	ksort($am_debit);
	ksort($am_credit);
	//rray_sort($am_debit);
	//print_r($am_debit);
	$m_Savings = $m_creditTotal - $m_debitTotal;
	$json["m_savings"] = $m_Savings;
	$json["m_creditTotal"] = $m_creditTotal; 
  	$json["m_debitTotal"] = $m_debitTotal;
	$json["am_credit"] = $am_credit;
	$json["am_debit"] = $am_debit;
//Time to do the year numbers

	$db->Query("SELECT SUM(l.credit) AS credit, SUM(l.debit) AS debit,l.category
	FROM ".$db->Prefix."ledger AS l WHERE l.user_id=".$userinfo->User_id." AND YEAR(l.dt)=".date("Y")." AND l.acct_id=".$acct['id']." 
	GROUP BY l.category;");
	$res2 = $db->Format("assoc_array");
	foreach($res2 as $r2){
		if($r2['credit']>0 && $r2["credit"]!=null){
			$r2["cate_name"] = $categories[$r2["category"]]["cate_name"];
			$r2["parent_name"] = $categories[$categories[$r2["category"]]["parent"]]["cate_name"];
			$ay_credit[$r2["parent_name"].".".$r2["cate_name"]] = $r2;
			$y_creditTotal += $r2['credit'];
		}
		if($r2['debit']>0){
			$r2["parent_name"] = $categories[$categories[$r2["category"]]["parent"]]["cate_name"];
			$r2["cate_name"]=$categories[$r2["category"]]["cate_name"];
			$ay_debit[$r2["parent_name"].".".$r2["cate_name"]] = $r2;
			$y_debitTotal += $r2['debit']; 
		}
	}
	//print_r($ay_debit);
	ksort($ay_debit);
	ksort($ay_credit);
	//rray_sort($am_debit);
	//print_r($am_debit);
	$y_Savings = $y_creditTotal - $y_debitTotal;
	$json["y_savings"] = $y_Savings;
	$json["y_creditTotal"] = $y_creditTotal; 
  	$json["y_debitTotal"] = $y_debitTotal;
	$json["ay_credit"] = $ay_credit;
	$json["ay_debit"] = $ay_debit;





	header("Cache-Control: no-cache");
	header("Content-type: text/json");
	echo json_encode($json);
}
?>
