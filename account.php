<?
include_once "header.php";
include_once "functions.php";
//$smarty->assign('title','Transactions/Category');
$accts = array();
$db = db::getInstance();
$uri = split('/',$_SERVER['REQUEST_URI']);
$acct_numb = $uri[count($uri)-1];

$sql = "
SELECT 		l.id,
			l.credit,
			l.debit,
			l.dt,
			c.cate_name,
			l.note,
			l.ckno,
			l.acct_id
FROM		".$db->Prefix."ledger
AS			l
JOIN		".$db->Prefix."categories
AS			c
ON			(c.id=l.category)
WHERE		l.user_id = ".$userinfo -> User_id."
AND			l.acct_id = $acct_numb

ORDER BY 	l.dt DESC";

$tans = array();
$db = db::getInstance();
$db -> query($sql);
$res = $db -> format("row_array");
foreach($res as $row){
	$trans[] = array(
	'acct_id'=>$row[7],
	'id'=>$row[0],
	'credit'=>$row[1],
	'debit'=>$row[2],
	'category'=>$row[4],
	'date'=>date($userinfo -> Config['date_format'],strtotime($row[3])),
	'note'=>$row[5],
	'ckno'=>$row[6]);
}
$smarty->assign("count","10000");
$smarty->assign("trans",$trans);
$smarty->assign('content','ledger.tpl');
$smarty->assign("acctId",$acct_numb);
$smarty->assign("limit",-1);
$smarty->display("body.tpl");
?>