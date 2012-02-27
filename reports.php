<?
//Started January 26th 2009
//Probably started before this, but there was no started header, and the old reports was from a version or 2 back.
//Generates the display data for the textual report display.  All data is then passed to smarty to display on the page.
//A sub goal of this page is to see how few SQL queries I can do to generate the code.
include_once "header.php";
if($loggedin){ 
	$db = db::getInstance();
	$usr=unserialize($_SESSION['user']);
	$db->Query("SELECT id,acct_name FROM ".$db->Prefix."accounts WHERE user_id=".$userinfo->User_id." and main=1;");
	$acct = $db->Format("assoc");
	//This is just for the month.  Year might be done the same or might be a little different.  Thinking I will just show totals for 
	//debit, credit and the difference, be it savings or debt.  The year one could be graphed, the month can not be. 
	$db->Query("SELECT SUM(l.credit) AS credit, SUM(l.debit) AS debit, c.cate_name AS cate_name, 
				c.parent, c.cate_type AS cate_type , c.icon, c.id, c2.cate_name AS parent_name
		FROM ".$db->Prefix."categories AS c 
		LEFT JOIN ".$db->Prefix."ledger AS l ON l.category=c.id 
		JOIN ".$db->Prefix."categories AS c2 ON c2.id=c.parent
		WHERE (l.user_id=1) AND MONTH(l.dt)=".date("m")." AND YEAR(l.dt)=".date("Y")." AND l.acct_id=".$acct['id']." 
		GROUP BY l.category ORDER BY c2.cate_name, c.cate_name;");
//		GROUP BY c2.cate_name ORDER BY c2.cate_name, c.cate_name;"); how to get the sum of the tree

	$res = $db->Format("assoc_array");
	$am_credit = array();
	$am_debit = array();
	$m_creditTotal = 0;
	$m_debitTotal = 0;
	$y_creditTotal = 0;
	$y_debitTotal = 0;
	foreach($res as $r){

		if($r['credit']>0){
			$am_credit[] = $r;
			$m_creditTotal +=$r['credit'];
		}
		if($r['debit']>0){
			$am_debit[] = $r;
			$m_debitTotal += $r['debit']; 
		} //a quick sort
	}
	$m_Savings = $m_creditTotal - $m_debitTotal;
	$smarty->assign('am_credit',$am_credit);
	$smarty->assign('am_debit',$am_debit);
	$smarty->assign('m_Savings',$m_Savings);
	$smarty->assign('m_creditTotal',$m_creditTotal);
	$smarty->assign('m_debitTotal',$m_debitTotal);

//Time to do the year numbers
	$db->Query("SELECT SUM(l.credit) AS credit, SUM(l.debit) AS debit, c.cate_name AS cate_name, 
				c.parent, c.cate_type AS cate_type , c.icon, c.id, c2.cate_name AS parent_name
		FROM ".$db->Prefix."categories AS c 
		LEFT JOIN ".$db->Prefix."ledger AS l ON l.category=c.id 
		JOIN ".$db->Prefix."categories AS c2 ON c2.id=c.parent
		WHERE (l.user_id=1)  AND YEAR(l.dt)=".date("Y")." AND l.acct_id=".$acct['id']." 
		GROUP BY l.category ORDER BY c2.cate_name, c.cate_name;");
	$res = $db->Format("assoc_array");
	foreach($res as $r){
		if($r['credit']>0){
			$ay_credit[] = $r;
			$y_creditTotal +=$r['credit'];
		}
		if($r['debit']>0){
			$ay_debit[] = $r;
			$y_debitTotal += $r['debit'];
		} //a quick sort
	}

	$y_Savings = $y_creditTotal - $y_debitTotal;
	$smarty->assign('ay_credit',$ay_credit);
	$smarty->assign('ay_debit',$ay_debit);
	$smarty->assign('y_Savings',$y_Savings);
	$smarty->assign('y_creditTotal',$y_creditTotal);
	$smarty->assign('y_debitTotal',$y_debitTotal);


	$smarty->assign('content','reports.tpl');
}else{$smarty->assign('content','login.tpl');}


$smarty->display("body.tpl");
?>